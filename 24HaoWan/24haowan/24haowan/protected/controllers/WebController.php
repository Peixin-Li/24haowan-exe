<?php

class WebController extends Controller
{
    public $layout = false;

    //官网首页
    public function actionIndex() {
        $this->render('pc/index');
    }

    //案例
    public function actionCase() {
        $this->render('pc/case');
    }

    //联系我们
    public function actionContact() {
        $this->render('pc/contact');
    }

    public function actionCustom() {
        $this->render('pc/custom');
    }

    public function actionGame($game_id="") {
        $this->layout = 'game_none';
        $this->render('/game/game'.$game_id);
    }
}