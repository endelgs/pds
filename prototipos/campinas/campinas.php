<?php 
error_reporting(0);
header("Content-type: text/html; charset:utf-8");
include "../html_dom/simple_html_dom.php";
$structure = array("protocolo","interessado","objeto","publicado_em");
$dateFields = array("recebimento_propostas","inicio_disputa_precos","publicado_em","");
$conexao = new mysqli("localhost","root","root","pds_crawler");
//echo $_SERVER["HTTP_USER_AGENT"];
try{
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
  $header[] = "Cache-Control: max-age=0"; 
  $header[] = "Connection: keep-alive"; 
  $header[] = "Keep-Alive: 300"; 
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
  $header[] = "Accept-Language: en-us,en;q=0.5"; 
  $header[] = "Pragma: "; // browsers keep this blank. 

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
  //curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com'); 
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); 
  curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_URL,"http://licitacoes.campinas.sp.gov.br/listar.php?id_tipo=2&ano=2012");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
  
  $htmlResult = utf8_encode(curl_exec($ch));
  file_put_contents("html2.html",$htmlResult);
  curl_close($ch);
  $htmlResult = file_get_contents("html2.html");
  if(strlen($htmlResult) < 1) throw new Exception("Não foi possível baixar o HTML");
  $str = str_get_html($htmlResult);
  $lista = array();
  $tmp = array();
  
  $licitacoes = $str->find('#tabela tr');
  $inserts = array();
  $counter = 0;
  for($i = 1; $i<count($licitacoes);$i++){
    $tmp = array();
    $lic = str_get_html($licitacoes[$i]->innertext);
    // A tag kbd
    $propriedades = $lic->find('kbd');
    foreach($propriedades as $prop){
      $key = sanitize(normalize($prop->previousSibling()->innertext));
      if(!empty($key))
        $tmp[$key] = sanitize($prop->innertext);
    }
    $lista[] = $tmp;
    //die();
  }
  //print_r($lista);
  if(empty($licitacoes)) throw new Exception("Não foi possível encontrar a tag kbd. Provavelmente a estrutura do site mudou.");
  foreach($licitacoes as $t){
    $key = (empty($t->previousSibling()->innertext))?'aviso':mb_ereg_replace("|:|","",normalize($t->previousSibling()->innertext));
    // Como o protocolo eh sempre a primeira coisa, uso ele como 'separador'
    if($key == "protocolo"){
        if($counter > 0){
          $lista[] = $tmp;
          unset($tmp);
          $tmp = array();
        }
        $counter++;
    }
    $value = sanitize($t->innertext);
    if(in_array($key,$dateFields)){
        preg_match("|([0-9]+)/([0-9]+)/([0-9]+) ([0-9]+:[0-9]+)|",$value,$matches);
        $value = $matches[3]."-".$matches[2]."-".$matches[1]." ".$matches[4].":00";
      }
    $tmp[$key] = $value;
  }
  //print_r($lista);
  foreach($lista as $tmp){
    if(isset($tmp['protocolo'])){
      
      $db_row = array(
        'protocolo' => $tmp['protocolo'],
        'interessado' => $tmp['interessado'],
        'objeto' => addslashes($tmp['objeto']),
        'objeto_free' => '',
        'publicado_em' => $tmp['publicado_em'],
        'aviso' => addslashes($tmp['aviso']),
        'aviso_free' => '',
        'outros' => serialize($tmp),
        'all_data' => strtolower(addslashes(implode(" ",$tmp))),
        'id_cidade' => 1 // id de campinas
      );
      
      $db_row['objeto_free'] = strtolower($db_row['objeto']);
      $db_row['objeto_free'] = str_replace('campinas','xxxx',$db_row['objeto_free']);
      $db_row['objeto_free'] = str_replace('secretaria','xxxx',$db_row['objeto_free']);
      $db_row['objeto_free'] = str_replace('prefeitura','xxxx',$db_row['objeto_free']);
      
      $db_row['aviso_free'] = strtoupper($db_row['aviso']);
      $db_row['aviso_free'] = str_replace('CAMPINAS','xxxx',$db_row['aviso_free']);
      $db_row['aviso_free'] = str_replace('SECRETARIA','xxxx',$db_row['aviso_free']);
      $db_row['aviso_free'] = str_replace('PREFEITURA','xxxx',$db_row['aviso_free']);
      
      $db_row['all_data'] = str_replace('campinas','xxxx',$db_row['all_data']);
      $db_row['all_data'] = str_replace('secretaria','xxxx',$db_row['all_data']);
      $db_row['all_data'] = str_replace('prefeitura','xxxx',$db_row['all_data']);
      $sql = "INSERT INTO licitacoes (protocolo,interessado,objeto, objeto_free,publicado_em,aviso,aviso_free,outros,all_data,id_cidade) VALUES ";
      $sql .= "('".implode("','",$db_row)."')";     
      $conexao->query(utf8_decode($sql));
      if($conexao->errno){
        throw new Exception("Problema no acesso ao banco de dados: ".$conexao->error);
      }
    }
    
  }
 
}catch(Exception $e){
  $mensagem = "Problema no crawler de CAMPINAS. Detalhes abaixo:\n";
  $mensagem .= $e->getMessage();
  mail("endel.gs@gmail.com","QuickLic - Crawlers",$mensagem);
}

function normalize($str){
  $a = array("ã","â","á","à","ä","Ã","Â","Á","À","Ä");
  $e = array("ẽ","ê","é","è","ë","Ẽ","Ê","É","È","Ë");
  $i = array("í","ì","ĩ","î","ï","Í","Ì","Ĩ","Î","Ï");
  $o = array("ó","ò","õ","ô","ö","Ó","Ò","Õ","Ô","Ö");
  $u = array("ú","ù","û","ũ","ü","Ú","Ù","Û","Ũ","Ü");
  $c = array("ç","Ç");
  
  $str = mb_strtolower(trim($str));
  
  foreach($a as $v) $str = mb_ereg_replace($v,"a",$str);
  foreach($e as $v) $str = mb_ereg_replace($v,"e",$str);
  foreach($i as $v) $str = mb_ereg_replace($v,"i",$str);
  foreach($o as $v) $str = mb_ereg_replace($v,"o",$str);
  foreach($u as $v) $str = mb_ereg_replace($v,"u",$str);
  foreach($c as $v) $str = mb_ereg_replace($v,"c",$str);
  
  $str = preg_replace("|\s|","_",$str);
  $str = mb_ereg_replace("|<[^>]+>|","",$str);
  $str = mb_ereg_replace("&_d(a|e|o|as|os)_&","_",$str);

  return $str;
}
function sanitize($str){
  // Logica sinistra pra apagar os comentarios
  $str = preg_replace("|<!.*-->|","",$str);
  $str = preg_replace("|<[^>]+>|","",$str);
  $str = preg_replace("|&nbsp;|","",$str);
  $str = preg_replace("|:|","",$str);
  //echo $str."\n";
  return $str;
}