<?php

class MainController extends Controller
{
    public $layout = false;

	public function actionIndex() {
        // $code = empty($_GET['code'])? "" : $_GET['code'];
        //根据微信请求的code，获取用户信息
        // $user_info = "";
        // if(!empty($code)) {
        //     $user_info = User::getLocalUserInfo($code);
        // }
        // $signPackage = Credential::getSignPackage();
        
        // $use_openid = empty($user_info)?"" : $user_info['openid'];
        $game_id = 1;

        // if(!empty($user_info['openid'])) {
            // $user_name = CJSON::encode($user_info);
            $this->render('index');
        // echo "2312";
        // }
        // else {
        //     // $this->render('index', array("signPackage"=>$signPackage, 'openid'=>$use_openid, 'game_id'=>$game_id) );
        //     header('Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef721b05e2002815&redirect_uri=http%3A%2F%2Fglgl-dev.shanyougame.com%2F&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
        // }
	}

    public function actionError() {
        echo "erro";
        // header('Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef721b05e2002815&redirect_uri=http%3A%2F%2Fglgl-dev.shanyougame.com%2F&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
    }
}