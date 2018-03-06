<?php
header("content-type:application/json;charset=utf-8");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
ini_set('max_execution_time', 300);
date_default_timezone_set('Asia/Bangkok');
ini_set('memory_limit', '-1');





if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

$postdata = file_get_contents("php://input");

if (isset($postdata)) {



    $request = json_decode($postdata);
    $user_ID=  $request->user_ID;
    $send_to1=  $request->send1;
    $send_to2=  $request->send2;
    $send_to3=  $request->send3;
    $send_to4=  $request->send4;
    $send_to5=  $request->send5;



    $API_URL = "https://onesignal.com/api/v1/notifications";
    $APP_ID = '9b5c10b8-6128-407f-950a-49b646a25436';
    $API_KEY = 'NjAwNjRjMmEtN2M2ZS00NWE1LWI3NDMtZThmYTA5MjU5N2Ri';
    $message = ' รางวัลที่1 = '.$send_to2.'\n เลขท้าย 2 ตัว = '.$send_to3.'\n เลขหน้า 3 ตัว = '.$send_to4.'\n เลขท้าย 3 ตัว = '.$send_to5 ; // ข้อความที่เราต้องการส่ง
    $title='ผลการออกรางวัล  '.$send_to1;

$date_now = date('Y-m-d H:i:s ')."GMT+0700";

$time_to_send='2018-02-04 23:25:30 GMT+0700';




if($date_now>$time_to_send){
    $echo_time= 'เลยเวลาแล้ว';
    $time_to_send='2058-01-29 14:07:45 GMT+0700';
    }
else{$echo_time= 'ยังไม่ถึงเวลา';}

echo $date_now."   > : ".$time_to_send." = ".$echo_time;




    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_URL);
    $headers = array(
        'Content-type: application/json',
        'Authorization: Basic ' . $API_KEY,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"app_id\":\"" . $APP_ID . "\",

\"isAndroid\":true,
\"content_available\":true,
\"content_available\":1,


\"large_icon\": \"https://stickershop.line-scdn.net/stickershop/v1/product/1277478/LINEStorePC/main@2x.png;compress=true\",

\"send_after\":\"$time_to_send\",

\"include_player_ids\": [\"$user_ID\"],
\"headings\": {\"en\":\"" .$title . "\"},
\"contents\": {\"en\":\"" . $message . "\"}


}");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);



       //var_dump(date('Y-m-d H:i:s ').$date_now." now : ".$echo_time);



    //echo $response;
    $return = json_encode($return);
}

?>