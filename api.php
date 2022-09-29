<?php
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'all';
$num = !empty($_GET['num']) ? $_GET['num'] : 1;
$type = $_GET['type'];
$urls = [];
$filename = './txt/' . $sort . '.txt';
if (!file_exists($filename)) {
    die('sort为空或文件不存在');
}

// 从文本获取链接
$pics = file_get_contents($filename);
$pics = explode(PHP_EOL, $pics);

// 返回格式和数量
$type = $num > 1 ? 'json' : $type;
$num = $num > 100 ? 100 : $num;

for ($i = 0; $i < $num; $i++) {
    $url = $pics[array_rand($pics)];
    // $url = str_replace(array("\r","\n","\r\n"), '', $url);
    array_push($urls, $url);
}

// 返回指定格式
switch ($type) {

        //JSON返回
    case 'json':
        header('Content-type:text/json');
        die(json_encode(['pics' => $urls], JSON_PRETTY_PRINT));

    default:
        die(header("Location: $url"));
}
