<?php

class Weixin extends CFormModel
{
    //微信推送的消息模板
    private function getMsgTpl($type) {
        $all_type = array(
            'text' => "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>",
            'article' => "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <ArticleCount>%s</ArticleCount>
                <Articles>
                <item>
                    <Title><![CDATA[%s]]></Title> 
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                </item>
                </Articles>
            </xml>"
        );
        return $all_type[$type];
    }

    private function curl_get($url, $params=array())             //发送get请求
    {   
        $tmp_parmas_url = "";
        if(!empty($params)) {
            foreach ($params as $key => $value) {
                if(!empty($value)){
                    if(empty($tmp_parmas_url))
                        $tmp_parmas_url = '?'. $key .'=' . urlencode($value);
                    else
                        $tmp_parmas_url .= '&'. $key .'=' . urlencode($value);
                }
            }
        }
        $s_ch = curl_init();
        curl_setopt( $s_ch, CURLOPT_URL, $url.$tmp_parmas_url);
        curl_setopt( $s_ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $s_ch, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $s_ch, CURLOPT_TIMEOUT, 5 );
        $data = curl_exec( $s_ch );

        $httpcode = curl_getinfo( $s_ch, CURLINFO_HTTP_CODE );
        curl_close( $s_ch );
        // return $url.$tmp_parmas_url;
        return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
    }

    /*通过code换取网页授权access_token 返回值为PHP数组
    {
       "access_token":"ACCESS_TOKEN",   //网页授权接口调用凭证
       "expires_in":7200,               //access_token接口调用凭证超时时间，单位（秒）
       "refresh_token":"REFRESH_TOKEN", //用户刷新access_token
       "openid":"OPENID",               //用户唯一标识
       "scope":"SCOPE",                 //用户授权的作用域，使用逗号（,）分隔
       "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
    }    */
	public static function getWebAccessToken($code="") {
        if( !empty($code) ){
            $params['appid'] = Yii::app()->params['appid'];
            $params['secret'] = Yii::app()->params['appsecret'];
            $params['code'] = $code;
            $params['grant_type'] = "authorization_code";
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token";
            $result = self::curl_get($url, $params);
            if( !empty($result['access_token']) ) {
                return CJSON::decode($result, true);
            }
            return false;
        }
        else {
            return false;
        }
	}

    /*拉取用户信息(需scope为 snsapi_userinfo)  返回值为PHP数组
    {
       "openid":" OPENID",      用户的唯一标识
       " nickname": NICKNAME,   用户昵称
       "sex":"1",               用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
       "province":"PROVINCE"    用户个人资料填写的省份
       "city":"CITY",           普通用户个人资料填写的城市
       "country":"COUNTRY",     国家，如中国为CN
        "headimgurl":           用户头像
        "privilege":            用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）
        "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
    }
    */
    public static function getUserInfo($web_access_token="", $openid="", $lang="zh_CN"){
        if( (!empty($web_access_token)) && (!empty($openid)) ) {
            $params['access_token'] = $web_access_token;
            $params['openid'] = $openid;
            $params['lang'] = $lang;
            $url = "https://api.weixin.qq.com/sns/userinfo";
            $userinfo = self::curl_get($url, $params);
            if(empty($result['errcode'])) {
                return CJSON::decode($userinfo);
            }
            else 
                return false;
        }
        else
            return false;
    }


    //处理微信推送消息接口
    public static function processText($postObj) {
        $from_username = $postObj->FromUserName;
        $to_username = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        if(!empty( $keyword )) {
            $content_str = "";
            $game_info = Game::model()->find("game_name like :t_name", array(':t_name'=>"%$keyword%"));
            if( !empty($game_info) ) {
                $content_str = "你需要查找的游戏为: ".$game_info['game_name'];
                $pic_url = $game_info['img'];
                $url = $game_info['game_url'];
                $msg_type = "news";
                $article_count = "1";
                $title = $game_info['game_name'];
                $description = $game_info['description'];
                $pic_tpl = self::getMsgTpl('article');
                $result_str = sprintf($pic_tpl, $from_username, $to_username, $time, $msg_type, $article_count,$title, $description, $pic_url,$url);
            }
            else {
                $msg_type = "text";
                $content_str = "你好，该游戏暂未上线，如果需要查游戏名，请直接输入名称";
                $text_tpl = self::getMsgTpl('text');
                $result_str = sprintf($text_tpl, $from_username, $to_username, $time, $msg_type, $content_str);
            }
            return $result_str;
        }
        else
            return "Input something...";
    }


    //处理微信推送event接口
    public static function processEvent($postObj) {
        $from_username = $postObj->FromUserName;
        $to_username = $postObj->ToUserName;
        $event = $postObj->Event;
        $time = time();
        if($event == "subscribe") {
            $suject_tmp = Subject::model()->findAll(array(
                'condition' => 'start_time <= :t_time',
                'params' => array(':t_time'=>date("Y-m-d H:i:s")),
                'order' => "start_time DESC",
                'limit'=>1,
            ));
            if(empty($suject_tmp)) {
                $msg_type = "text";
                $content_str = "你好，欢迎关注24好玩！";
                $textTpl = self::getMsgTpl('text');
                $result_str = sprintf($textTpl, $from_username, $to_username, $time, $msg_type, $content_str);
            }
            else {
                $suject_info = $suject_tmp[0];
                $pic_url = $suject_info['img'];
                $url = Yii::app()->request->hostInfo.'/main/subjectInfo/subject_id/'.$suject_info['subject_id'];
                $msg_type = "news";
                $article_count = "1";
                $title = "本期主题：".$suject_info['subject_name'];
                $description = $suject_info['subject_description'];
                $pic_tpl = self::getMsgTpl('article');
                $result_str = sprintf($pic_tpl, $from_username, $to_username, $time, $msg_type, $article_count,$title, $description, $pic_url,$url);
            }
            return $result_str;
        }
        elseif ($event='click') {
            $msg_type = "text";
            $content_str = "敬请期待！";
            $text_tpl = self::getMsgTpl('text');
            $result_str = sprintf($text_tpl, $from_username, $to_username, $time, $msg_type, $content_str);
            return $result_str;
        }
        else
            return "Input something...";
    }

    public static function test() {
        $textTpl = self::getMsgTpl('text');
        $resultStr = sprintf($textTpl, "fromUsername", "toUsername", 32143, "msgType", "contentStr");
        return $resultStr;
    }

}