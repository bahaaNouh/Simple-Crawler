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

   $options = array(

       CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
       CURLOPT_USERAGENT      => $user_agent, //set user agent
       CURLOPT_RETURNTRANSFER => true, 
       CURLOPT_BINARYTRANSFER => true,    
       CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
       CURLOPT_TIMEOUT        => 120,      // timeout on response
       CURLOPT_PROXY          => '213.74.117.171:8888'    // stop after 10 redirects
   );

   $ch      = curl_init( $url );
   curl_setopt_array( $ch, $options );
   $content = curl_exec( $ch );
   curl_close( $ch );
   $header['content'] = $content;
   return $header;
}

$result = get_web_page($url);

echo "<pre>";
print_r($result);
echo "</pre>";
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