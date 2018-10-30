<?php
function crawlPage($url)
{

    $pages_number = 2;
    
    $dom = new DOMDocument('1.0');
    
    for ($i=1; $i <=$pages_number ; $i++) { 
        @$dom->loadHTMLFile($url.$i);
        $anchors = $dom->getElementsByTagName('a');
        echo "<pre>";
        print_r(getLinks($anchors));
        echo "</pre>";
    }

}
crawlPage("https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=");



function getLinks($anchors)
{
    $links =[];
    $count = 0 ;

    foreach ($anchors as $key => $element) {
        $href = $element->getAttribute('href');
        if(preg_match('/^(\/)(mieten)(\/)([0-9])/',$href)){
            $links[] = $href;
            $count++;
          
        }
        
    }
    return [$links,$count];
}


// function getLastPageNumber($dom)
// {
//     $finder = new DomXPath($dom);
//     $classname="paginator-counter";
//     $nodes = $finder->query("//*[contains(@class, '$classname')]//span");
//     $tmp_dom = new DOMDocument(); 
//     foreach ($nodes as $node) 
//         {
//         $tmp_dom->appendChild($tmp_dom->importNode($node,true));
        
//         }
//         $innerHTML= trim($tmp_dom->saveHTML());
       
//     preg_match_all('/von (\d+)/',$innerHTML,$matches);
//     return $matches[1];
// }