<?php
//获取类型
$sort = !empty($_GET['sort']) ? $_GET['sort'] : 'all' ;
// 存储数据的文件
$filename = './txt/'.$sort.'.txt';
if(!file_exists($filename)) {
    die('指定sort不存在');
}
// 读取整个数据文件
$data = file_get_contents($filename);
// 按换行符分割成数组
$data = explode(PHP_EOL, $data);
//获取类型和数量
$type = $_GET['type'];
if($sort == 'r18'){
// 定义r18内容
$type = 'json';
$text = 'To prevent abuse, r18 always returns json';
$proxy = !empty($_GET['proxy']) ? $_GET['proxy'] : 'i.loli.best' ;
$size_arr = array('original', 'regular', 'small', 'thumb', 'mini');
$size = !empty($_GET['size']) ? $_GET['size'] : 'regular' ;
if(!in_array($size, $size_arr)){
	$size = 'original';
}
} else {
// 定义常规内容
$size_arr = array('large', 'mw2048', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb150', 'thumb180', 'thumbnail', 'orj360', 'orj480', 'square');
$size = !empty($_GET['size']) ? $_GET['size'] : 'large' ;
if(!in_array($size, $size_arr)){
	$size = 'large';
}
}
if($type == 'json'){
$num = !empty($_GET['num']) ? $_GET['num'] : '1' ;
} else {
$num = 1;
}
//定义图片数组
$urls = [];
$n = 1;
do {
// 随机获取一行索引
$result = $data[array_rand($data)];
// 去除多余的换行符（解决获取空值问题
$result = str_replace(array("\r","\n","\r\n"), '', $result);
if($sort == 'r18'){

$value = explode('_',$result);
$url = 'https://'.$proxy.'/'.$size.'/'.$value[0].'/'.$value[1].'';
} else {

$server = rand(1,4);

$url = 'https://tva'.$server.'.sinaimg.cn/'.$size.'/'.$result.'.jpg';
}
array_push($urls, $url);
$n++;
}
while ($n<=$num);
//返回指定格式
switch($type){
case 'json':
header('Content-type:text/json');
die(json_encode(['sort'=>$sort,'number'=>$num,'pic'=>$urls,'warning'=>$text],JSON_PRETTY_PRINT));
default:
die(header("Location: $url"));
}
?>
