<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'all';
$num = !empty($_GET['num']) ? $_GET['num'] : 1;
$type = $_GET['type'];
$urls = [];
$i = 0;

$type = $num > 1 ? 'json' : $type;
$num = $num > 100 ? 100 : $num;

$arr = file('txt/' . $sort . '_raw.txt');
$n = count($arr) - 1;

do {
    $x = rand(0, $n);
    array_push($urls, $arr[$x]);
    $i++;
} while ($i < $num);
$urls = str_replace(array("\r", "\n", "\r\n"), '', $urls);
$urls = array_diff($urls, ['']);

switch ($type) {
    case 'json':
        header('Content-type:text/json');
        die(json_encode(['pics' => $urls], JSON_PRETTY_PRINT));

    default:
        header("Location:" . $arr[$x]);
}
