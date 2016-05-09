<?php
/*$API_KEY = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$url = 'https://api.telegram.org/bot'.$API_KEY;
$update = file_get_contents($url."/getupdates");
$updateArray = json_decode($update,TRUE);

$chatId = $updateArray["result"][0]["message"]["chat"]["id"];

$update = file_get_contents($url."/sendMessage?chat_id=".$chatId."&text=Maxalchik");
*/
/**
 * Telegram Bot access token и URL.
 */
if(isset($_GET['test']))
{
  // Соединение, выбор базы данных
    $dbconn = pg_connect("host=tt.uz dbname=ttuz_www user=ttuz_user password=postgres5665528_")
        or die('Could not connect: ' . pg_last_error());

    // Выполнение SQL запроса
    $query = 'SELECT * FROM core_bots';
    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

    // Вывод результатов в HTML
    echo "<table>\n";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Очистка результата
    pg_free_result($result);

    // Закрытие соединения
    pg_close($dbconn);

}
$access_token = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$api = 'https://api.telegram.org/bot' . $access_token;
/**
 * Функция отправки сообщения sendMessage().
 */
function sendMessage($param) {
  file_get_contents($GLOBALS['api'] . '/'.$param);
} 
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

$rrr = file_get_contents('php://input');
$output = json_decode(file_get_contents('php://input'), TRUE);
if(isset($output['message']['chat']['id'])){
   
    
    $ww = send_post('http://www.tt.uz/bot_file.php',$rrr);
    sendMessage($ww);
} 


exit;





/**
 * Задаём основные переменные.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

/**
 * Emoji для лучшего визуального оформления.
 */
$emoji = array(
  'preload' => json_decode('"\uD83D\uDE03"'), // Улыбочка.
  'weather' => array(
    'clear' => json_decode('"\u2600"'), // Солнце.
    'clouds' => json_decode('"\u2601"'), // Облака.
    'rain' => json_decode('"\u2614"'), // Дождь.
    'snow' => json_decode('"\u2744"'), // Снег.
  ),
);

/**
 * Получаем команды от пользователя.
 */  
switch($message) {
  // API погоды предоставлено OpenWeatherMap.
  // @see http://openweathermap.org
  case '/pogoda':
    // Отправляем приветственный текст.
    $preload_text = 'Одну секунду, ' . $first_name . ' ' . $emoji['preload'] . ' Я уточняю для вас погоду..';
    sendMessage($chat_id, $preload_text);
    // API key для OpenWeatherMap.
    // Формирование ответа.
    $weather_text = 'Сейчас в Ташкенте. Температура воздуха: 31°C. Ветер  10м/сек.';
    // Отправка ответа пользователю Telegram.
    sendMessage($chat_id, $weather_text);
    break;
  default:
    break;
}  
/*<?php

$access_token = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$api = 'https://api.telegram.org/bot' . $access_token;

$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$first_name = $output['message']['chat']['first_name'];
$message = $output['message']['text'];

$emoji = array(
  'preload' => json_decode('"\uD83D\uDE03"'), // Улыбочка.
  'weather' => array(
    'clear' => json_decode('"\u2600"'), // Солнце.
    'clouds' => json_decode('"\u2601"'), // Облака.
    'rain' => json_decode('"\u2614"'), // Дождь.
    'snow' => json_decode('"\u2744"'), // Снег.
  ),
);
  
switch($message) {
  // API погоды предоставлено OpenWeatherMap.
  // @see http://openweathermap.org
  case '/pogoda':
    // Отправляем приветственный текст.
    $preload_text = 'Одну секунду, ' . $first_name . ' ' . $emoji['preload'] . ' Я уточняю для вас погоду..';
    sendMessage($chat_id, $preload_text);
    // API key для OpenWeatherMap.
    // Формирование ответа.
    $weather_text = 'Сейчас в Ташкенте. Температура воздуха: 31°C. Ветер  10м/сек.';
    // Отправка ответа пользователю Telegram.
    sendMessage($chat_id, $weather_text);
    break;
    case 'Ne':
    $weather_text = 'Атан басы козявка';
    // Отправка ответа пользователю Telegram.
    sendMessage($chat_id, $weather_text);
    break;
  default:
    break;
}  

function sendMessage($chat_id, $message) {
  file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));
}