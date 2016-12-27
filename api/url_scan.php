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
    $url_scanner->outputJSON();

    try {
        if ($url_scanner->getResult()->response_code == 1 && isset($url_scanner->getResult()->positives)) {
            saveCache(json_decode($url_scanner->getResult(), true));
        }
    } catch (\Exception $e) {
        echo $e->getCode() . ':' . $e->getMessage();
    }
}
