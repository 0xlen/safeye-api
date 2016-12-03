<?php
include_once '../api.php';

$scan_url = $_POST['url'];
$url_scanner = new API('/url/report', ['resource' => $scan_url]);
$url_scanner->outputJSON();
