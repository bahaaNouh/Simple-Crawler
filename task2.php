<?php 

$url = 'https://www.newhome.ch/de/kaufen/suchen/haus_wohnung/kanton_zuerich/liste.aspx?p=1';
$proxy = '213.74.117.171:8888';

function check_proxy() {
    $ch = curl_init('http://api.proxyipchecker.com/pchk.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,'ip=213.74.117.171&port=8888');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    list($res_time, $speed, $country, $type) = explode(';', curl_exec($ch));
    print_r( $country );
}
check_proxy();


function  get_web_page( $url )
{
   $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

  

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXY, '212.202.244.90:8080');
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        $output = curl_exec($ch);
        curl_close($ch); 
        $dom = new DOMDocument();
        @$dom->loadHTMLFile($output);   
        $anchors = $dom->getElementsByTagName('a');  
        echo "<pre>";
        print_r(getLinks($anchors));
        echo "</pre>";
 
}

get_web_page($url);

function getLinks($anchors)
{
    $links =[];
    $count = 0 ;

    foreach ($anchors as $key => $element) {
        $href = $element->getAttribute('href');
        // if(preg_match('/^(\/)(mieten)(\/)([0-9])/',$href)){
            $links[] = $href;
            $count++;
          
        // }
        
    }
    return [$links,$count];
}

// echo "<pre>";
// print_r($result);
// echo "</pre>";
// function getSource($url='',$curlMaxExecTime=5 , $proxy) {
//         $userAgent='Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36';
//         $ch = curl_init();
//         // curl_setopt($ch, CURLOPT_PROXY, $proxy );
//         curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
//         curl_setopt($ch, CURLOPT_URL,$url);
//         curl_setopt($ch, CURLOPT_FAILONERROR, true);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//         curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//         curl_setopt($ch, CURLOPT_TIMEOUT, $curlMaxExecTime);
//         $html = curl_exec($ch);
//         $dom = new DOMDocument;
//         $dom->loadHTML($html);
//         $links = $dom->getElementsByTagName('a');
//         foreach ($links as $link ) {
            
//             print_r($link);
//         }
        
// }

// getSource($url,500,$proxy);