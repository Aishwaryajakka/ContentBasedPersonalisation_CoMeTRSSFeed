<?php
$xmlFilepath1 = '_rss.xml';
header('encoding="utf-8"');
formatXML($xmlFilepath1);

function formatXML($xmlFilepath) {
    $loadxml = simplexml_load_file($xmlFilepath);

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
   /* $dom->loadHTML('<?xml encoding="utf-8" ?>');*/
    $dom->formatOutput = true;
    $dom->loadXML($loadxml->asXML());
    $formatxml = new SimpleXMLElement($dom->saveXML());
    $formatxml-> saveXML("_rss.xml"); // save as file

    return $formatxml->saveXML();
} // format
?>