> 代码来自网络，我稍作修改，没学过PHP，所以写得很烂

三个参数：`sort` `num` `type`<br>
1. `sort`为图片的类别
2. `num`为返回图片链接的数量
3. `type`为返回的格式

### 说明
- 图片直链存放在txt文件中，每行一个
- api默认读取当前目录txt文件夹下存放链接的.txt文件，自行更改
- `sort`的值即为txt文件的主文件名，`sort`为pc则读取txt文件夹下的pc.txt文件
- `num`的取值在1到100之间，默认为一（即返回一张图）
- `type`值可选json或不填，默认302跳转，当`num`大于等于2时默认返回json

### 参考
[我的API文档](https://img.jitsu.top)
