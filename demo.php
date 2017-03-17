<?php
/**
 * Created by PhpStorm.
 * User: sxxxx
 * Date: 2017/3/16
 * Time: 16:48
 */

namespace getui;
use getuisdk\IGeTui;
use getuisdk\IGtAppMessage;
use getuisdk\IGtAPNPayload;
use getuisdk\IGtBaseTemplate;
use getuisdk\IGtBatch;
use getuisdk\IGtNotificationTemplate;
use getuisdk\DictionaryAlertMsg;
use getuisdk\IGtSingleMessage;
use getuisdk\IGtTarget;
use getuisdk\IGtTransmissionTemplate;
use getuisdk\IGtNotyPopLoadTemplate;
use getuisdk\IGtLinkTemplate;
use getuisdk\IGtListMessage;

class Getui
{
    protected $host = 'http://sdk.open.api.igexin.com/apiex.htm';
    //https的域名
    //protected $host = 'https://api.getui.com/apiex.htm';
    protected $appkey = 'appkey';
    protected $appid = 'appid';
    protected $mastersecret = 'mastersecret';
    protected $cid = '';
    protected $devivetoken = '';
    protected $alias = '';

    /**
     * 通知透传模板
     * @param $content string  透传内容
     * @param $title string    通知栏标题
     * @param $text string     通知栏内容
     * @param $logoUrl string  通知栏logo
     * @return IGtNotificationTemplate
     */
    public function IGtNotificationTemplateDemo($content,$title,$text,$logoUrl){
        $template =  new IGtNotificationTemplate();
        $template->setAppId($this->appid);//应用appid
        $template->setAppKey($this->appkey);//应用appkey
        $template->setTransmissionType(2);//透传消息类型
        $template->setTransmissionContent($content);
        $template->setTitle($title);
        $template->setText($text);
        $template->setLogo($logoUrl);
        $template->setIsRing(true);//是否响铃
        $template->setIsVibrate(true);//是否震动
        $template->setIsClearable(true);//通知栏是否可清除

        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = "alertMsg";
//        $apn->badge = 11;
//        $apn->actionLocKey = "启动";
//    //        $apn->category = "ACTIONABLE";
//    //        $apn->contentAvailable = 1;
//        $apn->locKey = "通知栏内容";
//        $apn->title = "通知栏标题";
//        $apn->titleLocArgs = array("titleLocArgs");
//        $apn->titleLocKey = "通知栏标题";
//        $apn->body = "body";
//        $apn->customMsg = array("payload"=>"payload");
//        $apn->launchImage = "launchImage";
//        $apn->locArgs = array("locArgs");
//
//        $apn->sound=("test1.wav");;
//        $template->set_apnInfo($apn);
        return $template;
    }

    /**
     * 透传模板
     * @param $content
     * @return IGtTransmissionTemplate
     */
    public function IGtTransmissionTemplateDemo($content){
        $template =  new IGtTransmissionTemplate();
        $template->setAppId($this->appid);//应用appid
        $template->setAppkey($this->appkey);//应用appkey
        $template->setTransmissionType(1);//透传消息类型
        $template->setTransmissionContent($content);//透传内容

        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //APN简单推送
        //$template = new IGtAPNTemplate();
        //$apn = new IGtAPNPayload();
        //$alertmsg=new SimpleAlertMsg();
        //$alertmsg->alertMsg="";
        //$apn->alertMsg=$alertmsg;
        //$apn->badge=2;
        //$apn->sound="";
        //$apn->add_customMsg("payload","payload");
        //$apn->contentAvailable=1;
        //$apn->category="ACTIONABLE";
        //$template->set_apnInfo($apn);
        //$message = new IGtSingleMessage();

        //APN高级推送
        $apn = new IGtAPNPayload();
        $alertmsg=new DictionaryAlertMsg();
        $alertmsg->body="body";
        $alertmsg->actionLocKey="ActionLockey";
        $alertmsg->locKey="LocKey";
        $alertmsg->locArgs=array("locargs");
        $alertmsg->launchImage="launchimage";
        //IOS8.2 支持
        $alertmsg->title="Title";
        $alertmsg->titleLocKey="TitleLocKey";
        $alertmsg->titleLocArgs=array("TitleLocArg");

        $apn->alertMsg=$alertmsg;
        $apn->badge=7;
        $apn->sound="";
        $apn->addCustomMsg("payload","payload");
        $apn->contentAvailable=1;
        $apn->category="ACTIONABLE";
        $template->setApnInfo($apn);

        //PushApn老方式传参
        //$template = new IGtAPNTemplate();
        //$template->setPushInfo("", 10, "", "com.gexin.ios.silence", "", "", "", "");
        return $template;
    }

    /**
     * 通知弹框下载模板
     * @return IGtNotyPopLoadTemplate
     */
    public function IGtNotyPopLoadTemplateDemo(){
        $template =  new IGtNotyPopLoadTemplate();

        $template ->setAppId($this->appid);//应用appid
        $template ->setAppkey($this->appkey);//应用appkey
        //通知栏
        $template ->setNotyTitle("个推");//通知栏标题
        $template ->setNotyContent("个推最新版点击下载");//通知栏内容
        $template ->setNotyIcon("");//通知栏logo
        $template ->setIsBelled(true);//是否响铃
        $template ->setIsVibrationed(true);//是否震动
        $template ->setIsCleared(true);//通知栏是否可清除
        //弹框
        $template ->setPopTitle("弹框标题");//弹框标题
        $template ->setPopContent("弹框内容");//弹框内容
        $template ->setPopImage("");//弹框图片
        $template ->setPopButton1("下载");//左键
        $template ->setPopButton2("取消");//右键
        //下载
        $template ->setLoadIcon("");//弹框图片
        $template ->setLoadTitle("地震速报下载");
        $template ->setLoadUrl("http://dizhensubao.igexin.com/dl/com.ceic.apk");
        $template ->setLsAutoInstall(false);
        $template ->setLsActived(true);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        return $template;
    }

    /**
     * 通知链接模板
     * @param $title   string 通知栏标题
     * @param $content string 通知栏内容
     * @param $logo    string 通知栏logo
     * @param $url     string 打开连接地址
     * @return IGtLinkTemplate
     */
    public function IGtLinkTemplateDemo($title,$content,$logo,$url){
        $template =  new IGtLinkTemplate();
        $template ->setAppId($this->appid);//应用appid
        $template ->setAppkey($this->appkey);//应用appkey
        $template ->setTitle($title);
        $template ->setText($content);
        $template ->setLogo($logo);
        $template ->setIsRing(true);//是否响铃
        $template ->setIsVibrate(true);//是否震动
        $template ->setIsClearable(true);//通知栏是否可清除
        $template ->setUrl($url);
        //$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息
        //iOS推送需要设置的pushInfo字段
//        $apn = new IGtAPNPayload();
//        $apn->alertMsg = "alertMsg";
//        $apn->badge = 11;
//        $apn->actionLocKey = "启动";
//    //        $apn->category = "ACTIONABLE";
//    //        $apn->contentAvailable = 1;
//        $apn->locKey = "通知栏内容";
//        $apn->title = "通知栏标题";
//        $apn->titleLocArgs = array("titleLocArgs");
//        $apn->titleLocKey = "通知栏标题";
//        $apn->body = "body";
//        $apn->customMsg = array("payload"=>"payload");
//        $apn->launchImage = "launchImage";
//        $apn->locArgs = array("locArgs");
//
//        $apn->sound=("test1.wav");;
//        $template->set_apnInfo($apn);
        return $template;
    }

    /**
     * 单推接口案例
     * @param $clientId cid
     * @param $template 模板
     * @return bool
     */
    public function pushMessageToSingle($clientId,$template){
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);

        //个推信息体
        $message = new IGtSingleMessage();

        $message->setIsOffline(true);//是否离线
        $message->setOfflineExpireTime(3600*12*1000);//离线时间
        $message->setData($template);//设置推送消息类型
        //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        //接收方
        $target = new IGtTarget();
        $target->setAppId($this->appid);
        $target->setClientId($clientId);
        //$target->set_alias(Alias);

        try {
            $rep = $igt->pushMessageToSingle($message, $target);
            return $rep;
        }catch(RequestException $e){
            $requstId =$e->getRequestId();
            $rep = $igt->pushMessageToSingle($message, $target,$requstId);
            return $rep;
        }

    }

    /**
     * 多推接口案例 对指定列表用户推送消息
     * @param $template
     * @param $clientId
     * @param $toList
     * @return \getuisdk\Array
     */
    public function pushMessageToList($template,$clientId,$toList)
    {
        putenv("gexin_pushList_needDetails=true");
        putenv("gexin_pushList_needAsync=true");

        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        //个推信息体
        $message = new IGtListMessage();
        $message->setIsOffline(true);//是否离线
        $message->setOfflineExpireTime(3600 * 12 * 1000);//离线时间
        $message->setData($template);//设置推送消息类型
        //$message->setPushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
        //$contentId = $igt->getContentId($message);
        $contentId = $igt->getContentId($message,$toList);	//根据TaskId设置组名，支持下划线，中文，英文，数字

        //接收方1
        $target1 = new IGtTarget();
        $target1->setAppId($this->appid);
        $target1->setClientId($clientId);
        //$target1->set_alias(Alias);
        //接收方2
        $target2 = new IGtTarget();
        $target2->setAppId($this->appid);
        $target2->setClientId($clientId);
        $targetList[0] = $target1;
        $targetList[1] = $target2;

        $rep = $igt->pushMessageToList($contentId, $targetList);
        return $rep;
    }

    /**
     * 群推接口案例
     * @param $template
     * @return mixed|null
     */
    public function pushMessageToApp($template){
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        //$template = IGtTransmissionTemplateDemo();
        //$template = IGtLinkTemplateDemo();
        //个推信息体
        //基于应用消息体
        $message = new IGtAppMessage();
        $message->setIsOffline(true);
        $message->setOfflineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->setData($template);

        $appIdList=array($this->appid);
        $phoneTypeList=array('ANDROID');
        $provinceList=array('浙江');
        $tagList=array('haha');
        //用户属性
        //$age = array("0000", "0010");

        //$cdt = new AppConditions();
        // $cdt->addCondition(AppConditions::PHONE_TYPE, $phoneTypeList);
        // $cdt->addCondition(AppConditions::REGION, $provinceList);
        //$cdt->addCondition(AppConditions::TAG, $tagList);
        //$cdt->addCondition("age", $age);

        $message->setAppIdList($appIdList);
        //$message->set_conditions($cdt->getCondition());

        $rep = $igt->pushMessageToApp($message,"任务组名");
        return $rep;
    }

    /**
     * 批量单推功能
     * @param $template
     * @param $clientId
     * @return mixed
     */
    public function pushMessageToSingleBatch($template,$clientId)
    {
        putenv("gexin_pushSingleBatch_needAsync=false");

        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        $batch = new IGtBatch($this->appkey, $igt);
        $batch->setApiUrl($this->host);
        //$igt->connect();
        //消息模版：
        // 1.TransmissionTemplate:透传功能模板
        // 2.LinkTemplate:通知打开链接功能模板
        // 3.NotificationTemplate：通知透传功能模板
        // 4.NotyPopLoadTemplate：通知弹框下载功能模板

        //个推信息体
        $message = new IGtSingleMessage();
        $message->setIsOffline(true);//是否离线
        $message->setOfflineExpireTime(12 * 1000 * 3600);//离线时间
        $message->setData($template);//设置推送消息类型
        //$message->setPushNetWorkType(1);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送

        $target = new IGtTarget();
        $target->setAppId($this->appid);
        $target->setClientId($clientId);
        $batch->add($message, $target);
        try {
            $rep = $batch->submit();
            return $rep;
        }catch(Exception $e){
            $rep=$batch->retry();
            return $rep;
        }
    }

    /**
     * 通过服务端设置ClientId的标签
     * @param $clientId
     * @param array $tagList
     * @return bool
     */
    public function setTag($clientId,array $tagList){
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        $rep = $igt->setClientTag($this->appid,$clientId,$tagList);
        return $rep;
    }

    /**
     * 获取ClientId的标签
     * @param $clientId
     * @param array $tagList
     * @return mixed|null
     */
    public function getUserTags($clientId,array $tagList) {
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        $rep = $igt->getUserTags($this->appid,$clientId,$tagList);
        return $rep;
    }

    /**
     * 用户状态查询
     * @param $clientId
     * @return mixed|null
     */
    public function getUserStatus($clientId) {
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        $rep = $igt->getClientIdStatus($this->appid,$clientId);
        return $rep;
    }

    /**
     * 推送任务停止
     */
    public function stoptask(){
        $igt = new IGeTui($this->host,$this->appkey,$this->mastersecret);
        $igt->stop("OSA-1127_QYZyBzTPWz5ioFAixENzs3");
    }
}