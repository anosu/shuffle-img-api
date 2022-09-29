<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'all';
$num = !empty($_GET['num']) ? $_GET['num'] : 1;
$type = $_GET['type'];
$filename = './txt/' . $sort . '.txt';
if (!file_exists($filename)) {
    die('sort为空或文件不存在');
}

// 从文本获取链接
$pics = [];
$fs = fopen($filename, "r");
while (!feof($fs)) {
    $line = trim(fgets($fs));
    if ($line != '') {
        array_push($pics, $line);
    }
}
// 返回格式和数量
$type = $num > 1 ? 'json' : $type;
$num = $num > 100 ? 100 : $num;

$urls = [];
for ($i = 1; $i <= $num; $i++) {
    $url = $pics[array_rand($pics)];
    array_push($urls, $url);
}

// 返回指定格式
switch ($type) {

        //JSON返回
    case 'json':
        header('Content-type:text/json');
        die(json_encode(['pic' => $urls], JSON_PRETTY_PRINT));

    default:
        die(header("Location: $url"));
}
