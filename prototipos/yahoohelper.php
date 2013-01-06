<?php
function getSignificantTermsArray($s){
  
    // cURL must be installed for this to work
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://api.search.yahoo.com/ContentAnalysisService/V1/termExtraction');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt( $ch, CURLOPT_POSTFIELDS, 'appid=YOUR_APP_ID&context=' . urlencode($s) );
    $xml = curl_exec($ch);
    curl_close($ch);

    // A workaround deletes the Schema declarations, as they
    // confuse PHP5
    $xml = str_replace('xsi:schemaLocation="urn:yahoo:srch http://api.search.yahoo.com/ContentAnalysisService/V1/TermExtractionResponse.xsd"', ' ', $xml);
    $xml = str_replace('xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="urn:yahoo:srch"', ' ', $xml);

    $arrTerms = array();

    // The nice native PHP XML functions
    $dom = new domdocument;
    $dom->loadXml($xml);
    $xpath = new domxpath($dom);
    $xNodes = $xpath->query('//Result');
    $i = 0;
    foreach ($xNodes as $xNode) {
        $arrTerms[$i++] = $xNode->firstChild->data;
    }

    return $arrTerms;
}

?>