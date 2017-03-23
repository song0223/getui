# getui
src目录引用的[wy0727/getui](https://github.com/wy0727/getui)
<br>修正wy0727的版本的问题 
1. transmissionType的设置有点小问题导致点击通知消息不能启动app
2. AppConditions正对用户标签，属性推送功能被阉割了。。其实官方的sdk就有这个不能推送的问题  

官方sdk：
```
 IGt.Push.php 364行 $params["conditions"] = $conditions->getCondition()
 改为$params["conditions"] = $conditions
```  
wy0727版本：
```
 增加AppConditions.php文件
 IGtAppMessage() 增加$conditions属性
 IGeTui.php 412行增加$params['conditions'] = $message->getConditions();
```
可能都是小错误。不过可以减少大家蒙逼的时间<br>
$cid = 'b76542ce1927d2d994d32274f58d91fc';
$getui = new Getui;
$template = $getui->IGtNotificationTemplateDemo('哎呦我去','震惊！','大嘴一秒五喷毁灭中国电竞');
$getui->pushMessageToApp($cid,$template));
````