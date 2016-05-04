<?php

class AjaxController extends Controller
{
    public $layout = false;
    public function filters()
    {
        return array('verify');
    }

    //定义的过滤方法
    public function FilterVerify($filterChain)
    {
        if( empty(Yii::app()->session['openid']) )    //如果用户未登录，则进行微信认证
        {   
            $response = array('code'=>99, 'msg'=>'no auth');
            echo CJSON::encode($response);
        }
        else if(!Yii::app()->request->isAjaxRequest){
            $response = array('code'=>100, 'msg'=>'not ajax');
            echo CJSON::encode($response);
        }
        else
            $filterChain->run();
    }

    //玩家提交分数 ajax接口
	public function actionCommitScore() {
        $openid = Yii::app()->session['openid'];
        $score = empty($_POST['game_score'])? "" : (int)$_POST['game_score'];
        $stage = empty($_POST['stage'])? "" : (int)$_POST['stage'];
        $device_type = empty($_POST['device_type'])? "" :  htmlspecialchars($_POST['device_type']);
        $time = 1;
        $game_id = empty($_POST['game_id'])? "" : (int)$_POST['game_id'];
        $badge = empty($_POST['badge'])? "" : (int)$_POST['badge'];
        $role_id = empty($_POST['role_id'])? "" : (int)$_POST['role_id'];
        $is_new_recode = 0;
        $response = array('code'=>-1, 'msg'=>'save failed', 'data'=>array());

        if(empty($openid)||empty($time)||empty($game_id)) {
            $response['code'] = -3;
            $response['msg'] = 'params error'.$openid.'-'.$score.'-'.$time.'-'.$game_id;
        }
        elseif (!$user_info = User::model()->find('openid=:t_penid and enable=:t_enable', array(':t_penid'=>$openid, ':t_enable'=>'yes')) ) {
            $response['code'] = -4;
            $response['msg'] = 'can not find this user';
        }
        elseif(!$game_info = Game::model()->find('game_id=:t_game_id', array(':t_game_id'=>$game_id)) ) {
            $response['code'] = -5;
            $response['msg'] = 'can not find this game' . $game_id;
        }
        else{
            $user_score_info = UserScore::model()->find('user_id=:t_user_id and game_id=:t_game_id',
                array('t_user_id'=>$user_info['user_id'], ':t_game_id'=>$game_id));
            //如果记录不存在，则创建一条新的记录
            if(empty($user_score_info)) {
                $user_score_info = new UserScore;
                $user_score_info['create_time'] = date('Y-m-d H:i:s');
                $user_score_info['user_id'] = $user_info['user_id'];
                $user_score_info['game_id'] = $game_id;
                $user_score_info['score'] = 0;
                $user_score_info['game_time'] = 0;
                if($subject_info = Subject::model()->findByPk($game_info['subject_id'])) {
                    $subject_info['quantity'] = (int)$subject_info['quantity'] + 1;
                    $subject_info->save();
                }
                $game_info['quantity'] = (int)$game_info['quantity'] + 1;
                $game_info->save();
            }
            if( (!(empty($device_type)) ) && empty($user_score_info['device_type']) ) {  //提交的设备信息不为空，并且之前没有记录设备信息
                $user_score_info['device_type'] = $device_type;
            }
            if( (int)$user_score_info['score'] < $score) {
                $user_score_info['score'] = (int)$score;
                $user_score_info['badge'] = (int)$badge;
                $is_new_recode = 1;
            }
            $user_score_info['role_id'] = (int)$role_id;
            $user_score_info['last_score'] = (int)$score;
            $user_score_info['stage'] = (int)$stage;
            $user_score_info['game_time'] = (int)$user_score_info['game_time'] + $time;
            $user_score_info['update_time'] = date('Y-m-d H:i:s');
            $user_score_info->save();
            $rank_result = UserScore::getScoreSort($game_id, $score);
            if(empty($score)) {
                $rank_result['persent'] = 0;
            }
            $response['code'] = 0;
            $response['msg'] = 'ok';
            $response['data'] = array(
                'rank'=>$rank_result['rank'], 'persent'=>$rank_result['persent'],
                'is_new_recode'=>$is_new_recode, 'badge'=>$badge
            );
        }
        echo CJSON::encode($response);
	}

    //记录玩家分享的信息
    public function actionCommitShare() {
        $openid = Yii::app()->session['openid'];
        $share_type = empty($_POST['type'])? "" :  htmlspecialchars($_POST['type']);
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

    //提交用户评论
    public function actionSendComment() {
        $openid = Yii::app()->session['openid'];
        $comment = empty($_POST['comment'])? "" :  htmlspecialchars($_POST['comment']);
        $star = empty($_POST['star'])? "" :  htmlspecialchars($_POST['star']);
        $game_id = empty($_POST['game_id'])? "" : (int)$_POST['game_id'];
        // $comment = "游戏1测试";
        // $star = "★★";
        // $game_id = 1;
        $response = array('code'=>-1, 'msg'=>'failed');

        if(!$user_info = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid))) {
            $response['code'] = -2;
            $response['msg'] = 'user not found';
        }
        else if(empty($star)) {
            $response['code'] = -3;
            $response['msg'] = 'params empty';
        }
        else if($game_info = Game::model()->findBypk($game_id) ) {
            $comment_info = Comment::model()->find('user_id=:t_user_id and game_id=:t_game_id',
                array(':t_user_id'=>$user_info['user_id'], ':t_game_id'=>$game_info['game_id'])
            );
            if(empty($comment_info)) {
                $comment_info = new Comment;
                $comment_info['user_id'] = $user_info['user_id'];
                $comment_info['game_id'] = $game_id;
                $comment_info['star'] = $star;
                $comment_info['create_time'] = date("Y-m-d H:i:s");
                $game_info['comment_times'] = (int)$game_info['comment_times'] + 1;    //游戏的评论人数加1
            }
            $comment_info['comment'] = $comment;
            $comment_info['update_time'] = date("Y-m-d H:i:s");

            $game_info->save();

            if($comment_info->save()) {
                $response['code'] = 0;
                $response['msg'] = 'ok';
            }
        }
        echo CJSON::encode($response);
    }

    //获取游戏排名
    public function actionGetRank(){
        $openid = Yii::app()->session['openid'];
        // $openid = 'o_68bwKF8hGEf-pzV5cNA5ya-PDw';
        $game_id = empty($_POST['game_id'])? 1 : (int)$_POST['game_id'];

        // $game_id = 1;
        $response = array('code'=>-1, 'msg'=>'failed', 'data'=>array());
        if(!$game_info = Game::model()->findBypk($game_id)) {
            $response['code'] = -3;
            $response['msg'] = 'cant not find game';
        }
        else {
            $rank_result = array();
            $total_count = UserScore::getAllPlayerCount($game_id);

            //查找当前游戏的前10名
            $score_list = UserScore::model()->findAll(array(
                'select' => array('user_id', 'game_id', 'score'),
                'condition' => 'game_id=:t_game_id',
                'params' => array(':t_game_id' =>$game_id),
                'order' => 'score DESC, id ASC',
                'limit' => 10
            ));
            foreach ($score_list as $key => $value) {
                if($user_info = User::model()->findBypk($value['user_id'])) {
                    $rank_result[] = array(
                        'name'=>$user_info['name'], 'headimgurl'=>$user_info['headimgurl'],
                        'score' => $value['score']
                    );
                }
            }

            //获取当前用户排名情况
            $current_user_result = array();
            if( $current_user = User::model()->find('openid=:t_openid', array(':t_openid'=>$openid)) ) {
                $current_user_score = UserScore::model()->find(array(
                    'select' => array('score'),
                    'condition' => 'game_id =:t_game_id and user_id=:t_user_id',
                    'params' => array(':t_game_id'=>$game_id, ':t_user_id'=>$current_user['user_id'])
                ));
                if(!empty($current_user_score)) { 
                    $current_user_rank = UserScore::getScoreSort($game_id, $current_user_score['score'], $current_user['user_id']);
                    $current_user_result = array(
                        'name' => $current_user['name'] , 'headimgurl'=>$current_user['headimgurl'],
                        'score' => $current_user_score['score'], 'rank' => $current_user_rank['rank'],
                        'persent' => $current_user_rank['persent'],
                    );
                }
            }
            $response['code'] = 0;
            $response['msg'] = 'ok';
            $response['data'] = array('rank_list'=>$rank_result, 'user_result'=>$current_user_result, 'total_count'=>$total_count);
        }
        echo CJSON::encode($response);
    }
}