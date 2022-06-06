我们开始吧！

### 用法
* 请求方式：GET
* 请求地址：
```url
https://moe.jitsu.top/img/
```

* 返回格式：302跳转/json
* 参数介绍：

| 名称 | 类型 | 可选值 |
|:----:|:----:|:----:|
|sort|string|`all`,`mp`,`pc`,`silver`,`furry`,`r18`|
|size|string|`large`,`mw2048`,`mw1024`,`mw690`,`small`,`bmiddle`,`thumb180`,`square`|
|type|string|`json`|
|size(r18)|string|`original`,`regular`,`thumb`,`small`|
|num|int|1-100|

说明：
1. `sort`为图片类型，默认为`all`(所有正常图)，`pc`为横屏壁纸，`mp`为竖屏壁纸，`silver`为银发，`furry`为兽耳，`r18`无需多说
2. `size`为图片规格，针对不同类型的图（r18和非r18有不同的取值），非r18默认为`large`，r18默认为`regular`
3. `type`为返回格式，未定义时默认302跳转，建议使用`json`，为防止滥用，r18一律返回json
4. `num`返回的数量，仅type=json时有效

### 调用示例
* 直接调用
```url
https://moe.jitsu.top/img/
```
* 请求类别
```url
https://moe.jitsu.top/img/?sort=furry
```
* 设置规格
```url
https://moe.jitsu.top/img/?sort=pc&size=mw1024
```
* 返回json
```url
https://moe.jitsu.top/img/?sort=silver&size=small&type=json
```
* r18调用
```url
https://moe.jitsu.top/img/?sort=r18&size=original&type=json&num=5
```

### 返回示例
```json
{
    "sort": "furry",
    "number": "5",
    "pic": [
        "https:\/\/tva4.sinaimg.cn\/mw2048\/ec43126fgy1h1ne5vl08yj228e3cuhdt.jpg",
        "https:\/\/tva4.sinaimg.cn\/mw2048\/ec43126fgy1h0hsl88hzcj21h61vihdu.jpg",
        "https:\/\/tva3.sinaimg.cn\/mw2048\/ec43126fgy1gzyi9yj1c4j21w91nwu0x.jpg",
        "https:\/\/tva4.sinaimg.cn\/mw2048\/ec43126fgy1gx5p5veh0pj21i023i1ky.jpg",
        "https:\/\/tva3.sinaimg.cn\/mw2048\/ec43126fgy1gqhauoc274j217m1kwgww.jpg"
    ],
    "warning": null
}
```
