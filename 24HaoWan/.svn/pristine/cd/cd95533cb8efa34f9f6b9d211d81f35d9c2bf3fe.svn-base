<?php

class MainController extends Controller
{
    public $layout = false;
    public $url;
    public $weixin_auth;
    public $signPackage;
    public $openid;
    public $game_id;
    public $game_name;
    public $user_result;
    public $game_time;
    public $headimgurl;
    public $badge;
    public $is_attention = 'no';

    public function filters()
    {
        $this->url = Yii::app()->request->getUrl();
        return array('verify -  login error index ShareGame test');
    }

    //定义的过滤方法
    public function FilterVerify($filterChain)
    {
        //判断什么的
        
        // Yii::app()->session['openid'] = "o_68bwMPb_UBTuj60QwswpB8tynM";
        $openid = Yii::app()->session['openid'];
        $signPackage = Credential::getSignPackage();
        $this->signPackage = $signPackage;
        
        Yii::app()->session['from_user'] = empty($_GET['from_user'])? "" : $_GET['from_user'];

        if( AttentionUser::model()->find('openid =:t_openid', array(':t_openid'=>$openid) ) ) {
            $this->is_attention = 'yes';
        }

        if(!$user_info = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid)) )    //如果用户未登录，则进行微信认证
        {   
            $appid = Yii::app()->params['appid'];
            $redirect_url = Yii::app()->params['redirectUrl'];
            $this->weixin_auth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_url."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            Yii::app()->session['refer'] = Yii::app()->request->getUrl();
            header('Location: '. $this->weixin_auth);
        }
        else {
            $from_user_id = Yii::app()->session['from_user'];
            $to_user_id = Yii::app()->session['user_id'];
            Relationship::createRelation($from_user_id, $to_user_id);       //记录用户关系

            $this->openid = Yii::app()->session['openid'];
            $filterChain->run();
        }
    }

    public function actionLogin($from="weixin") {   //微信授权登陆页面
        $code = empty($_GET['code'])? "" : $_GET['code'];
        if(!empty($code)) {
            $user_info = User::getLocalUserInfo($code, $from);
            if(User::getCookie('openid')!=$user_info['openid']) {
                User::setCookie('openid',$user_info['openid']);            //设置cookie
            }
            Yii::app()->session['openid'] = $user_info['openid'];          //设置session
            Yii::app()->session['user_id'] = $user_info['user_id'];        //设置session

            $from_user_id = Yii::app()->session['from_user'];
            Relationship::createRelation($from_user_id, $user_info['user_id']);   //记录用户关系

            $this->redirect(Yii::app()->session['refer']);
        }
    }

    public function actionTest() {
        $code = empty($_GET['code'])? "" : $_GET['code'];
        if(!empty($code)) {
            $web_access_token_arr = Weixin::getWebAccessToken($code);
            $web_access_token = $web_access_token_arr['access_token'];
            $openid = $web_access_token_arr['openid'];
            $weixin_user_info = Weixin::getUserInfo($web_access_token, $openid);
            echo $weixin_user_info;
        }
    }

    public function actionIndex() {   //接收微信的消息推送
        //接收微信推送的消息
        if(isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
            if($postStr = $GLOBALS["HTTP_RAW_POST_DATA"]) {
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $msgType = trim($postObj->MsgType);
                switch ($msgType) {
                    case 'text':
                        echo Weixin::processText($postObj);
                        break;
                    case 'event':
                        echo Weixin::processEvent($postObj);
                        break;
                    default:
                        echo "测试";
                        break;
                }
            }
        }
        else
            $this->render('default');
    }

	public function actionGame($game_id="",$from="weixin") {   //游戏
        $this->layout = 'game';
        $openid = Yii::app()->session['openid'];
        // $signPackage = Credential::getSignPackage();
        if( $game_info = Game::model()->findByPk($game_id) ) {
            //获取当前用户的排名情况
            $user_result = array('rank'=>0, 'persent'=>0,'score'=>0, 'role_id'=>0, 'stage'=>0, 'last_score'=>0);
            if($user_info = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid))) {
                $user_score_info = UserScore::model()->find('game_id=:t_game_id and user_id=:t_user_id',
                    array(':t_game_id'=>$game_id, ":t_user_id"=>$user_info['user_id'] ) );

                if(!empty($user_score_info)) {
                    $user_result = UserScore::getScoreSort($game_id, $user_score_info['score'], $user_info['user_id']);
                    $user_result['score'] = $user_score_info['score'];
                    $user_result['role_id'] = $user_score_info['role_id'];
                    $user_result['stage'] = $user_score_info['stage'];
                    $user_result['last_score'] = $user_score_info['last_score'];
                    $user_score_info['from'] = $from;
                    $user_score_info->save();
                }
                else {
                    $user_score_info = new UserScore;
                    $user_score_info['user_id'] = $user_info['user_id'];
                    $user_score_info['game_id'] = $game_id;
                    $user_score_info['last_score'] = 0;
                    $user_score_info['badge'] = 0;
                    $user_score_info['from'] = $from;
                    $user_score_info['create_time'] = date("Y-m-d H:i:s");
                    $user_score_info['update_time'] = date("Y-m-d H:i:s");

                    if($subject_info = Subject::model()->findByPk($game_info['subject_id'])) {
                        $subject_info['quantity'] = (int)$subject_info['quantity'] + 1;
                        $subject_info->save();
                    }
                    $game_info['quantity'] = (int)$game_info['quantity'] + 1;
                    $game_info->save();
                    $user_score_info->save();
                }
                $this->headimgurl = $user_info['headimgurl'];
            }
            //增加专题和游戏的人气
            // if($subject_info = Subject::model()->findByPk($game_info['subject_id'])) {
            //     $subject_info['quantity'] = (int)$subject_info['quantity'] + 1;
            //     $subject_info->save();
            // }
            // $game_info['quantity'] = (int)$game_info['quantity'] + 1;
            // $game_info->save();

            $arr = array('周天','周一','周二','周三','周四','周五','周六');
            $time_stamp = strtotime($game_info['start_time']);
            $game_time = date('m.d',$time_stamp) . " " .$arr[date('w',$time_stamp)];

            if($user_result['score']==0) {
                $user_result = null;
            }
            $user_result = CJSON::encode($user_result);
            // $signPackage = CJSON::encode($signPackage);

            $this->game_id = $game_id;
            $this->game_name = $game_info['game_name'];
            $this->badge = $user_score_info['badge'];
            $this->user_result = $user_result;
            $this->game_time = $game_time;
            // $this->signPackage = $signPackage;

            $this->render('/game/game'.$game_id);
            // echo $this->signPackage;
            // echo $game_id;
        }
	}

    //本期专题
    public function actionSubjectInfo($subject_id="") {
        $current_time = date('Y-m-d H:i:s');
        if(empty($subject_id)) {          //如果主题为空，则返回最新主题
            $subject_info = Subject::model()->find('start_time <= :t_time', array(':t_time'=>$current_time));
        }
        else {
            $subject_info = Subject::model()->findByPk($subject_id);
        }
        $game_info_list = array();
        $game_wait_list = array();
        if(!empty($subject_info)) {  //查找本期所有开始的专题
            //查找未上线的游戏
            $arr = array('周天','周一','周二','周三','周四','周五','周六');
            $game_wait_list = Game::model()->findAll('start_time >:t_start_time and subject_id =:current_subject_id', 
                array(':t_start_time'=>$current_time, ':current_subject_id'=>$subject_info['subject_id']));
            
            foreach ($game_wait_list as $key => $value) {
                $time_stamp = strtotime($value['start_time']);
                $game_wait_list[$key]['start_time'] = date('m.d',$time_stamp) . " " .$arr[date('w',$time_stamp)];
            }

            $game_info_list = Game::model()->findAll(array(
                'condition' => 'subject_id =:current_subject_id and start_time <=:t_start_time',
                'params' => array(':current_subject_id'=>$subject_info['subject_id'], ':t_start_time'=>$current_time),
                'order' => 'start_time DESC', 
            ));
            //修改游戏的时间为指定的格式
            foreach ($game_info_list as $key => $value) {
                $game_info_list[$key] = $game_info_list[$key]->attributes;   //将AR对象转换为 array
                $time_stamp = strtotime($value['start_time']);
                $game_info_list[$key]['start_time'] = date('m.d',$time_stamp) . " " .$arr[date('w',$time_stamp)];

                //根据游戏ID、玩家ID查找玩家成绩
                $game_id = $value['game_id'];
                $openid = Yii::app()->session['openid'];
                $user_info = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid));
                $user_score_info = UserScore::model()->find('game_id=:t_game_id and user_id=:t_user_id',
                    array(':t_game_id'=>$game_id, ":t_user_id"=>$user_info['user_id'] )
                );
                if(!empty($user_score_info)) {
                    $game_info_list[$key]['last_score'] = $user_score_info['last_score'];
                    $game_info_list[$key]['score'] = $user_score_info['score'];

                    //查询玩家的排名、击败多少人
                    $rank_persent = UserScore::getScoreSort($game_id, $user_score_info['score'], $user_info['user_id']);
                    $game_info_list[$key]['rank'] = $rank_persent['rank'];
                    $game_info_list[$key]['persent'] = $rank_persent['persent'];
                }
                else {
                    $game_info_list[$key]['last_score'] =0;
                    $game_info_list[$key]['score'] =0;
                    $game_info_list[$key]['rank'] =0;
                    $game_info_list[$key]['persent'] =0;
                }
            }
        }
        $subject_info = CJSON::encode($subject_info);
        $game_info_list = CJSON::encode($game_info_list);
        $game_wait_list = CJSON::encode($game_wait_list);
        // echo Yii::app()->session['openid'];
        // $this->render('subjectInfo', array('subject_info'=>$subject_info, 'game_list'=>$game_info_list, 'game_wait_list'=>$game_wait_list));
        if(empty($subject_id)) {
            header('Location: http://mp.weixin.qq.com/s?__biz=MzI1MDA3NDY1OQ==&mid=401011349&idx=1&sn=2dbdfe4fafc8cabca740ac3d2af69d39#rd');
        }
        else {
            $this->render('subjectInfo', array('subject_info'=>$subject_info, 'game_list'=>$game_info_list, 'game_wait_list'=>$game_wait_list));
        }
    }

    //历史专题
    public function actionSubject() {
        header('Location: http://24haowan.shanyougame.com/main/subjectInfo/subject_id/1');
        // $current_time = date('Y-m-d H:i:s');
        // $game_info_list = array();
        // $arr = array('周天','周一','周二','周三','周四','周五','周六');
        // $subject_list = Subject::model()->findAll('start_time <= :t_time', array(':t_time'=>$current_time));
        // foreach ($subject_list as $key => $value) {
        //     $time_stamp = strtotime($value['start_time']);
        //     $subject_list[$key]['start_time'] = date('m.d',$time_stamp) . " " .$arr[date('w',$time_stamp)];
        // }
        // $subject_list = CJSON::encode($subject_list);
        // $this->render('subject', array('subject_list'=>$subject_list));
    }

    //玩过的游戏
    public function actionHistoryGame() {
        $openid = Yii::app()->session['openid'];
        $user_info = User::model()->find("openid =:t_openid", array(':t_openid'=>$openid));
        $score_list = UserScore::model()->findAll('user_id=:t_user_id', array(':t_user_id'=>$user_info['user_id']));
        $game_list = array();
        foreach ($score_list as $key => $value) {
            $score_result = UserScore::getScoreSort($value['game_id'], $value['score'], $user_info['user_id']);
            if($game_info = Game::model()->findByPk($value['game_id'])) {
                $game_list[] = array(
                    'game_id'=>$game_info['game_id'],'game_name'=>$game_info['game_name'],
                    'share_img'=>$game_info['share_img'], 'rank'=>$score_result['rank'], 
                    'score' =>$value['score'],'game_url'=>$game_info['game_url'], 
                    'quantity'=>$game_info['quantity'],'badge'=>$value['badge']
                );
            }
        }
        $game_list = CJSON::encode($game_list);
        // echo $game_list;
        $this->render('historyGame', array('game_list'=>$game_list));
    }

    //评论页面
    public function  actionComment($game_id="") {
        if( $game_info = Game::model()->findByPk($game_id) ) {
            $comment_result = array();
            $comment_list = Comment::model()->findAll(array(
                'condition' => 'game_id=:t_game_id',
                'params' => array(':t_game_id'=>$game_info['game_id']),
                'order' => 'update_time DESC',
                'limit' =>20,
            ));

            foreach ($comment_list as $key => $value) {
                $user_info = User::model()->findByPk($value['user_id']);
                if(!empty($user_info)) {
                    $comment_result[] = array(
                        'user_id'=>$user_info['user_id'], 'user_name'=>$user_info['name'],
                        'headimgurl'=>$user_info['headimgurl'],'update_time'=>$value['update_time'], 
                        'star'=>$value['star'], 'comment'=>$value['comment']
                    );
                }
            }
            $game_info = CJSON::encode($game_info);
            $comment_result = CJSON::encode($comment_result);
            $this->render('comment', array('game_info'=>$game_info, 'comment_list'=>$comment_result));
        }
    }

    public function actionEditComment($game_id="") {
        $openid = Yii::app()->session['openid'];
        if( $game_info = Game::model()->findByPk($game_id) ) {
            $comment_info = array();
            if($user_info = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid))) {
                $comment_info = Comment::model()->find('user_id=:t_user_id and game_id=:t_game_id',array(
                    ':t_user_id'=>$user_info['user_id'], ':t_game_id'=>$game_id)
                );
            }
            $game_info = CJSON::encode($game_info);
            $comment_info = CJSON::encode($comment_info);
            $this->render('editComment', array('game_info'=>$game_info, 'comment_info'=>$comment_info));
        }
    }

    //推荐游戏 的下载页面
    public function actionShareGame($id="") {
        $url = "";
        $a_url = "";
        if( $share_info = ShareGame::model()->findByPk($id) ) {
            $url = $share_info['url'];
            $a_url = $share_info['a_url'];
        }
        if(! empty($url)) {
            $this->render( 'shareGame', array('url'=>$url, 'a_url'=>$a_url) );
        }
    }

    //抽奖页面
    public function actionLuckyGift() {
        $openid = Yii::app()->session['openid'];
        $gift_list = array();
        $user_gift = "";
        $time = "";
        if($user_atention = AttentionUser::model()->find("openid =:t_openid", array(":t_openid"=>$openid))){
            if($user_atention['is_first']=="yes") {
                $gift_info = LuckyGift::model()->findAll(array(
                    'select' => array('id','count')
                ));
                foreach ($gift_info as $row) {
                    $gift_list[$row['id']] = $row['count'];
                }
            }
            else {
                $user_gift = $user_atention['luck_item'];
                $time = $user_atention['create_time'];
            }
        }
        $gift_list = CJSON::encode($gift_list);
        $this->render( 'lucky_gift', array('gift_list'=>$gift_list, 'user_gift'=>$user_gift, 'time'=>$time) );
        // echo $user_gift;
    }

    public function actionError() {
        header('Location: https://localhost');
    }

    // public function actionTest() {
    //     Weixin::sendMsgToUser("oIzS4wXF63E0y3tBeEQjTIzIiIGc");
    // }
}