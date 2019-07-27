<?php
// +----------------------------------------------------------------------
// | QQLogin [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2018 Tangchao All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tangchao <admin@ytecn.com>
// +----------------------------------------------------------------------
namespace plugins\qqlogin\controller;
use cmf\controller\PluginBaseController;
use think\Db;
use app\user\model\UserModel;

class IndexController extends PluginBaseController
{
    function index()
    {
        $this->config = $this->getPlugin('Qqlogin')->getConfig();
        $appid = $this->config['appid'];
        $appkey = $this->config['appkey'];
        $redirect_uri = cmf_plugin_url('Qqlogin://Index/index',array(),true);
        if (!isset($_GET['code'])) {
            $state = md5(uniqid(rand(), true));
	        $scope = 'get_user_info';
	        $login_url = "https://graph.qq.com/oauth2.0/authorize?scope={$scope}&state={$state}&response_type=code&client_id={$appid}&redirect_uri={$redirect_uri}";
            header('Location:'.$login_url);
        } else {
            $code = $_GET['code'];
	        if (empty($code)) {echo 'Error Get Authorization Code';exit();} 
	        $urldata = get_url_contents("https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id={$appid}&client_secret={$appkey}&code={$code}&redirect_uri={$redirect_uri}");
	        parse_str($urldata,$output);
	        if (empty($access_token)) {if (empty($output['access_token'])) {echo 'Error Get Access Token';exit();} else {$access_token = $output['access_token'];} } else {$output['access_token'] = $access_token;}
	        $urldata = get_url_contents("https://graph.qq.com/oauth2.0/me?access_token={$access_token}");
	        $urldata = str_replace("callback(", "", $urldata);
	        $urldata = str_replace(');', '', $urldata);
	        $urldata = json_decode($urldata, true);
	        $openid = $urldata['openid'];
	        if (empty($openid)) {echo 'Error Get Open ID';exit();} 
	        $urldata = get_url_contents("https://graph.qq.com/user/get_user_info?access_token={$access_token}&oauth_consumer_key={$appid}&openid={$openid}&format=json");
	        if (empty($urldata)) {echo 'Error Get User Info';exit();} 
	        $userinfo = json_decode($urldata, true);
            if($openid==""){
                echo "登录失败";
                die();
            }
            $guid=GetGuid();
            $userinfo['login'] = "yt_".$guid;
            $userinfo['user_pass'] = $guid;
            $userinfo['openid'] = $openid;
            $log = registerOauth($userinfo);
        }
        return $this->fetch("/index");
    }
}

function GetGuid() {
    $s = str_replace('.', '', trim(uniqid('yt', true), 'yt'));
    return $s;
}

function registerOauth($user){
        $openid = $user['openid'];
        $result = Db::name("third_party_user")->where('openid', $openid)->find();
        if (empty($result)) {
            $data   = [
                'user_login'      => $user['login'],
                'user_email'      => '',
                'mobile'          => '',
                'user_nickname'   => $user['nickname'],
                'avatar'          => $user['figureurl_2'],
                'user_pass'       => cmf_password($user['user_pass']),
                'last_login_ip'   => get_client_ip(0, true),
                'create_time'     => time(),
                'last_login_time' => time(),
                'user_status'     => 1,
                "user_type"       => 2,
            ];
            $userId = Db::name("user")->insertGetId($data);
            $data   = Db::name("user")->where('id', $userId)->find();
            $userdata   = [
                'user_id'      => $userId,
                'openid'      => $openid,
                'third_party'      => "QQ",
                'union_id'      => "QQ",
                'create_time'      => time(),
                'last_login_time'      => time(),
            ];
            $partyuserId = Db::name("third_party_user")->insertGetId($userdata);
            cmf_update_current_user($data);
            return 0;
        }else{
            $data   = Db::name("user")->where('id', $result['user_id'])->find();
            if($data['user_status']==0){
                return 3;
            }
            cmf_update_current_user($data);
            return 0;
        }
        return 1;
}

    function get_url_contents($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
    }