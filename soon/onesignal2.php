<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("content-type:application/json;charset=utf-8");
ini_set('max_execution_time', 300);

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
    $nofi_ID=  $request->nofi_ID;


    function getDevices()
    {
        $app_id = "9b5c10b8-6128-407f-950a-49b646a25436";

        $API_KEY = 'NjAwNjRjMmEtN2M2ZS00NWE1LWI3NDMtZThmYTA5MjU5N2Ri';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players?app_id=" . $app_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $API_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
function getONE_Devices()
{
    $app_id = "9b5c10b8-6128-407f-950a-49b646a25436";

    $API_KEY = 'NjAwNjRjMmEtN2M2ZS00NWE1LWI3NDMtZThmYTA5MjU5N2Ri';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/apps/$app_id");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        'Authorization: Basic NjAwNjRjMmEtN2M2ZS00NWE1LWI3NDMtZThmYTA5MjU5N2Ri'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}



    function viewNofi($nof)
    {
        $app_id = "9b5c10b8-6128-407f-950a-49b646a25436";


        $API_KEY = 'NjAwNjRjMmEtN2M2ZS00NWE1LWI3NDMtZThmYTA5MjU5N2Ri';

        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications/?app_id=" . $app_id."");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $API_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);


        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }




    $response = viewNofi($nofi_ID);
    $return["allresponses"] = $response;
    echo $response;
    $return = json_encode($return);

    //$return = str_replace("\n","",$return); //ตัด \t


}
?>