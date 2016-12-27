<?php
include_once '../api.php';
include_once '../cache.php';

$options = [];

$scan_url = $_POST['url'];
$options = $_POST['options'];
$data = ['resource' => $scan_url];

$cache = getJsonCache(true);
if (isset($cache[$scan_url])) {
    header("Access-Control-Allow-Origin: *");
    header('Content-type:application/json;charset=utf-8');

    echo json_encode(array_merge($cache[$scan_url], ['cache' => 1]));
} else {
    $data = array_merge($data, (array)$options);

    $url_scanner = new API('/url/report', $data);

    try {
        $result = json_decode($url_scanner->getResult(), true);
        if (($result['response_code'] == 1) && isset($result['positives']) && isset($result['total'])) {
            saveCache($result);
        }

        $url_scanner->outputJSON();
    } catch (\Exception $e) {
        echo $e->getCode() . ':' . $e->getMessage();
    }
}
