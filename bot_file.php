<?php
/**
 * void object2file - функция записи объекта в файл
 *
 * @param mixed value - объект, массив и т.д.
 * @param string filename - имя файла куда будет произведена запись данных
 * @return void
 *
 */
function object2file($value, $filename)
{
    $str_value = serialize($value);
    
    $f = fopen($filename, 'w');
    fwrite($f, $str_value);
    fclose($f);
}


/**
 * mixed object_from_file - функция восстановления данных объекта из файла
 *
 * @param string filename - имя файла откуда будет производиться восстановление данных
 * @return mixed
 *
 */
function object_from_file($filename)
{
    $file = file_get_contents($filename);
    $value = unserialize($file);
    return $value;
}


$output = json_decode(file_get_contents('php://input'), TRUE);

if(isset($output['message']['chat']['id'])){
    $chat_id = $output['message']['chat']['id'];
    $first_name = $output['message']['chat']['first_name'];
    $message = $output['message']['text'];
    echo 'sendMessage?chat_id='.$chat_id.'&text=какашка';
    // запишем массив в файл
    object2file($output, 'array.txt');
    // в файл array.txt будет записана следующая информация:
    // serialize $array 
} else {
    echo '<pre>';
    print_r(object_from_file('array.txt'));
    echo '</pre>';
}



