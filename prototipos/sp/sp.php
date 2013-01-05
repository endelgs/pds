<?php
//error_reporting(E_ALL);
error_reporting(0);
header("Content-type: text/html; charset:utf-8");
include "../html_dom/simple_html_dom.php";
$ckfile = tempnam ("/home/endel/www/pds/crawlers/saopaulo/cookie", "CURLCOOKIE");

//setCookie();
grabWebPage();
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
 
  $header[] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
  $header[] = "Accept-Encoding:gzip,deflate,sdch";
  $header[] = "Accept-Language:pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4";
  $header[] = "Cache-Control:max-age=0"; 
  $header[] = "Connection:keep-alive";
  $header[] = "Content-Type:application/x-www-form-urlencoded";
  $header[] = "Host:www.imprensaoficial.com.br";
  $header[] = "Referer:http://www.imprensaoficial.com.br/PortalIO/ENegocios/BuscaENegocios_14_1.aspx#".date('d/m/Y');
  $header[] = "User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11";

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
  '__EVENTTARGET='.
  '&__EVENTARGUMENT='.
  '&__VIEWSTATE='.urlencode('dDwtOTE2MzExMDU2O3Q8O2w8aTwwPjs+O2w8dDw7bDxpPDI+O2k8Nj47aTw3PjtpPDg+O2k8OT47aTwxMD47aTwxMT47aTwxMz47PjtsPHQ8O2w8aTw1Pjs+O2w8dDxwPDtwPGw8b25jbGljazs+O2w8amF2YXNjcmlwdDp2YXIgd2luXDt3aW4gPSB3aW5kb3cub3BlbigiaHR0cDovL2xpdnJhcmlhLmltcHJlbnNhb2ZpY2lhbC5jb20uYnIiLCJXaW5kb3ciLCAiIilcOzs+Pj47Oz47Pj47dDw7bDxpPDA+O2k8Mj47PjtsPHQ8dDxwPDtwPGw8b25jaGFuZ2U7PjtsPGphdmFzY3JpcHQ6Q2FycmVnYVN1YmFyZWFzTmVnb2Npb3MoKVw7Oz4+Pjs7Pjs7Pjt0PHA8O3A8bDxvbktleVVwOz47bDxEZXNhYmlsaXRhSGFiaWxpdGFDb21ib05lZ29jaW9zKCk7Pj4+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDI+Oz47bDx0PHQ8cDw7cDxsPG9uY2hhbmdlOz47bDxqYXZhc2NyaXB0OkNhcnJlZ2FTdWJhcmVhcygpXDs7Pj4+Ozs+Ozs+O3Q8cDw7cDxsPG9uS2V5VXA7PjtsPERlc2FiaWxpdGFIYWJpbGl0YUNvbWJvTGljaXRhZG9yKCk7Pj4+Ozs+Oz4+O3Q8O2w8aTwzPjtpPDU+Oz47bDx0PHQ8cDxwPGw8RGF0YVRleHRGaWVsZDtEYXRhVmFsdWVGaWVsZDs+O2w8ZGVzY3JpY2FvO21vZGFsaWRhZGU7Pj47Pjt0PGk8MTQ+O0A8XGU7Q09NUFJBIFBPUiBBVEEgREUgUkVHSVNUUk8gREUgUFJFw4dPO0NPTkNPUlLDik5DSUE7Q09OQ1VSU087Q09OU1VMVEEgUMOaQkxJQ0E7Q09OVsOKTklPO0NPTlZJVEU7RElTUEVOU0E7SU5FWElHSUJJTElEQURFO0xFSUzDg087UFJFR8ODTztQUkVHw4NPIEVMRVRSw5ROSUNPO1BSRUfDg08gUFJFU0VOQ0lBTDtUT01BREEgREUgUFJFw4dPUzs+O0A8XGU7MTM7MTsyOzM7MTI7NDs1OzY7Nzs4Ozk7MTA7MTE7Pj47Pjs7Pjt0PHQ8cDxwPGw8RGF0YVRleHRGaWVsZDtEYXRhVmFsdWVGaWVsZDs+O2w8dGV4dG87SUQ7Pj47Pjt0PGk8NjUwPjtAPFxlO0FkYW1hbnRpbmE7QWRvbGZvO0FndWHDrTvDgWd1YXMgZGEgUHJhdGE7w4FndWFzIGRlIExpbmTDs2lhO8OBZ3VhcyBkZSBTYW50YSBCw6FyYmFyYTvDgWd1YXMgZGUgU8OjbyBQZWRybztBZ3Vkb3M7QWxhbWJhcmk7QWxmcmVkbyBNYXJjb25kZXM7QWx0YWlyO0FsdGluw7Nwb2xpcztBbHRvIEFsZWdyZTtBbHVtw61uaW87w4FsdmFyZXMgRmxvcmVuY2U7w4FsdmFyZXMgTWFjaGFkbzvDgWx2YXJvIGRlIENhcnZhbGhvO0FsdmlubMOibmRpYTtBbWVyaWNhbmE7QW3DqXJpY28gQnJhc2lsaWVuc2U7QW3DqXJpY28gZGUgQ2FtcG9zO0FtcGFybztBbmFsw6JuZGlhO0FuZHJhZGluYTtBbmdhdHViYTtBbmhlbWJpO0FuaHVtYXM7QXBhcmVjaWRhO0FwYXJlY2lkYSBEJ09lc3RlO0FwaWHDrTtBcmHDp2FyaWd1YW1hO0FyYcOnYXR1YmE7QXJhw6dvaWFiYSBkYSBTZXJyYTtBcmFtaW5hO0FyYW5kdTtBcmFwZcOtO0FyYXJhcXVhcmE7QXJhcmFzO0FyY28tw41yaXM7QXJlYWx2YTtBcmVpYXM7QXJlacOzcG9saXM7QXJpcmFuaGE7QXJ0dXIgTm9ndWVpcmE7QXJ1asOhO0FzcMOhc2lhO0Fzc2lzO0F0aWJhaWE7QXVyaWZsYW1hO0F2YcOtO0F2YW5oYW5kYXZhO0F2YXLDqTtCYWR5IEJhc3NpdHQ7QmFsYmlub3M7QsOhbHNhbW87QmFuYW5hbDtCYXLDo28gZGUgQW50b25pbmE7QmFyYm9zYTtCYXJpcmk7QmFycmEgQm9uaXRhO0JhcnJhIGRvIENoYXDDqXU7QmFycmEgZG8gVHVydm87QmFycmV0b3M7QmFycmluaGE7QmFydWVyaTtCYXN0b3M7QmF0YXRhaXM7QmF1cnU7QmViZWRvdXJvO0JlbnRvIGRlIEFicmV1O0Jlcm5hcmRpbm8gZGUgQ2FtcG9zO0JlcnRpb2dhO0JpbGFjO0JpcmlndWk7QmlyaXRpYmEtTWlyaW07Qm9hIEVzcGVyYW7Dp2EgZG8gU3VsO0JvY2FpbmE7Qm9mZXRlO0JvaXR1dmE7Qm9tIEplc3VzIGRvcyBQZXJkw7VlcztCb20gU3VjZXNzbyBkZSBJdGFyYXLDqTtCb3LDoTtCb3JhY8OpaWE7Qm9yYm9yZW1hO0JvcmViaTtCb3R1Y2F0dTtCcmFnYW7Dp2EgUGF1bGlzdGE7QnJhw7puYTtCcmVqbyBBbGVncmU7QnJvZG93c2tpO0Jyb3RhcztCdXJpO0J1cml0YW1hO0J1cml0aXphbDtDYWJyw6FsaWEgUGF1bGlzdGE7Q2FicmXDunZhO0Nhw6dhcGF2YTtDYWNob2VpcmEgUGF1bGlzdGE7Q2Fjb25kZTtDYWZlbMOibmRpYTtDYWlhYnU7Q2FpZWlyYXM7Q2FpdcOhO0NhamFtYXI7Q2FqYXRpO0Nham9iaTtDYWp1cnU7Q2FtcGluYSBkbyBNb250ZSBBbGVncmU7Q2FtcGluYXM7Q2FtcG8gTGltcG8gUGF1bGlzdGE7Q2FtcG9zIGRvIEpvcmTDo287Q2FtcG9zIE5vdm9zIFBhdWxpc3RhO0NhbmFuw6lpYTtDYW5hcztDw6JuZGlkbyBNb3RhO0PDom5kaWRvIFJvZHJpZ3VlcztDYW5pdGFyO0NhcMOjbyBCb25pdG87Q2FwZWxhIGRvIEFsdG87Q2FwaXZhcmk7Q2FyYWd1YXRhdHViYTtDYXJhcGljdcOtYmE7Q2FyZG9zbztDYXNhIEJyYW5jYTtDw6Fzc2lhIGRvcyBDb3F1ZWlyb3M7Q2FzdGlsaG87Q2F0YW5kdXZhO0NhdGlndcOhO0NlZHJhbDtDZXJxdWVpcmEgQ8Opc2FyO0NlcnF1aWxobztDZXPDoXJpbyBMYW5nZTtDaGFycXVlYWRhO0NoYXZhbnRlcztDbGVtZW50aW5hO0NvbGluYTtDb2zDtG1iaWE7Q29uY2hhbDtDb25jaGFzO0NvcmRlaXLDs3BvbGlzO0Nvcm9hZG9zO0Nvcm9uZWwgTWFjZWRvO0NvcnVtYmF0YcOtO0Nvc23Ds3BvbGlzO0Nvc21vcmFtYTtDb3RpYTtDcmF2aW5ob3M7Q3Jpc3RhaXMgUGF1bGlzdGE7Q3J1esOhbGlhO0NydXplaXJvO0N1YmF0w6NvO0N1bmhhO0Rlc2NhbHZhZG87RGlhZGVtYTtEaXJjZSBSZWlzO0Rpdmlub2zDom5kaWE7RG9icmFkYTtEb2lzIEPDs3JyZWdvcztEb2xjaW7Ds3BvbGlzO0RvdXJhZG87RHJhY2VuYTtEdWFydGluYTtEdW1vbnQ7RWNoYXBvcsOjO0VsZG9yYWRvO0VsaWFzIEZhdXN0bztFbGlzacOhcmlvO0VtYmHDumJhO0VtYnU7RW1idS1HdWHDp3U7RW1pbGlhbsOzcG9saXM7RW5nZW5oZWlybyBDb2VsaG87RXNww61yaXRvIFNhbnRvIGRvIFBpbmhhbDtFc3DDrXJpdG8gU2FudG8gZG8gVHVydm87RXN0aXZhIEdlcmJpO0VzdHJlbGEgRCdPZXN0ZTtFc3RyZWxhIGRvIE5vcnRlO0V1Y2xpZGVzIGRhIEN1bmhhIFBhdWxpc3RhO0ZhcnR1cmE7RmVybmFuZG8gUHJlc3RlcztGZXJuYW5kw7Nwb2xpcztGZXJuw6NvO0ZlcnJheiBkZSBWYXNjb25jZWxvcztGbG9yYSBSaWNhO0Zsb3JlYWw7RmzDs3JpZGEgUGF1bGlzdGE7RmxvcsOtbmlhO0ZyYW5jYTtGcmFuY2lzY28gTW9yYXRvO0ZyYW5jbyBkYSBSb2NoYTtHYWJyaWVsIE1vbnRlaXJvO0fDoWxpYTtHYXLDp2E7R2FzdMOjbyBWaWRpZ2FsO0dhdmnDo28gUGVpeG90bztHZW5lcmFsIFNhbGdhZG87R2V0dWxpbmE7R2xpY8OpcmlvO0d1YWnDp2FyYTtHdWFpbWLDqjtHdWHDrXJhO0d1YXBpYcOndTtHdWFwaWFyYTtHdWFyw6E7R3VhcmHDp2HDrTtHdWFyYWNpO0d1YXJhbmkgRCdPZXN0ZTtHdWFyYW50w6M7R3VhcmFyYXBlcztHdWFyYXJlbWE7R3VhcmF0aW5ndWV0w6E7R3VhcmXDrTtHdWFyaWJhO0d1YXJ1asOhO0d1YXJ1bGhvcztHdWF0YXBhcsOhO0d1em9sw6JuZGlhO0hlcmN1bMOibmRpYTtIb2xhbWJyYTtIb3J0b2zDom5kaWE7SWFjYW5nYTtJYWNyaTtJYXJhcztJYmF0w6k7SWJpcsOhO0liaXJhcmVtYTtJYml0aW5nYTtJYmnDum5hO0ljw6ltO0llcMOqO0lnYXJhw6d1IGRvIFRpZXTDqjtJZ2FyYXBhdmE7SWdhcmF0w6E7SWd1YXBlO0lsaGEgQ29tcHJpZGE7SWxoYSBTb2x0ZWlyYTtJbGhhYmVsYTtJbmRhaWF0dWJhO0luZGlhbmE7SW5kaWFwb3LDoztJbsO6YmlhIFBhdWxpc3RhO0lwYXVzc3U7SXBhdXNzdTtJcGVyw7M7SXBlw7puYTtJcGlndcOhO0lwb3JhbmdhO0lwdcOjO0lyYWNlbcOhcG9saXM7SXJhcHXDoztJcmFwdXJ1O0l0YWJlcsOhO0l0YcOtO0l0YWpvYmk7SXRhanU7SXRhbmhhw6ltO0l0YcOzY2E7SXRhcGVjZXJpY2EgZGEgU2VycmE7SXRhcGV0aW5pbmdhO0l0YXBldmE7SXRhcGV2aTtJdGFwaXJhO0l0YXBpcmFwdcOjIFBhdWxpc3RhO0l0w6Fwb2xpcztJdGFwb3JhbmdhO0l0YXB1w607SXRhcHVyYTtJdGFxdWFxdWVjZXR1YmE7SXRhcmFyw6k7SXRhcmlyaTtJdGF0aWJhO0l0YXRpbmdhO0l0aXJhcGluYTtJdGlyYXB1w6M7SXRvYmk7SXR1O0l0dXBldmE7SXR1dmVyYXZhO0phYm9yYW5kaTtKYWJvdGljYWJhbDtKYWNhcmXDrTtKYWNpO0phY3VwaXJhbmdhO0phZ3VhcmnDum5hO0phbGVzO0phbWJlaXJvO0phbmRpcmE7SmFyZGluw7Nwb2xpcztKYXJpbnU7SmHDujtKYcO6O0plcmlxdWFyYTtKb2Fuw7Nwb2xpcztKb8OjbyBSYW1hbGhvO0pvc8OpIEJvbmlmw6FjaW87SsO6bGlvIE1lc3F1aXRhO0p1bWlyaW07SnVuZGlhw607SnVucXVlaXLDs3BvbGlzO0p1cXVpw6E7SnVxdWl0aWJhO0xhZ29pbmhhO0xhcmFuamFsIFBhdWxpc3RhO0xhdsOtbmlhO0xhdnJpbmhhcztMZW1lO0xlbsOnw7NpcyBQYXVsaXN0YTtMaW1laXJhO0xpbmTDs2lhO0xpbnM7TG9yZW5hO0xvdXJkZXM7TG91dmVpcmE7THVjw6lsaWE7THVjaWFuw7Nwb2xpcztMdcOtcyBBbnTDtG5pbztMdWl6acOibmlhO0x1cMOpcmNpbztMdXTDqWNpYTtNYWNhdHViYTtNYWNhdWJhbDtNYWNlZMO0bmlhO01hZ2RhO01haXJpbnF1ZTtNYWlyaXBvcsOjO01hbmR1cmk7TWFyYWLDoSBQYXVsaXN0YTtNYXJhY2HDrTtNYXJhcG9hbWE7TWFyacOhcG9saXM7TWFyw61saWE7TWFyaW7Ds3BvbGlzO01hcnRpbsOzcG9saXM7TWF0w6NvO01hdcOhO01lbmRvbsOnYTtNZXJpZGlhbm87TWVzw7Nwb2xpcztNaWd1ZWzDs3BvbGlzO01pbmVpcm9zIGRvIFRpZXTDqjtNaXJhIEVzdHJlbGE7TWlyYWNhdHU7TWlyYW5kw7Nwb2xpcztNaXJhbnRlIGRvIFBhcmFuYXBhbmVtYTtNaXJhc3NvbDtNaXJhc3NvbMOibmRpYTtNb2NvY2E7TU9HSSBEQVMgQ1JVWkVTO01vZ2kgR3Vhw6d1O01vZ2kgR3Vhw6d1O01vamktTWlyaW07TW9tYnVjYTtNb27Dp8O1ZXM7TW9uZ2FndcOhO01vbnRlIEFsZWdyZSBkbyBTdWw7TW9udGUgQWx0bztNb250ZSBBcHJhesOtdmVsO01vbnRlIEF6dWwgUGF1bGlzdGE7TW9udGUgQ2FzdGVsbztNb250ZSBNb3I7TW9udGVpcm8gTG9iYXRvO01vcnJvIEFndWRvO01vcnVuZ2FiYTtNb3R1Y2E7TXVydXRpbmdhIGRvIFN1bDtOYW50ZXM7TsOjbyBEZWZpbmlkYTtOYXJhbmRpYmE7TmF0aXZpZGFkZSBkYSBTZXJyYTtOYXphcsOpIFBhdWxpc3RhO05ldmVzIFBhdWxpc3RhO05oYW5kZWFyYTtOaXBvw6M7Tm92YSBBbGlhbsOnYTtOb3ZhIENhbXBpbmE7Tm92YSBDYW5hw6MgUGF1bGlzdGE7Tm92YSBDYXN0aWxobztOb3ZhIEV1cm9wYTtOb3ZhIEdyYW5hZGE7Tm92YSBHdWF0YXBvcmFuZ2E7Tm92YSBJbmRlcGVuZMOqbmNpYTtOb3ZhIEx1eml0w6JuaWE7Tm92YSBPZGVzc2E7Tm92YWlzO05vdm8gSG9yaXpvbnRlO051cG9yYW5nYTtPY2F1w6d1O8OTbGVvO09sw61tcGlhO09uZGEgVmVyZGU7T3JpZW50ZTtPcmluZGnDunZhO09ybMOibmRpYTtPc2FzY287T3NjYXIgQnJlc3NhbmU7T3N2YWxkbyBDcnV6O091cmluaG9zO091cm8gVmVyZGU7T3Vyb2VzdGU7UGFjYWVtYnU7UGFsZXN0aW5hO1BhbG1hcmVzIFBhdWxpc3RhO1BhbG1laXJhIEQnT2VzdGU7UGFsbWl0YWw7UGFub3JhbWE7UGFyYWd1YcOndSBQYXVsaXN0YTtQYXJhaWJ1bmE7UGFyYcOtc287UGFyYW5hcGFuZW1hO1BhcmFuYXB1w6M7UGFyYXB1w6M7UGFyZGluaG87UGFyaXF1ZXJhLUHDp3U7UGFyaXNpO1BhdHJvY8OtbmlvIFBhdWxpc3RhO1BhdWxpY8OpaWE7UGF1bMOtbmlhO1BhdWxpc3TDom5pYTtQYXVsbyBkZSBGYXJpYTtQZWRlcm5laXJhcztQZWRyYSBCZWxhO1BlZHJhbsOzcG9saXM7UGVkcmVndWxobztQZWRyZWlyYTtQZWRyaW5oYXMgUGF1bGlzdGE7UGVkcm8gZGUgVG9sZWRvO1BlbsOhcG9saXM7UGVyZWlyYSBCYXJyZXRvO1BlcmVpcmFzO1BlcnXDrWJlO1BpYWNhdHU7UGllZGFkZTtQaWxhciBkbyBTdWw7UGluZGFtb25oYW5nYWJhO1BpbmRvcmFtYTtQaW5oYWx6aW5obztQaXF1ZXJvYmk7UGlxdWV0ZTtQaXJhY2FpYTtQaXJhY2ljYWJhO1BpcmFqdTtQaXJhanXDrTtQaXJhbmdpO1BpcmFwb3JhIGRvIEJvbSBKZXN1cztQaXJhcG96aW5obztQaXJhc3N1bnVuZ2E7UGlyYXRpbmluZ2E7UGl0YW5ndWVpcmFzO1BsYW5hbHRvO1BsYXRpbmE7UG/DoTtQb2xvbmk7UG9tcMOpaWE7UG9uZ2HDrTtQb250YWw7UG9udGFsaW5kYTtQb250ZXMgR2VzdGFsO1BvcHVsaW5hO1BvcmFuZ2FiYTtQb3J0byBGZWxpejtQb3J0byBGZXJyZWlyYTtQb3RpbTtQb3RpcmVuZGFiYTtQcmFjaW5oYTtQcmFkw7Nwb2xpcztQcmFpYSBHcmFuZGU7UHJhdMOibmlhO1ByZXNpZGVudGUgQWx2ZXM7UHJlc2lkZW50ZSBCZXJuYXJkZXM7UHJlc2lkZW50ZSBFcGl0w6FjaW87UHJlc2lkZW50ZSBQcnVkZW50ZTtQcmVzaWRlbnRlIFZlbmNlc2xhdTtQcm9taXNzw6NvO1F1YWRyYTtRdWF0w6E7UXVlaXJvejtRdWVsdXo7UXVpbnRhbmE7UmFmYXJkO1JhbmNoYXJpYTtSZWRlbsOnw6NvIGRhIFNlcnJhO1JlZ2VudGUgRmVpasOzO1JlZ2luw7Nwb2xpcztSZWdpc3RybztSZXN0aW5nYTtSaWJlaXJhO1JpYmVpcsOjbyBCb25pdG87UmliZWlyw6NvIEJyYW5jbztSaWJlaXLDo28gQ29ycmVudGU7UmliZWlyw6NvIGRvIFN1bDtSaWJlaXLDo28gZG9zIMONbmRpb3M7UmliZWlyw6NvIEdyYW5kZTtSaWJlaXLDo28gUGlyZXM7UmliZWlyw6NvIFByZXRvO1JpZmFpbmE7UmluY8OjbztSaW7Ds3BvbGlzO1JpbyBDbGFybztSaW8gZGFzIFBlZHJhcztSaW8gR3JhbmRlIGRhIFNlcnJhO1Jpb2zDom5kaWE7Uml2ZXJzdWw7Um9zYW5hO1Jvc2VpcmE7UnViacOhY2VhO1J1Ymluw6lpYTtTYWJpbm87U2FncmVzO1NhbGVzO1NhbGVzIE9saXZlaXJhO1NhbGVzw7Nwb2xpcztTYWxtb3Vyw6NvO1NhbHRpbmhvO1NhbHRvO1NhbHRvIGRlIFBpcmFwb3JhO1NhbHRvIEdyYW5kZTtTYW5kb3ZhbGluYTtTYW50YSBBZMOpbGlhO1NhbnRhIEFsYmVydGluYTtTYW50YSBCw6FyYmFyYSBET2VzdGU7U2FudGEgQnJhbmNhO1NhbnRhIENsYXJhIEQnT2VzdGU7U2FudGEgQ3J1eiBkYSBDb25jZWnDp8OjbztTYW50YSBDcnV6IGRhIEVzcGVyYW7Dp2E7U2FudGEgQ3J1eiBkYXMgUGFsbWVpcmFzO1NhbnRhIENydXogZG8gUmlvIFBhcmRvO1NhbnRhIEVybmVzdGluYTtTYW50YSBGw6kgZG8gU3VsO1NhbnRhIEdlcnRydWRlcztTYW50YSBJc2FiZWw7U2FudGEgTMO6Y2lhO1NhbnRhIE1hcmlhIGRhIFNlcnJhO1NhbnRhIE1lcmNlZGVzO1NhbnRhIFJpdGEgRCdPZXN0ZTtTYW50YSBSaXRhIGRvIFBhc3NhIFF1YXRybztTYW50YSBSb3NhIGRlIFZpdGVyYm87U2FudGEgU2FsZXRlO1NhbnRhbmEgZGEgUG9udGUgUGVuc2E7U2FudGFuYSBkZSBQYXJuYcOtYmE7U2FudG8gQW5hc3TDoWNpbztTYW50byBBbmRyw6k7U2FudG8gQW50w7RuaW8gZGEgQWxlZ3JpYTtTYW50byBBbnTDtG5pbyBkZSBQb3NzZTtTYW50byBBbnTDtG5pbyBkbyBBcmFjYW5ndcOhO1NhbnRvIEFudMO0bmlvIGRvIEphcmRpbTtTYW50byBBbnTDtG5pbyBkbyBQaW5oYWw7U2FudG8gRXhwZWRpdG87U2FudMOzcG9saXMgZG8gQWd1YXBlw607U2FudG9zO1PDo28gQmVudG8gZG8gU2FwdWNhw607U8OjbyBCZXJuYXJkbyBkbyBDYW1wbztTw6NvIENhZXRhbm8gZG8gU3VsO1PDo28gQ2FybG9zO1PDo28gRnJhbmNpc2NvO1PDo28gSm/Do28gZGEgQm9hIFZpc3RhO1PDo28gSm/Do28gZGFzIER1YXMgUG9udGVzO1PDo28gSm/Do28gZGUgSXJhY2VtYTtTw6NvIEpvw6NvIGRvIFBhdSBEJ0FsaG87U8OjbyBKb2FxdWltIGRhIEJhcnJhO1PDo28gSm9zw6kgZGEgQmVsYSBWaXN0YTtTw6NvIEpvc8OpIGRvIEJhcnJlaXJvO1PDo28gSm9zw6kgZG8gUmlvIFBhcmRvO1PDo28gSm9zw6kgZG8gUmlvIFByZXRvO1PDo28gSm9zw6kgZG9zIENhbXBvcztTw6NvIExvdXJlbsOnbyBkYSBTZXJyYTtTw6NvIEx1w61zIGRvIFBhcmFpdGluZ2E7U8OjbyBNYW51ZWw7U8OjbyBNaWd1ZWwgQXJjYW5qbztTw6NvIFBhdWxvO1PDo28gUGVkcm87U8OjbyBQZWRybyBkbyBUdXJ2bztTw6NvIFJvcXVlO1PDo28gU2ViYXN0acOjbztTw6NvIFNlYmFzdGnDo28gZGEgR3JhbWE7U8OjbyBTaW3Do287U8OjbyBWaWNlbnRlO1NhcmFwdcOtO1NhcnV0YWnDoTtTZWJhc3RpYW7Ds3BvbGlzIGRvIFN1bDtTZXJyYSBBenVsO1NlcnJhIE5lZ3JhO1NlcnJhbmE7U2VydMOjb3ppbmhvO1NldGUgQmFycmFzO1NldmVyw61uaWE7U2lsdmVpcmFzO1NvY29ycm87U29yb2NhYmE7U3VkIE1lbm51Y2NpO1N1bWFyw6k7U3V6YW7DoXBvbGlzO1N1emFubztUYWJhcHXDoztUYWJhdGluZ2E7VGFib8OjbyBkYSBTZXJyYTtUYWNpYmE7VGFndWHDrTtUYWlhw6d1O1RhacO6dmE7VGFtYmHDujtUYW5hYmk7VGFwaXJhw607VGFwaXJhdGliYTtUYXF1YXJhbDtUYXF1YXJpdGluZ2E7VGFxdWFyaXR1YmE7VGFxdWFyaXZhw607VGFyYWJhaTtUYXJ1bcOjO1RhdHXDrTtUYXViYXTDqTtUZWp1cMOhO1Rlb2Rvcm8gU2FtcGFpbztUZXJyYSBSb3hhO1RpZXTDqjtUaW1idXJpO1RvcnJlIGRlIFBlZHJhO1RvcnJpbmhhO1RyYWJpanU7VHJlbWVtYsOpO1Ryw6pzIEZyb250ZWlyYXM7VHVpdXRpO1R1cMOjO1R1cGkgUGF1bGlzdGE7VHVyacO6YmE7VHVybWFsaW5hO1ViYXJhbmE7VWJhdHViYTtVYmlyYWphcmE7VWNob2E7VW5pw6NvIFBhdWxpc3RhO1Vyw6JuaWE7VXJ1O1VydXDDqnM7VmFsZW50aW0gR2VudGlsO1ZhbGluaG9zO1ZhbHBhcmHDrXNvO1ZhcmdlbTtWYXJnZW0gR3JhbmRlIGRvIFN1bDtWYXJnZW0gR3JhbmRlIFBhdWxpc3RhO1bDoXJ6ZWEgUGF1bGlzdGE7VmVyYSBDcnV6O1ZpbmhlZG87VmlyYWRvdXJvO1Zpc3RhIEFsZWdyZSBkbyBBbHRvO1ZpdMOzcmlhIEJyYXNpbDtWb3RvcmFudGltO1ZvdHVwb3JhbmdhO1phY2FyaWFzOz47QDxcZTs1ODc2OzU5MTk7NTk2Mjs1OTk4OzYwMzI7NjA1NTs2MDYzOzYxMTU7NjExOTs2MTQxOzYxNjk7NjE5Mjs2MjE3OzYyMzE7NjI0Mzs2MjY5OzYyOTM7NjM0Mjs2MzY4OzYzOTU7NjQyMzs2NDUyOzY0Nzk7NjUxMzs2NTQyOzY1ODg7NjYxNDs2NjM5OzY2Njk7NjY5Njs2NzA4OzY3MjU7Njc1MTs2NzY1OzY4MTU7NjgyMjs2ODQ1OzY4Nzc7Njg4Njs2OTA2OzY5MzU7Njk2MDs2OTgyOzcwMDc7NzAzMzs3MDU0OzcwODE7NzExMzs3MTQyOzcxNzE7NzE5NDs3MjIwOzcyNDY7NzI4MDs3MzAwOzczNDM7NzM2NDs3Mzg4Ozc0MjU7NzQ1MDs3NDY2Ozc0Nzc7NzUwODs3NTYxOzc1ODQ7NzYwMTs3NjIyOzc2NDM7NzY2Mjs3NjkwOzc3MTk7Nzc0NTs3NzY1Ozc3ODk7NzgxMTs3ODM1Ozc4NTg7Nzg4MDs3ODk2Ozc5MTQ7NzkzNjs3OTU2Ozc5ODE7ODAwMzs4MDA4OzgwMjU7ODA1Mjs4MDc3OzgwODk7ODEwNTs4MTI5OzgxNjg7ODE5MTs4MjA5OzgyMzE7ODI1MTs4MjcyOzgyODk7ODMwNTs4MzE4OzgzMzU7ODM2NTs4MzgxOzg0MDI7ODQwOTs4NDIyOzg0Mzk7ODQ1MDs4NDYwOzg0NzQ7ODQ4ODs4NTE3Ozg1MzI7ODUzODs4NTQ4Ozg1Njc7ODU3Mzs4NTgwOzg1OTc7ODYxNDs4NjI4Ozg2NTc7ODY3Njs4NjkzOzg3MTI7ODcyNTs4NzQ0Ozg3NTg7ODc3ODs4ODAzOzg4MTk7ODgzNjs4ODU0OzExMjA1Ozg4OTA7ODkwMzs4OTIwOzg5NDY7ODk2NDs4OTc5Ozg5OTk7OTAxMTs5MDI4OzkwNDY7OTA1OTs5MDgxOzkwOTc7OTExMDs5MTIyOzkxMzk7OTE1Njs5MTY4OzkxODE7OTE5Njs5MjA2OzkyMDk7OTIzNzs5MjUzOzkyNjY7OTI3Njs5Mjg1OzkzMDI7OTMxNTs5MzI1OzkzNDg7OTM2MTs5MzYzOzkzNjQ7OTM3MDs5Mzg0OzkzODk7OTM5Mzs5Mzk2OzkzOTc7MTEyMDk7OTQwMTs5NDEyOzk0MjE7OTQyNzs5NDYwOzk0NTA7OTQ2NDs5NDc2Ozk0ODk7OTQ5ODs5NTA4Ozk1MTg7OTUyODs5NTQ3Ozk1NTY7OTU3MDs5NTc3Ozk1ODU7OTU5NTs5NjAwOzk2MDQ7OTYxMzs5NjI5Ozk2Mzg7OTY1Mzs5NjYxOzk2Njk7OTY3Nzs5NjgzOzk2OTM7OTcwMDs5NzE1Ozk3MjQ7OTczMDs5NzM4Ozk3NDg7OTc2NDs5NzczOzk3ODI7OTc5Mzs5ODA0Ozk4MTU7OTgyMzs5ODI1Ozk4Mjc7OTgzMjs5ODQ0Ozk4NDk7OTg1Mzs5ODY1Ozk4NzI7OTg3OTs5ODkzOzk5MDU7OTkxMjs5OTIwOzk5Mjg7OTkzOTs5OTQ5Ozk5NjQ7OTk2NTs5OTU4Ozk5NzU7OTk4Mzs5OTk0Ozk5OTk7MTAwMDk7MTE0NTE7MTAwMTc7MTAwMjQ7MTAwMjk7MTAwMzE7MTAwNDY7MTAwNTU7MTAwNjg7MTAwNzU7MTAwODM7MTAwODk7MTAwOTg7MTAxMDM7MTAxMTc7MTAxMjA7MTAxMjg7MTAxMzY7MTAxNDU7MTAxNTE7MTAxNjA7MTAxNjQ7MTAxNjg7MTAxNzU7MTAxODE7MTAxODk7MTAxOTY7MTAyMDA7MTAyMDQ7MTAyMTE7MTAyMTc7MTAyMjM7MTAyMjc7MTAyMzM7MTAyNDQ7MTAyNDg7MTAyNTU7MTAyNTk7MTAyNjM7MTAyNjc7MTAyNzA7MTAyNzM7MTAyODI7MTAyODY7MTAyOTA7MTAyOTM7MTAyOTc7MTAzMDA7MTAzMDQ7MTE0NTA7MTAzMTI7MTAzMTc7MTAzMjI7MTAzMjU7MTAzMzE7MTAzMzM7MTAzMzY7MTAzNDI7MTAzNDU7MTAzNTI7MTAzNTg7MTAzNjM7MTAzNjY7MTAzNzA7MTAzNzc7MTAzODI7MTAzODY7MTAzOTI7MTAzOTg7MTA0MDI7MTA0MDM7MTA0MDY7MTA0MTQ7MTA0MTg7MTA0MjI7MTA0MjY7MTA0Mjk7MTA0MzQ7MTA0NDM7MTA0NDc7MTA0NTE7MTA0NTY7MTA0NjA7MTA0NjQ7MTA0Njk7MTA0NzU7MTA0ODI7MTA0ODM7MTA0ODY7MTA0ODk7MTA0OTM7MTA0OTY7MTA1MDA7MTA1MDU7MTA1MDc7MTA1MTI7MTA1MTQ7MTA1MTc7MTA1MjE7MTA1MjY7MTA1MjM7MTA1MzA7MTA1MzQ7MTA1MzY7MTA1NDE7MTA1NDQ7MTA1NDg7MTA1NTE7MTE0NDk7MTA1NTc7MTA1NjA7MTA1NjM7MTA1NjY7MTA1NzI7MTA1NzU7MTA1Nzk7MTA1ODE7MTA1ODQ7MTA1OTA7MTA1ODc7MTA1OTM7MTA1OTc7MTA1OTg7MTA2MDE7MTA2MDI7MTsxMDYwNTsxMDYwNzsxMDYxMDsxMDYxNDsxMDYxNzsxMDYyMDsxMDYyMzsxMDYyNTsxMDYyNjsxMDYyNzsxMDYyODsxMDYzMzsxMDYzNjsxMDY0MTsxMDY0NjsxMDY0OTsxMDY0MzsxMDY1MzsxMDY1NjsxMDY1ODsxMDY2MjsxMDY2NDsxMDY2NjsxMDY2ODsxMDY3MDsxMDY3MjsxMDY3NDsxMDY3NTsxMDY3ODsxMDY4MDsxMDY4MzsxMDY4MTsxMDY4NTsxMDY4NzsxMDY5MTsxMDY5MjsxMDY5NTsxMDY5ODsxMDcwMTsxMDcwMzsxMDcwNTsxMDcwNzsxMDcwOTsxMDcxMDsxMDcxMzsxMDcxNTsxMDcxNjsxMDcxODsxMDcyMDsxMDcyMjsxMDcyNTsxMDcyODsxMDczMTsxMDczMzsxMDczNTsxMDczODsxMDc0MDsxMDc0MTsxMDc0MzsxMDc0NTsxMDc0NzsxMDc0OTsxMDc1MjsxMDc1NDsxMDc1NTsxMDc1ODsxMDc2MDsxMDc2MjsxMDc2NDsxMDc2NjsxMDc3MDsxMDc3MTsxMDc3ODsxMDc4MDsxMDc4MjsxMDc4NDsxMDc4NjsxMDc4ODsxMDc5MTsxMDc5MjsxMDc5NTsxMDc5NzsxMDc5OTsxMDgwMTsxMDgwMzsxMDgwNTsxMDgwNzsxMDgwOTsxMDgxMTsxMDgxMzsxMDgxNTsxMDgxNzsxMDgyMTsxMDgyMzsxMDgyNDsxMDgyNjsxMDgyODsxMDgzMDsxMDgzMTsxMDgzMzsxMDgzNTsxMDgzNzsxMDgzOTsxMDg0MTsxMDg0MzsxMDg0NTsxMDg0NjsxMDg0ODsxMDg1MDsxMDg1MjsxMDg1NDsxMDg1NjsxMDg1ODsxMDg2MTsxMDg2MzsxMDg2NTsxMDg2NzsxMDg2OTsxMDg3MDsxMDg3MzsxMDg3NTsxMDg3NzsxMDg4MDsxMDg4MTsxMDg4MjsxMDg4NDsxMDg4NjsxMDg5MDsxMDg5MzsxMDg5NTsxMDg5NzsxMDg5OTsxMDkwMTsxMDkwMzsxMDg4OTsxMDkwNDsxMDkwNjsxMDkwOTsxMDkxMjsxMDkxNDsxMDkxODsxMDkyMDsxMDkyMjsxMDkyNDsxMDkyNjsxMDkyODsxMDkzMDsxMDkzMjsxMDkzNjsxMDkzOTsxMDk0MTsxMDk0MzsxMDk0NTsxMDk1MDsxMDk1MjsxMDk1NDsxMDk1NjsxMDk1ODsxMDk2MDsxMDk2MjsxMDk2NTsxMDk2NzsxMDk2OTsxMDk3MDsxMDk3MzsxMDk3NTsxMDk4MTsxMDk4MzsxMDk4NTsxMDk4NjsxMDk3NzsxMDk3OTsxMDk4NzsxMDk5MDsxMDk5MjsxMDk5NTsxMDk5NjsxMDk5ODsxMTAwMDsxMTAwMjsxMTAwNDsxMTAwNTsxMTAwODsxMTAxMDsxMTAxMzsxMTAxNTsxMTAxNzsxMTAxOTsxMTAyMjsxMTAyMzsxMTAyNDsxMTAyNzsxMTAyOTsxMTAzMTsxMTAzMzsxMTAzNTsxMTAzNzsxMTAzOTsxMTA0MTsxMTA0MjsxMTA0NjsxMTA0ODsxMTA1MDsxMTA1MjsxMTA1NjsxMTA1ODsxMTA2MDsxMTA2MjsxMTA2NDsxMTA2NjsxMTA2ODsxMTA3MDsxMTA3MjsxMTA3NjsxMTA3NDsxMTA3ODsxMTA4MDsxMTA4MTsxMTA4NDsxMTA4NjsxMTA5MDsxMTA5MjsxMTA5NDsxMTA5NzsxMTA5NjsxMTA5OTsxMTEwMDsxMTEwMzsxMTEwNTsxMTEwNzsxMTEwOTsxMTExMTsxMTExMzsxMTExNTsxMTExNjsxMTExOTsxMTEyMDsxMTEyMjsxMTEyNDsxMTEyNTsxMTEyNzsxMTEyODsxMTEzMDsxMTEzMjsxMTEzNTsxMTEzNjsxMTEzOTsxMTE0MjsxMTE0NDsxMTE0NTsxMTE0NzsxMTE0ODsxMTE1MDsxMTE1MjsxMTE1MzsxMTE1NDsxMTE1NzsxMTE1OTsxMTE2MTsxMTE2MjsxMTE2NDsxMTE2NjsxMTE2ODsxMTE3MDsxMTE3MjsxMTE3NDsxMTE3NjsxMTE3ODsxMTE4MDsxMTE4MjsxMTE4MzsxMTE4NTsxMTE4NzsxMTE4OTsxMTE5MTsxMTE5MzsxMTE5NDsxMTE5NzsxMTE5ODsxMTIwMDsxMTIwMjsxMTIwMzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwxPjtpPDc+O2k8MTM+Oz47bDx0PHQ8cDxwPGw8RGF0YVRleHRGaWVsZDtEYXRhVmFsdWVGaWVsZDs+O2w8ZGVzY3JpY2FvO3N0YXR1c2xpY2l0YWNhbzs+Pjs+O3Q8aTw0PjtAPFxlO0VNIEFCRVJUTztFTSBBTkRBTUVOVE87RU5DRVJSQURBOz47QDxcZTsxOzI7Mzs+Pjs+Ozs+O3Q8dDw7cDxsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+O2k8Nj47aTw3PjtpPDg+O2k8OT47aTwxMD47PjtsPHA8MjAwNDsyMDA0PjtwPDIwMDU7MjAwNT47cDwyMDA2OzIwMDY+O3A8MjAwNzsyMDA3PjtwPDIwMDg7MjAwOD47cDwyMDA5OzIwMDk+O3A8MjAxMDsyMDEwPjtwPDIwMTE7MjAxMT47cDwyMDEyOzIwMTI+O3A8MjAxMzsyMDEzPjtwPDIwMTQ7MjAxND47Pj47Pjs7Pjt0PHQ8O3A8bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1PjtpPDY+O2k8Nz47aTw4PjtpPDk+O2k8MTA+Oz47bDxwPDIwMDQ7MjAwND47cDwyMDA1OzIwMDU+O3A8MjAwNjsyMDA2PjtwPDIwMDc7MjAwNz47cDwyMDA4OzIwMDg+O3A8MjAwOTsyMDA5PjtwPDIwMTA7MjAxMD47cDwyMDExOzIwMTE+O3A8MjAxMjsyMDEyPjtwPDIwMTM7MjAxMz47cDwyMDE0OzIwMTQ+Oz4+Oz47Oz47Pj47dDw7bDxpPDU+O2k8MTE+Oz47bDx0PHQ8O3A8bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1PjtpPDY+O2k8Nz47aTw4PjtpPDk+O2k8MTA+O2k8MTE+Oz47bDxwPFxlO1xlPjtwPDIwMDQ7MjAwND47cDwyMDA1OzIwMDU+O3A8MjAwNjsyMDA2PjtwPDIwMDc7MjAwNz47cDwyMDA4OzIwMDg+O3A8MjAwOTsyMDA5PjtwPDIwMTA7MjAxMD47cDwyMDExOzIwMTE+O3A8MjAxMjsyMDEyPjtwPDIwMTM7MjAxMz47cDwyMDE0OzIwMTQ+Oz4+Oz47Oz47dDx0PDtwPGw8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47aTw2PjtpPDc+O2k8OD47aTw5PjtpPDEwPjtpPDExPjs+O2w8cDxcZTtcZT47cDwyMDA0OzIwMDQ+O3A8MjAwNTsyMDA1PjtwPDIwMDY7MjAwNj47cDwyMDA3OzIwMDc+O3A8MjAwODsyMDA4PjtwPDIwMDk7MjAwOT47cDwyMDEwOzIwMTA+O3A8MjAxMTsyMDExPjtwPDIwMTI7MjAxMj47cDwyMDEzOzIwMTM+O3A8MjAxNDsyMDE0Pjs+Pjs+Ozs+Oz4+O3Q8cDw7cDxsPE9uQ2xpY2s7PjtsPHJldHVybiB2ZXJpZnkoKTs+Pj47Oz47dDw7bDxpPDE+O2k8Mz47PjtsPHQ8cDxwPGw8VmlzaWJsZTs+O2w8bzxmPjs+Pjs+O2w8aTwzPjs+O2w8dDxwPHA8bDxWaXNpYmxlOz47bDxvPGY+Oz4+Oz47Oz47Pj47dDxwPHA8bDxWaXNpYmxlOz47bDxvPGY+Oz4+Oz47bDxpPDE+Oz47bDx0PDtsPGk8MT47PjtsPHQ8QDA8Ozs7Ozs7Ozs7Oz47Oz47Pj47Pj47Pj47Pj47Pj47bDxNZW51UHJpbmNpcGFsOmJ0bkRpYXJpb09maWNpYWw7TWVudVByaW5jaXBhbDpidG5DZXJ0aWZpY2FjYW9EaWdpdGFsO01lbnVQcmluY2lwYWw6YnRuTGl2cmFyaWE7TWVudVByaW5jaXBhbDpidG5HcmFmaWNhO1ZvbHRhcl9iYXJyYTpidG5Wb2x0YXI7TW9kYWxpZGFkZTppbWdNb2RhbGlkYWRlcztidG5CdXNjYXI7Vm9sdGFyX3RvcG86YnRWb2x0YXI7Pj49YxZiEm/jiDts91aWS3L4HrfDHg==').
  '&Negocio:cboArea='.
  '&Negocio:cboSubArea='.
  '&Licitador:cboUO='.
  '&Licitador:cboUGO='.
  '&Modalidade:cboModalidade='.
  '&Modalidade:cboLocalidade='.
  '&Status:cboStatus=1'.
  '&Status:cboAberturaSecaoInicioDia=1'.
  '&Status:cboAberturaSecaoInicioMes=1'.
  '&Status:cboAberturaSecaoInicioAno=2012'.
  '&Status:cboAberturaSecaoFimDia=1'.
  '&Status:cboAberturaSecaoFimMes=1'.
  '&Status:cboAberturaSecaoFimAno='.date('Y').
  '&btnBuscar.x=23'.
  '&btnBuscar.y=1');//$fields); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_URL,"http://www.imprensaoficial.com.br/PortalIO/ENegocios/BuscaENegocios_14_1.aspx");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 

  echo curl_exec($ch);die();
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
  $header[] = "Host:www.imprensaoficial.com.br";
  $header[] = 'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11"Accept:*/*';
  $ch = curl_init();
  // A primeira pagina DEVE ter o Referer como BuscaLicitacao.aspx
  if($pagenum == 1){

    $header[] = "Referer:http://www.imprensaoficial.com.br/PortalIO/ENegocios/BuscaENegocios_14_1.aspx";    
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL,"http://www.imprensaoficial.com.br/PortalIO/ENegocios/ResultadoBuscaENegocios_14_2.aspx");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    
    $htmlResult = curl_exec($ch);
    file_put_contents("html1.html",$htmlResult);
  
  // Da segunda em diante, pode ter o referer como ResultadoBusca.aspx
  }else{
    $header[] = "Referer:http://www.imprensaoficial.com.br/PortalIO/ENegocios/ResultadoBuscaENegocios_14_2.aspx";
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
    curl_setopt($ch, CURLOPT_URL,"hhttp://www.imprensaoficial.com.br/PortalIO/ENegocios/ResultadoBuscaENegocios_14_2.aspx");
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
  foreach($licitacoes as $key => $l){
    // Pulando a primeira linha que contem os cabecalhos
    if($key == 0) continue;
    // Recebo os dados de cada linha numa lista de variaveis
    list($nrPublicacao,$licitador,$modalidade,$dataAbertura,$objeto) = $l->find('td');
    
    // Tratamento dos dados para serem inseridos no banco de dados
    $nrPublicacao = mysql_escape_string($nrPublicacao->childNodes(0)->innertext);
    $licitador = mysql_escape_string(html_entity_decode($licitador->innertext));
    $modalidade = mysql_escape_string(html_entity_decode($modalidade->innertext));
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
  $sql = "INSERT INTO licitacoes(protocolo,interessado,objeto,objeto_free,publicado_em,aviso,aviso_free,id_cidade) VALUES ";
  if(count($inserts) > 0){
    $sql .= implode(",",$inserts);
    $conexao = new mysqli("localhost","root","root","pds_crawler");
    $conexao->query($sql);
  }
  // Verificando se tem mais paginas
  if(!isset($html->find("#ctl00_cphConteudo_gdvResultadoBusca_pgrGridView_btrNext",0)->disabled)){
    //echo 'ae';
    //getResultsPage($pagenum+1);
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
// limpando o arquivo de cookies
unlink($ckfile);