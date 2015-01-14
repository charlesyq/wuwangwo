<?php namespace App\Services\Push\Providers;

use App\Repositories\DeviceRepository;
use App\Services\Push\Contracts\Provider;
use IGeTui;
use IGtNotificationTemplate;
use IGtSingleMessage;
use IGtTarget;
use IGtTransmissionTemplate;

require_once base_path() . '/lib/getui/IGt.Push.php';

class GetuiPushProvider implements Provider {
    /**
     * @param array $config
     * @param IGeTui $igt
     * @param DeviceRepository $deviceRepo
     */
    function __construct(array $config, IGeTui $igt, DeviceRepository $deviceRepo)
    {
        $this->igt = $igt;
        $this->config = $config;
        $this->deviceRepo = $deviceRepo;
    }

    function pushNotification($userId, $title, $content, $badge = 1)
    {
        $device = $this->deviceRepo->getUserDevice($userId);
        if($device && $device->getui_clientid){
            $os = strtolower($device->os);

            if(strpos($os, 'ios') !== false) {
                $this->iosPushTransmission($device->getui_clientid, $title.":".$content, $badge);
            }else{
                $this->pushTransmission($device->getui_clientid, $title, $content);
            }
        }
    }

    function pushTransmission($cid, $title, $content, $badge = 1)
    {
        $expire=0;
        $isOffline = true;

        $template =  new IGtNotificationTemplate();

        $template ->set_appId($this->config['app_id']);
        $template ->set_appkey($this->config['app_key']);

        if($this->platform == 'android'){
            //   $template->set_transmissionType(2);//透传消息类型
            //   $template->set_transmissionContent("");//透传内容
            $template->set_title($title);//通知栏标题
            $template->set_text($content);//通知栏内容
            $template->set_logo($this->config['app_icon']);//通知栏logo
            $template->set_isRing(true);//是否响铃
            $template->set_isVibrate(true);//是否震动
            $template->set_isClearable(true);//通知栏是否可清除

            $template->set_transmissionType(1);
        }else{
            // iOS推送需要设置的pushInfo字段
            $template ->set_pushInfo(
                $this->pushInfo['actionLocKey'],
                $this->pushInfo['badge'],
                $title ." : ". $content,
                $this->pushInfo['sound'],
                $this->pushInfo['payload'],
                $this->pushInfo['locKey'],
                $this->pushInfo['locArgs'],
                $this->pushInfo['launchImage']
            );
        }


        $message = new IGtSingleMessage();

        $message->set_isOffline($isOffline);
        $message->set_offlineExpireTime($expire);
        $message->set_data($template);

        return $this->_push_msg($message, $cid);
    }

    function iosPushTransmission($cid,$content,$badge=1){

        $template = new IGtTransmissionTemplate();
        $template ->set_appId($this->config['app_id']);
        $template ->set_appkey($this->config['app_key']);

        $template->set_transmissionType(1);
        $template->set_transmissionContent("");

        $template->set_pushInfo("", $badge, $content, "","", "", "", "");

        $message = new IGtSingleMessage();

        $message->set_isOffline(true);
        //$message->set_offlineExpireTime($expire);
        $message->set_data($template);
        return $this->_push_msg($message,$cid);
    }

    function _push_msg($message,$cid) {
        $target = new IGtTarget();
        $target->set_appId($this->config['app_id']);
        $target->set_clientId($cid);

        return $this->igt->pushMessageToSingle($message, $target);
    }
}