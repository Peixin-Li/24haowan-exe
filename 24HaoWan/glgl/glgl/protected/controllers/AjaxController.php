<?php

class AjaxController extends Controller
{
    public $layout = false;

    // public function filters()
    // {
    //     //过滤只用于actionEdit和actionCreate方法
    //     return array( 'verify');
    // }
    // public function FilterVerify() {
    //     if ( Yii::app()->request->isAjaxRequest ) {
    //         $filterChain->run();
    //     }
    //     else {
    //         echo "此页面不存在";
    //     }
    // }

    //玩家提交分数 ajax接口
	public function actionCommitScore() {
        $n_ip = empty($_POST['n_ip'])? "" : $_POST['n_ip'];
        $score = empty($_POST['game_score'])? "" : (int)$_POST['game_score'];
        $time = empty($_POST['game_time'])? "" : (int)$_POST['game_time'];
        // $n_ip = '192.168.0.223';
        // $score = 342;
        // $time = 231;
        $w_ip = $_SERVER["REMOTE_ADDR"];
        $game_id = 1;
        $response = array('code'=>-1, 'msg'=>'save failed');

        if( empty($n_ip) ) {
            $response['code'] = -3;
            $response['msg'] = 'params error'.$n_ip;
        }
        else{
            $ip_score_info = IpScore::model()->find('n_ip=:t_n_ip and n_ip=:t_n_ip',
                array('t_w_ip'=>$w_ip, ':t_n_ip'=>$n_ip));
            //如果记录不存在，则创建一条新的记录
            if(empty($ip_score_info)) {
                $ip_score_info = new IpScore;
                $ip_score_info['create_time'] = date('Y-m-d H:i:s');
                $ip_score_info['n_ip'] = $n_ip;
                $ip_score_info['w_ip'] = $w_ip;
                $ip_score_info['score'] = 0;
                $ip_score_info['game_time'] = 0;
            }
            if( (int)$ip_score_info['score'] < $score) {
                $ip_score_info['score'] = (int)$score;
            }
            $ip_score_info['game_time'] = (int)$ip_score_info['game_time'] + $time;
            $ip_score_info['update_time'] = date('Y-m-d H:i:s');
            $ip_score_info->save();
            $response['code'] = 0;
            $response['msg'] = 'ok';
        }
        echo CJSON::encode($response);
	}

    //记录玩家分享的信息
    public function actionCommitShare() {
        $openid = empty($_POST['openid'])? "" : $_POST['openid'];
        $share_type = empty($_POST['type'])? "" : $_POST['type'];
        // $openid = empty($_GET['openid'])? "" : $_GET['openid'];
        // $share_type = empty($_GET['type'])? "" : $_GET['type'];
        // $openid = "oGbVCt5G-InN4gnpYP8QyC2lnCUc";
        // $share_type = "friend";
        $game_id = 1;
        $allow_share_type = array('friend', 'cfriend');
        $response = array('code'=>-1, 'msg'=>'save failed');

        if(!in_array($share_type, $allow_share_type)) {
            $response['code'] = -2;
            $response['msg'] = 'share type error-'.$share_type;
        }
        elseif ( empty($openid) ) {
            $response['code'] = -3;
            $response['msg'] = 'params error'.$openid.'-'.$share_type;
        }
        elseif (!$user_info = User::model()->find('openid=:t_penid and enable=:t_enable', array(':t_penid'=>$openid, ':t_enable'=>'yes')) ) {
            $response['code'] = -4;
            $response['msg'] = 'can not find this user';
        }
        elseif(!$game_info = Game::model()->find('game_id=:t_game_id', array(':t_game_id'=>$game_id)) ) {
            $response['code'] = -5;
            $response['msg'] = 'can not find this game' . $game_id;
        }
        else {
            $game_share_info = GameShare::model()->find('user_id=:t_user_id and game_id=:t_game_id and share_type=:t_share_type', 
                array(':t_user_id'=>$user_info['user_id'], ':t_game_id'=>$game_id, ':t_share_type'=>$share_type ));
            if (empty($game_share_info)) {
                $game_share_info = new GameShare;
                $game_share_info['user_id'] = $user_info['user_id'];
                $game_share_info['game_id'] = $game_id;
                $game_share_info['share_type'] = $share_type;
                $game_share_info['share_times'] = 0;
                $game_share_info['create_time'] = date('Y-m-d H:i:s');
            }
            $game_share_info['share_times'] = (int)$game_share_info['share_times'] + 1;
            $game_share_info['update_time'] = date('Y-m-d H:i:s');
            $game_share_info->save();
            $response['code'] = 0;
            $response['msg'] = 'ok';
        }
        echo CJSON::encode($response);
    }
}