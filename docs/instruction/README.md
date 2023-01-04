> 虽然很遗憾，但是微博再次加防盗链了，现在图片只能下载，暂时无法直接在线访问，暂时还没转移，等待修复吧
> 2023.1.4 维护完了，size参数有部分改动，其他的暂时没变

> 能别整天爬来爬去恶心人吗

> 这里加一点杂谈
>
> 咕咕咕，好久没更新文档了，其实API还是有一直在更新，图片的数量也在尽力增加
>
> p站的反代服务一直用的[神代綺凛](https://moe.best)大佬写的node.js的代码，但是这玩意儿似乎太久没维护了，而p站又一直在更新，导致反代的某些功能出现了问题，API返回的部分图片无法正常打开，只好简单地重写了一下逻辑
>
> 另外之前由于时间与技术的原因，这篇文档写得其实也并不是十分详细，今天就尽力补充一下吧，希望你能尽量把这个读完



> 使用过程中你可能会遇到部分图片404等情况，~~那就是寄掉了，问我也没用，~~可能是p站的作品被画师删除了或者设置成了非公开



### 使用说明

1. **请求方式：** GET / POST

2. 返回格式：302跳转 / JSON

3. **请求地址：**

   - 国内源：https://moe.anosu.top/img

     或者：https://api.anosu.top/img

   - 国外源：https://moe.jitsu.top/img

     或者：https://api.jitsu.top/img

   > 以上两域名可互换，国内源不提供r18的302跳转

4. **参数说明：**

&emsp;&nbsp;&nbsp;对于不同类的sort有不同的参数，因此分两大类来说明，sort默认为`all`

- 对于第一类图片（图源不在p站），详见下表中的`sort`

| 名称 |  类型  |    说明    |                            可选值                            |
| :--: | :----: | :--------: | :----------------------------------------------------------: |
| sort | string | 图片的分类 | `all`, `mp`, `pc`, `1080p`, `silver`, `furry`, `starry`, `setu`, `ws` |
| size | string | 图片的规格 | `original`<br />`mw`前缀(最大宽度)：4096, 3840, 2048, 1920, 1024, 960, 512, 480, 256, 240, 128,120<br />常用：`2160p`, `1440p`, `1080p`, `720p`, `480p`<br />`sq`前缀(方形)：2048, 1024, 512, 256, 128<br />默认为`original` |
| type | string | 返回的格式 |      `json`<br />默认为302跳转，num大于1时强制为`json`       |
| num  |  int   | 返回的数量 |                            1-100                             |

|  sort  |                         类型                         |
| :----: | :--------------------------------------------------: |
|  all   |                       全部图片                       |
|   mp   |                       手机壁纸                       |
|   pc   |                       桌面壁纸                       |
| 1080p  |                     1920 x 1080                      |
| silver |                         银发                         |
| furry  | 兽耳（这里多有歧义，我英文取的有问题，不要在意细节） |
| starry |                         星空                         |
|  setu  |                     涩图（不漏）                     |

​     

- 对于第二类图片（图源在p站），详见下表中的`sort`

| 名称  |  类型  |           说明           |                            可选值                            |
| :---: | :----: | :----------------------: | :----------------------------------------------------------: |
| sort  | string |        图片的分类        |                   `pixiv`, `r18`, `jitsu`                    |
| size  | string |        图片的规格        | `original`, `regular`, `small`, `thumb`, `mini`<br />默认为`regular` |
| type  | string |        返回的格式        |      `json`<br />默认为302跳转，num大于1时强制为`json`       |
|  num  |  int   |        返回的数量        |                            1-100                             |
| proxy | string | 图片链接所使用的反代地址 | `i.pixiv.re`<br />默认使用麒麟佬的`i.loli.best`<br />也可以自建反代，请看文末 |

| sort  |          类型          |
| :---: | :--------------------: |
| pixiv |    p站图（不含18+）    |
|  r18  |        顾名思义        |
| jitsu | 我的p站收藏（不含18+） |

5. **补充说明：**
   - 对于API的请求地址，可将`img`改为`api`以提高响应速度，即
   
     ```url
     https://moe.jitsu.top/api
     ```
   
     区别在于：`api`仅有`sort`、`num`和`type`三个可选参数（两类图片均如此），`size`均为`large`或者`original`（可请求后自行replace），第二类图片`proxy`均为`i.pixiv.re`
   
   - 第一类图片的`size`也可自行发挥，参见https://cloud.baidu.com/doc/BOS/s/gkbisf3l4，你只需要按照规定的格式输入就行，如
   
     ```url
     https://moe.jitsu.top/img/?type=json&size=m_fill,w_233,h_233
     ```
   
     为保证可用性，API已强制设置`limit_1`
   
   - API已添加允许跨域策略
   
   - 如果你有根据关键词查询的需求，请移步https://image.anosu.top



### 调用示例
- 直接调用

  https://moe.jitsu.top/img

- 类别数量

  https://moe.jitsu.top/img/?sort=pixiv&num=3

- 设置规格

  https://moe.jitsu.top/img/?sort=pc&size=mw1024

- 返回json

    https://moe.jitsu.top/img/?sort=r18&size=1080p&type=json

- 设置反代

  https://moe.jitsu.top/img/?sort=jitsu&size=original&type=json&num=5&proxy=i.pixiv.re




### 返回示例
```json
[{
    "code": 200,
    "pics": [
        "https://bj.bcebos.com/baidu-rmb-video-cover-1/26ae0f1e24a5279dd2e3651acecf16b0.jpeg?x-bce-process=image/resize,limit_1,m_lfit,w_1024",
        "https://bj.bcebos.com/baidu-rmb-video-cover-1/a2c6bb2ed2ecda2669b015f83d58559b.jpeg?x-bce-process=image/resize,limit_1,m_lfit,w_1024",
        "https://bj.bcebos.com/baidu-rmb-video-cover-1/a03ecc7c398294c119ccd6db4c19c7b4.jpeg?x-bce-process=image/resize,limit_1,m_lfit,w_1024",
        "https://bj.bcebos.com/baidu-rmb-video-cover-1/fa7b55586964294f751bfcaca5293de7.jpeg?x-bce-process=image/resize,limit_1,m_lfit,w_1024",
        "https://bj.bcebos.com/baidu-rmb-video-cover-1/749ee90b72138d807935bf585e40da59.jpeg?x-bce-process=image/resize,limit_1,m_lfit,w_1024"
    ]
}]
```



### 关于反代的搭建

pixiv.cat中已经提供了两种方法，分别是直接用Nginx和用js运行在CloudFlare Workers上，这里就不再赘述

详情请移步 https://pixiv.cat/reverseproxy.html



### 特别鸣谢

- [MirlKoi](https://iw233.cn) 本API大部分的图都来自iw233大佬
