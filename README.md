# getui
src目录引用的[wy0727/getui](https://github.com/wy0727/getui)
<br>然后根据官网弄了个demo自己框架用用
````        
$cid = 'b76542ce1927d2d994d32274f58d91fc';
$getui = new Getui;
$template = $getui->IGtNotificationTemplateDemo('哎呦我去','震惊！','大嘴一秒五喷毁灭中国电竞');
$getui->pushMessageToApp($cid,$template));
````