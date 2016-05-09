<?php
/**
 * Telegram Bot access token и URL.
 */
/**
 * Функция отправки сообщения sendMessage().
 */
function send_post($url,$data){
    $ch=curl_init();
   // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); // отключение сертификата
   // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // отключение сертификата
    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)");
    $data=curl_exec ($ch);
    curl_close ($ch);
    return $data;
}
function send_get($url,$data = 0){
    $ch=curl_init();
   // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); // отключение сертификата
   // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // отключение сертификата
    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_HTTPHEADER,array('Content-Type: text/xml'));
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0)");
    $data=curl_exec ($ch);
    curl_close ($ch);
    return $data;
}
function sendMessage($access_token,$param) {
  $api = 'https://api.telegram.org/bot' . $access_token;  
  //return file_get_contents($api . '/'.$param);
  return send_get($api.'/'.$param->method.'?'.$param->param);
} 


if(isset($_GET['respons']) && $_GET['respons'] != "")
{
    $telegram = file_get_contents('php://input');
    $output = json_decode($telegram, TRUE);
    
    $url = "http://www.tt.uz/bots/".$_GET['respons'];
    $result = file_get_contents($url);
    $res = json_decode($result);
    
    if(isset($output['message']['chat']['id'])){
        $param = send_post($res->url,$telegram);
        $telegramResult = sendMessage($res->bot_token,json_decode($param));
        if((int)$res->return_telegram_is == 1){
            //send_post($res->return_telegram,$telegramResult);
        }
    }   
    
    /*
     * 
     curl_setopt(
    $request,
    CURLOPT_POSTFIELDS,
    array(
      'file' => '@' . realpath('example.txt')
    ));
     */
}
echo "Bad request!";
exit;
