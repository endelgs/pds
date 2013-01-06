<?php
//error_reporting(E_ALL);
error_reporting(0);
header("Content-type: text/html; charset:utf-8");
include "../html_dom/simple_html_dom.php";
$ckfile = tempnam ("/home/endel/www/pds/crawlers/saopaulo/cookie", "CURLCOOKIE");

//setCookie();
try{
  grabWebPage();
}catch (Exception $e){
  $mensagem = "Problema no crawler de SÃO PAULO. Detalhes abaixo:\n";
  $mensagem .= $e->getMessage();
  mail("endel.gs@gmail.com","QuickLic - Crawlers",$mensagem);
}
/**
 * function grabWebPage
 * 
 * Funcao que pega os resultados das licitacoes do site da cidade de Sao Paulo.
 * Como o site eh feito em .NET, ele faz um monte de requisicoes esquisitas
 * usando cookies e um monte de headers especificos.
 *  
 * Pra contornar isso, precisa setar os headers na mao a cada requisicao,
 * portanto NAO MEXA NADA DO CODIGO ABAIXO.
 */
function grabWebPage(){
  global $ckfile;
  // Fazendo primeiro request da busca
  $header[] = "Accept:*/*";
  $header[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3";
  $header[] = "Accept-Encoding:gzip,deflate,sdch";
  $header[] = "Accept-Language:pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
  $header[] = "Cache-Control: no-cache"; 
  $header[] = "Connection:keep-alive";
  //$header[] = "Cookie:ASP.NET_SessionId=agh5zc55cgcrfs55vpotnc45";
  $header[] = "Content-Type:application/x-www-form-urlencoded";
  $header[] = "Host:e-negocioscidadesp.prefeitura.sp.gov.br";
  $header[] = "Origin:http://e-negocioscidadesp.prefeitura.sp.gov.br";
  $header[] = "Referer:http://e-negocioscidadesp.prefeitura.sp.gov.br/BuscaLicitacao.aspx";
  $header[] = "User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11";
  $header[] = "X-MicrosoftAjax:Delta=true";

  $date = date('Y-m-d');
  $date = strtotime ( '+1 year' , strtotime ( $date ) ) ;
  $date = date ( 'd/m/Y' , $date );

  $ch = curl_init();
  // habilitando cookies
  curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
  curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
  curl_setopt($ch,CURLOPT_POST, 1);
  curl_setopt($ch,CURLOPT_POSTFIELDS,
  'ctl00$ajaxMaster=ctl00$cphConteudo$ajaxForm|ctl00$cphConteudo$frmBuscaLicitacao$ibtBuscar'.
  '&__EVENTTARGET='.
  '&__EVENTARGUMENT='.
  '&__LASTFOCUS='.
  '&__VIEWSTATE='.urlencode('/wEPDwUHODI3NTA4MQ9kFgJmD2QWAgIDD2QWAgIDD2QWBAIBD2QWBAIDDxYCHgdWaXNpYmxlaGQCBQ8PFgIfAGhkZAIDD2QWAmYPZBYCAgEPZBYYAgMPZBYCZg9kFgJmD2QWAmYPZBYCZg9kFgJmD2QWBmYPDxYCHghJbWFnZVVybAWvAS9XZWJSZXNvdXJjZS5heGQ/ZD1nck10dTJnVXZ3bHRHcGdiUk5vei1JMm94M1M2SUlZejhsZEJLeE9IQk44OExoZVpmTkdfUzVLY1FhMlJsX2I5dUdpVy1RWTRGLVBxdGhscTh5eE9HX2g3RXRjUzNpRHRDSWZ6QnQ4dHJydWlrUzhSQl9BZXFVUWpadFNLaHdDTGRoRWZyUTImdD02MzQ3Mjk0NzExMjAwMDAwMDBkZAIBDw8WAh8BBa8BL1dlYlJlc291cmNlLmF4ZD9kPXNoQ2tITG9TN3M1TmFkNmkzQ3dXYTRGckhNcFJsWWUtbGpYNkswMDVUOWlBWXZWZ1lhWm1STEppb0JxejNoV3VOOG5kV0phMm10WUMxWU1BdWh5NWZsRk9MV0MyY25hN1U5RVRfdmVOSlFmdFpjc2NST21Ma3ItUm9qcU9WZjgzZ3F4dW9BMiZ0PTYzNDcyOTQ3MTEyMDAwMDAwMGRkAgIPDxYCHwEFrwEvV2ViUmVzb3VyY2UuYXhkP2Q9dWN6TGpSRWg0dFBjZ3dpdjFkbHlITjVFc2hBcVNwZ3FXM1JNM05VX2VRd2N1bGZZOHlGNnVoYmhJLUhCeUZxOUpaWmZnWmpyRkxmMk5KbzFFdjVXN0phWlMzcGpCSzZ3a0ZQTGVGVThoaG51clpnNzVsay00SWxDLTFqMHZQTHgxU09id2cyJnQ9NjM0NzI5NDcxMTIwMDAwMDAwZGQCBQ9kFgJmD2QWAgIBD2QWAmYPZBYCZg9kFgJmD2QWAmYPZBYCZg9kFgZmDw8WAh8BBa8BL1dlYlJlc291cmNlLmF4ZD9kPWdyTXR1MmdVdndsdEdwZ2JSTm96LUkyb3gzUzZJSVl6OGxkQkt4T0hCTjg4TGhlWmZOR19TNUtjUWEyUmxfYjl1R2lXLVFZNEYtUHF0aGxxOHl4T0dfaDdFdGNTM2lEdENJZnpCdDh0cnJ1aWtTOFJCX0FlcVVRalp0U0tod0NMZGhFZnJRMiZ0PTYzNDcyOTQ3MTEyMDAwMDAwMGRkAgEPDxYCHwEFrwEvV2ViUmVzb3VyY2UuYXhkP2Q9c2hDa0hMb1M3czVOYWQ2aTNDd1dhNEZySE1wUmxZZS1salg2SzAwNVQ5aUFZdlZnWWFabVJMSmlvQnF6M2hXdU44bmRXSmEybXRZQzFZTUF1aHk1ZmxGT0xXQzJjbmE3VTlFVF92ZU5KUWZ0WmNzY1JPbUxrci1Sb2pxT1ZmODNncXh1b0EyJnQ9NjM0NzI5NDcxMTIwMDAwMDAwZGQCAg8PFgIfAQWvAS9XZWJSZXNvdXJjZS5heGQ/ZD11Y3pMalJFaDR0UGNnd2l2MWRseUhONUVzaEFxU3BncVczUk0zTlVfZVF3Y3VsZlk4eUY2dWhiaEktSEJ5RnE5SlpaZmdaanJGTGYyTkpvMUV2NVc3SmFaUzNwakJLNndrRlBMZUZVOGhobnVyWmc3NWxrLTRJbEMtMWowdlBMeDFTT2J3ZzImdD02MzQ3Mjk0NzExMjAwMDAwMDBkZAIHDxAPFgYeDkRhdGFWYWx1ZUZpZWxkBQZJREFyZWEeDURhdGFUZXh0RmllbGQFDURlc2NyaWNhb0FyZWEeC18hRGF0YUJvdW5kZ2QQFQcACEltw7N2ZWlzGE1hdGVyaWFpcyBlIEVxdWlwYW1lbnRvcwVPYnJhcxBSZWN1cnNvcyBIdW1hbm9zEFNlcnZpw6dvcyBDb211bnMXU2VydmnDp29zIGRlIEVuZ2VuaGFyaWEVBwABNgEzATIBNAExATUUKwMHZ2dnZ2dnZxYBZmQCCQ8QZGQWAGQCCw8QDxYGHwIFDElEU2VjcmV0YXJpYR8DBRNEZXNjcmljYW9TZWNyZXRhcmlhHwRnZBAVVAAaQVJJQ0FORFVWQS9GT1JNT1NBL0NBUlLDg08lQVNTSVNUw4pOQ0lBIEUgREVTRU5WT0xWSU1FTlRPIFNPQ0lBTB5BVVRBUlFVSUEgSE9TUElUQUxBUiBNVU5JQ0lQQUw0QVVUQVJRVUlBIEhPU1BJVEFMQVIgTVVOSUNJUEFMIFJFR0lPTkFMIENFTlRSTy1PRVNURS1BVVRBUlFVSUEgSE9TUElUQUxBUiBNVU5JQ0lQQUwgUkVHSU9OQUwgTEVTVEUvQVVUQVJRVUlBIEhPU1BJVEFMQVIgTVVOSUNJUEFMIFJFR0lPTkFMIFNVREVTVEUrQVVUQVJRVUlBIEhPU1BJVEFMQVIgTVVOSUNJUEFMIFJFR0lPTkFMIFNVTCZBVVRPUklEQURFIE1VTklDSVBBTCBERSBMSU1QRVpBIFVSQkFOQQhCVVRBTlTDgxFDw4JNQVJBIE1VTklDSVBBTAtDQU1QTyBMSU1QTxFDQVBFTEEgRE8gU09DT1JSTxlDQVNBIFZFUkRFIC0gQ0FDSE9FSVJJTkhBDUNJREFERSBBREVNQVIRQ0lEQURFIFRJUkFERU5URVMiQ09NUEFOSElBIERFIEVOR0VOSEFSSUEgREUgVFJBRkVHTyZDT01QQU5ISUEgTUVUUk9QT0xJVEFOQSBERSBIQUJJVEHDh8ODTydDT01QQU5ISUEgUEFVTElTVEFOQSBERSBTRUNVUklUSVpBw4fDg09BQ09NUEFOSElBIFPDg08gUEFVTE8gREUgREVTRU5WT0xWSU1FTlRPIEUgTU9CSUxJWkHDh8ODTyBERSBBVElWT1MhQ09NUEFOSElBIFPDg08gUEFVTE8gREUgUEFSQ0VSSUFTDUNPTVVOSUNBw4fDg09LQ09OU0VMSE8gR0VTVE9SIERPIEZVTkRPIE1VTklDSVBBTCBERSBTQU5FQU1FTlRPIEFNQklFTlRBTCBFIElORlJBRVNUUlVUVVJBIENPT1JERU5Bw4fDg08gREFTIFNVQlBSRUZFSVRVUkFTB0NVTFRVUkEWREVTRU5WT0xWSU1FTlRPIFVSQkFOTxBESVJFSVRPUyBIVU1BTk9THERJUkVJVE9TIEhVTUFOT1MgRSBDSURBREFOSUEKRURVQ0HDh8ODTzVFTVBSRVNBIERFIFRFQ05PTE9HSUEgREEgSU5GT1JNQcOHw4NPIEUgQ09NVU5JQ0HDh8ODTxJFUk1FTElOTyBNQVRBUkFaWk8dRVNQT1JURVMsIExBWkVSIEUgUkVDUkVBw4fDg08mRklOQU7Dh0FTIEUgREVTRU5WT0xWSU1FTlRPIEVDT07DlE1JQ08WRlJFR1VFU0lBLUJSQVNJTMOCTkRJQRRGVU5EQcOHw4NPIENBVEFWRU5UTzBGVU5EQcOHw4NPIFBBVUxJU1RBTkEgREUgRURVQ0HDh8ODTyBFIFRFQ05PTE9HSUEUR0FCSU5FVEUgRE8gUFJFRkVJVE8RR09WRVJOTyBNVU5JQ0lQQUwKR1VBSUFOQVNFUwtIQUJJVEHDh8ODTydIT1NQSVRBTCBETyBTRVJWSURPUiBQw5pCTElDTyBNVU5JQ0lQQUweSU5GUkEtRVNUUlVUVVJBIFVSQkFOQSBFIE9CUkFTI0lOU1RJVFVUTyBERSBQUkVWSUTDik5DSUEgTVVOSUNJUEFMCElQSVJBTkdBDklUQUlNIFBBVUxJU1RBCElUQVFVRVJBCUpBQkFRVUFSQRJKQcOHQU7Dgy1UUkVNRU1Cw4kETEFQQQtNJ0JPSSBNSVJJTQVNT09DQRRORUfDk0NJT1MgSlVSw41ESUNPUw9PVVZJRE9SSUEgR0VSQUwLUEFSRUxIRUlST1MFUEVOSEEFUEVSVVMtUEVTU09BIENPTSBERUZJQ0nDik5DSUEgRSBNT0JJTElEQURFIFJFRFVaSURBCVBJTkhFSVJPUxFQSVJJVFVCQS9KQVJBR1XDgQxQTEFORUpBTUVOVE8iUExBTkVKQU1FTlRPLCBPUsOHQU1FTlRPIEUgR0VTVMODTydSRUxBw4fDlUVTIElOVEVSTkFDSU9OQUlTIEUgRkVERVJBVElWQVMQU0FOVEFOQS9UVUNVUlVWSQtTQU5UTyBBTUFSTwtTw4NPIE1BVEVVUwtTw4NPIE1JR1VFTBBTw4NPIFBBVUxPIE9CUkFTFVPDg08gUEFVTE8gVFJBTlNQT1JURRJTw4NPIFBBVUxPIFRVUklTTU8UU8ODTyBQQVVMTyBVUkJBTklTTU8GU0HDmkRFA1PDiSpTRUNSRVRBUklBIEVTUEVDSUFMIERFIERFU0JVUk9DUkFUSVpBw4fDg08RU0VHVVJBTsOHQSBVUkJBTkERU0VHVVJBTsOHQSBVUkJBTkETU0VSVknDh08gRlVORVLDgVJJTwlTRVJWScOHT1MeVFJBQkFMSE8gRSBETyBFTVBSRUVOREVET1JJU01PC1RSQU5TUE9SVEVTElRSSUJVTkFMIERFIENPTlRBUxVWRVJERSBFIE1FSU8gQU1CSUVOVEUZVklMQSBNQVJJQS9WSUxBIEdVSUxIRVJNRQxWSUxBIE1BUklBTkEXVklMQSBQUlVERU5URS9TQVBPUEVNQkEVVAAFMjA4OTIFMjE2OTcFMjE5NDkFMjE5NjMFMjE5NTcFMjE5NTkFMjE5NjEFNDk0MTUFMjA5MTYFMjIwMjUFMjA5NDAFMjE1NDAFMjA5NjQFMjA5ODgFMjEwMTIFMjIwMzAFMjIwNDgFNDkzNDgFNDM5NTMFMzc4NjEFMjA4MzUFNDg5NTgFMjA4NzgFMjE2MzYFMzQwMzcFNTI5NTYFMjA4NDAFMjE2NTEFMjIwNTQFMjEwMzYFMjE2ODgFMjE3MzUFMjEwNjAFMjA4MzEFNTEyOTAFMjA4MTQFMjA4MjMFMjEwODQFMjE4MTgFMjE4NjEFMjIwMDgFMjE4NzQFMjExMDgFMjExMzIFMjExNTYFMjExODAFMjEyMDQFMjEyMjgFMjEyNTIFMjEyNzYFMjE4ODEFMjA4NTEFMjEzMDAFMjEzMjQFMjEzNDgFMjA4NTUFMjEzNzIFMjEzOTYFMjE5MTIFMjA4NjEFMjA4NTMFMjE0MjAFMjE0NDQFMjE0NjgFMjE0OTIFMzE4NTIFMjIwNTgFMjIwNjYFMjIwNTYFMjE5MTkFMjE1MTYFMjA4MzMFMzM1NDAFMzg5NTYFMjE5NjUFMjE5NzEFMjA4MzgFMjE5NzcFMjIwNjQFMjE5ODcFMjE1NjQFMjE1ODgFMjE2MTIUKwNUZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnFgFmZAINDxBkZBYAZAITDxAPFgYfAgUMSURNb2RhbGlkYWRlHwMFE0Rlc2NyaWNhb01vZGFsaWRhZGUfBGdkEBUOACRDT01QUkEgUE9SIEFUQSBERSBSRUdJU1RSTyBERSBQUkXDh08NQ09OQ09SUsOKTkNJQQhDT05DVVJTTxFDT05TVUxUQSBQw5pCTElDQQlDT05Ww4pOSU8HQ09OVklURQhESVNQRU5TQQ9JTkVYSUdJQklMSURBREUHTEVJTMODTwdQUkVHw4NPE1BSRUfDg08gRUxFVFLDlE5JQ08SUFJFR8ODTyBQUkVTRU5DSUFMEVRPTUFEQSBERSBQUkXDh09TFQ4AAjEzATEBMgEzAjEyATQBNQE2ATcBOAE5AjEwAjExFCsDDmdnZ2dnZ2dnZ2dnZ2dnZGQCFQ8QDxYGHwIFEUlEU3RhdHVzTGljaXRhY2FvHwMFGERlc2NyaWNhb1N0YXR1c0xpY2l0YWNhbx8EZ2QQFQMJRU0gQUJFUlRPDEVNIEFOREFNRU5UTwlFTkNFUlJBREEVAwExATIBMxQrAwNnZ2dkZAIdDw8WAh4JTWF4TGVuZ3RoAgoWBh4Nb25jb250ZXh0bWVudQUNcmV0dXJuIGZhbHNlOx4Jb25rZXlkb3duBTpqYXZhc2NyaXB0OnJldHVybiBUZXh0Ym94X01hc2soZXZlbnQsIHRoaXMsICcjIy8jIy8jIyMjJyk7HgZvbkJsdXIFI2phdmFzY3JpcHQ6cmV0dXJuIFZhbGlkYURhdGEodGhpcyk7ZAIhDw8WAh8FAgoWBh8GBQ1yZXR1cm4gZmFsc2U7HwcFOmphdmFzY3JpcHQ6cmV0dXJuIFRleHRib3hfTWFzayhldmVudCwgdGhpcywgJyMjLyMjLyMjIyMnKTsfCAUjamF2YXNjcmlwdDpyZXR1cm4gVmFsaWRhRGF0YSh0aGlzKTtkAiwPDxYCHwUCChYGHwYFDXJldHVybiBmYWxzZTsfBwU6amF2YXNjcmlwdDpyZXR1cm4gVGV4dGJveF9NYXNrKGV2ZW50LCB0aGlzLCAnIyMvIyMvIyMjIycpOx8IBSNqYXZhc2NyaXB0OnJldHVybiBWYWxpZGFEYXRhKHRoaXMpO2QCMg8PFgIfBQIKFgYfBgUNcmV0dXJuIGZhbHNlOx8HBTpqYXZhc2NyaXB0OnJldHVybiBUZXh0Ym94X01hc2soZXZlbnQsIHRoaXMsICcjIy8jIy8jIyMjJyk7HwgFI2phdmFzY3JpcHQ6cmV0dXJuIFZhbGlkYURhdGEodGhpcyk7ZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WBgU3Y3RsMDAkY3BoQ29udGV1ZG8kZnJtQnVzY2FMaWNpdGFjYW8kY2hrQXRhUmVnaXN0cm9QcmVjbwU7Y3RsMDAkY3BoQ29udGV1ZG8kZnJtQnVzY2FMaWNpdGFjYW8kaWJ0RGF0YVB1YmxpY2FjYW9JbmljaW8FOGN0bDAwJGNwaENvbnRldWRvJGZybUJ1c2NhTGljaXRhY2FvJGlidERhdGFQdWJsaWNhY2FvRmltBT9jdGwwMCRjcGhDb250ZXVkbyRmcm1CdXNjYUxpY2l0YWNhbyRpYnREYXRhQWJlcnR1cmFTZXNzYW9JbmljaW8FPGN0bDAwJGNwaENvbnRldWRvJGZybUJ1c2NhTGljaXRhY2FvJGlidERhdGFBYmVydHVyYVNlc3Nhb0ZpbQUtY3RsMDAkY3BoQ29udGV1ZG8kZnJtQnVzY2FMaWNpdGFjYW8kaWJ0QnVzY2FyoRFyIcaS5p2oqaLHfRvCr9Oi1Fo=').
  '&__EVENTVALIDATION='.urlencode('/wEWfALg4ba5BQLsiq+lCgLu46iUDwLu46iUDwLkjIL6AwLjjIL6AwLgjIL6AwLijIL6AwLhjIL6AwLljIL6AwKe2oOwDgKe2oOwDgLKk8bDCALP0OCrCwL26ICtDwLw6NjWAQLs6OzxBgL26OzxBgLu6NjWAQLF7aSQBQLt6MCfBQKvyfvWBwLv6ISuDwKr++qrBQLr6NzXAQL36PTTBwKyyZPzDAKwyee7DwK4ydOABgKrlM7JCAKu6OSPBgLok6b7CwLHk/7TAQK56JD7BgLQk67HAgLM0Jg8As7J37kPAsro6PAGAsiT6rgJAtHQ8OUCAqzJv+UBAq7J67wPAtbQ9MYDAvCpu5EGArDJr8sIAsuT/tMBAt+/6PYCAsSTpqoPAs2Tko8GAqzJx8cOAtCToqkPAsuTvuELArjJo60FAsSTqsYCAt+mwoMLAtmmhpIFAtWm3tsHAtem4rwFAva/3PgBAsK/tCIC/L/4sAoC+L/Q+gwCy5PW/QECy5PWHQLhlP7tBwKdldaXBgLplK7BCALHk9YdAuOU8u8CAp+ViuwIAvHovJ4FAsuTwuILAs2T1h0ChOLwjAwCgOLItg8CjOKg4AEChuKkwQ4C7ZPSHAK4yb/lAQKuyavKCAKuyb/lAQL26LyeBQKp+6adCwLNk/7TAQLK++KpBQKM6ZD7BgLq6NjWAQLu6MS7CQLQk/7TAQLs6MS7CQKsyavKCALs6PDSBwKn+8LVBwKz+9rRDQLQ0MDyAQLs85qjBwLzmpKDCgL89czuBgL89bjtBgL99bjtBgL+9bjtBgL89fDuBgL/9bjtBgL49bjtBgL59bjtBgL69bjtBgLr9bjtBgLk9bjtBgL89fjuBgL89fTuBgLRgNzvCALQgNzvCALTgNzvCAL6saWdCQKL2bj7DgLL1rumAQLJi5adBwLN6IfwBQKeifKlDgLZgrLsCAKSocGOCAKE26KWDQKImoqvBgLayOauA5LPR7NcLZxZFv1iMQgbLvCuSw3Y').
  '&ctl00$cphConteudo$frmBuscaLicitacao$ddlArea='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$ddlSecretaria='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$ddlModalidade='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$ddlStatus=1'.
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtLicitacao='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtProcesso='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtDataPublicacaoInicio='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtDataPublicacaoFim='.
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtDataAberturaSessaoInicio='.urlencode(date('01/01/Y')).
  '&ctl00$cphConteudo$frmBuscaLicitacao$txtDataAberturaSessaoFim='.urlencode($date).
  '&ctl00$cphConteudo$frmBuscaLicitacao$ibtBuscar.x=21'.
  '&ctl00$cphConteudo$frmBuscaLicitacao$ibtBuscar.y=4');//$fields); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_URL,"http://e-negocioscidadesp.prefeitura.sp.gov.br/BuscaLicitacao.aspx");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

  curl_exec($ch);
  curl_close($ch);

  getResultsPage(1);
}

function getResultsPage($pagenum = 1){
  // Inicializando arquivo de cookies
  global $ckfile;
  
  // Nao permito uma pagina menor que 1
  if($pagenum < 1) return;
  // Inicializando os headers da requisicao
  $header = array();
  $header[] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
  $header[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3";
  $header[] = "Accept-Encoding:gzip,deflate,sdch";
  $header[] = "Accept-Language:pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
  $header[] = "Connection:keep-alive";
  $header[] = "Host:e-negocioscidadesp.prefeitura.sp.gov.br";
  $header[] = 'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11"Accept:*/*';
  $ch = curl_init();
  // A primeira pagina DEVE ter o Referer como BuscaLicitacao.aspx
  if($pagenum == 1){

    $header[] = "Referer:http://e-negocioscidadesp.prefeitura.sp.gov.br/BuscaLicitacao.aspx";    
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL,"http://e-negocioscidadesp.prefeitura.sp.gov.br/ResultadoBusca.aspx");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    
    $htmlResult = curl_exec($ch);
    file_put_contents("html1.html",$htmlResult);
  
  // Da segunda em diante, pode ter o referer como ResultadoBusca.aspx
  }else{
    $header[] = "Referer:http://e-negocioscidadesp.prefeitura.sp.gov.br/ResultadoBusca.aspx";
    $html = str_get_html(file_get_contents("html".($pagenum-1).".html"));
    
    $__VIEWSTATE = $html->find("form#aspnetForm input#__VIEWSTATE",0)->value;
    $__EVENTVALIDATION = $html->find("form#aspnetForm input#__EVENTVALIDATION",0)->value;

    // Setando os campos que serao enviados no POST
    curl_setopt($ch,CURLOPT_POSTFIELDS,
    'ctl00$ajaxMaster=ctl00$cphConteudo$ajaxForm|ctl00$cphConteudo$gdvResultadoBusca$pgrGridView$btrNext$lbtText'.
    '&__EVENTTARGET='.urlencode('ctl00$cphConteudo$gdvResultadoBusca$pgrGridView$btrNext$lbtText').
    '&__EVENTARGUMENT='.
    '&__VIEWSTATE='.urlencode($__VIEWSTATE).
    '&__EVENTVALIDATION='.urlencode($__EVENTVALIDATION));
    
    curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL,"http://e-negocioscidadesp.prefeitura.sp.gov.br/ResultadoBusca.aspx");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    
    $htmlResult = curl_exec($ch);
    file_put_contents("html".$pagenum.".html",$htmlResult);
  }
  extractInfoFromHTML($pagenum);
}
/**
 * Funcao que le o HTML e extrai as informacoes pra colocar na base de dados
 */ 
function extractInfoFromHTML($pagenum = 1){
  $html = str_get_html(file_get_contents("html".$pagenum.".html"));
  
  $inserts = array();
  
  // Tem uma tabela com class grid-resultado que armazena os resultados
  $licitacoes = $html->find('.grid-resultado tr');
  if(empty($licitacoes))
    throw new Exception("Não existe uma tabela .grid-resultado");
  
  foreach($licitacoes as $key => $l){
    // Pulando a primeira linha que contem os cabecalhos
    if($key == 0) continue;
    // Recebo os dados de cada linha numa lista de variaveis
    list($nrPublicacao,$licitador,$modalidade,$dataAbertura,$objeto) = $l->find('td');
    
    // Tratamento dos dados para serem inseridos no banco de dados
    $nrPublicacao = mysql_escape_string($nrPublicacao->childNodes(0)->innertext);
    $licitador = mysql_escape_string(html_entity_decode($licitador->innertext));
    $modalidade = getModalidade(utf8_encode(html_entity_decode($modalidade->innertext)));
    $dataAbertura = $dataAbertura->find('span');
    list($data,$hora) = explode(" ",$dataAbertura[0]->innertext);
    
    list($dia,$mes,$ano) = explode("/",$data);
    $dataAbertura = "$ano-$mes-$dia";
    $objeto = mysql_escape_string(html_entity_decode($objeto->innertext));
    $objetoFree = str_ireplace("Sao Paulo","xxxx",normalize($objeto));
    $aviso = substr($objeto,0,120);
    if(strlen($objeto)>120)
      $aviso .= "...";
    $avisoFree = str_ireplace("São Paulo","xxxx",normalize($aviso));
    
    $inserts[] = "('{$nrPublicacao}','{$licitador}','{$objeto}','{$objetoFree}','{$dataAbertura}','{$aviso}','{$avisoFree}',2,'{$modalidade}')";
  }

  // Inserindo na base de dados os novos registros
  $sql = "INSERT INTO licitacoes(protocolo,interessado,objeto,objeto_free,publicado_em,aviso,aviso_free,id_cidade,modalidade) VALUES ";
  if(count($inserts) > 0){
    $sql .= implode(",",$inserts);
    $conexao = new mysqli("localhost","root","root","pds_crawler");
    $conexao->query($sql);
  }
  // Verificando se tem mais paginas
  if(!isset($html->find("#ctl00_cphConteudo_gdvResultadoBusca_pgrGridView_btrNext",0)->disabled)){
    //echo 'ae';
    getResultsPage($pagenum+1);
  }
}
function normalize($str){
  $a = array("ã","â","á","à","ä","Ã","Â","Á","À","Ä");
  $e = array("ẽ","ê","é","è","ë","Ẽ","Ê","É","È","Ë");
  $i = array("í","ì","ĩ","î","ï","Í","Ì","Ĩ","Î","Ï");
  $o = array("ó","ò","õ","ô","ö","Ó","Ò","Õ","Ô","Ö");
  $u = array("ú","ù","û","ũ","ü","Ú","Ù","Û","Ũ","Ü");
  $c = array("ç","Ç");
  $str = utf8_encode($str);
  foreach($a as $v) $str = str_replace($v,"a",$str);
  foreach($e as $v) $str = str_replace($v,"e",$str);
  foreach($i as $v) $str = str_replace($v,"i",$str);
  foreach($o as $v) $str = str_replace($v,"o",$str);
  foreach($u as $v) $str = str_replace($v,"u",$str);
  foreach($c as $v) $str = str_replace($v,"c",$str);

  $str = strtolower(trim($str));
  return utf8_decode($str);
}
function getModalidade($key){
  $arr = array(
    'COMPRA POR ATA DE REGISTRO DE PREÇO'=> 'registro_preco',
    'CONCORRÊNCIA' => 'concorrencia',
    'CONCURSO' => 'concurso',
    'CONSULTA PÚBLICA' => 'consulta_publica',
    'CONVÊNIO' => 'convenio',
    'CONVITE' => 'convite',
    'DISPENSA' => 'dispensa',
    'INEXIGIBILIDADE' => 'inexigibilidade',
    'LEILÃO' => 'leilao',
    'PREGÃO' => 'pregao',
    'PREGÃO ELETRÔNICO' => 'pregao_eletronico',
    'PREGÃO PRESENCIAL' => 'pregao_presencial',
    'TOMADA DE PREÇOS' => 'tomada_precos'
  );
  return $arr[$key];
}
// limpando o arquivo de cookies
unlink($ckfile);