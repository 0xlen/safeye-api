<?php

const JSON_FILE = __DIR__ . '/cache_output.json';

function getJsonCache($array = false)
{
    $json = file_get_contents(JSON_FILE);
    $json = json_decode($json, $array);

    return $json;
}

function saveCache($item)
{
    $data = getJsonCache(true);
    $result = [
        $item['resource'] => $item
    ];

    $data = array_merge($data, $result);
    if (isset($_GET['test']))
    {
        print_r($data);
    } else {
        file_put_contents(JSON_FILE, json_encode($data));
    }
}

if (isset($_GET['all'])) {
    print_r(count(getJsonCache(true)));
    print_r(getJsonCache(true));
}

if (isset($_GET['url'])) {
    // print_r(getJsonCache(true));
    print_r(count(getJsonCache(true)));
    print_r(getJsonCache(true)[$_GET['url']]);
}

if (isset($_GET['test'])) {
    saveCache([
        'resource' => $_GET['url'],
        'test' => 1,
        'dd' => 2,
    ]);
}
