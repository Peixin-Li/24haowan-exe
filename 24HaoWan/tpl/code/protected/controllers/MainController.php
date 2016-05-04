<?php

class MainController extends Controller
{
    public $layout = false;
    public function actionIndex() {   //接收微信的消息推送
        $signPackage = Credential::getSignPackage();
        $this->render('game1', array('signPackage'=>$signPackage));
    }
}