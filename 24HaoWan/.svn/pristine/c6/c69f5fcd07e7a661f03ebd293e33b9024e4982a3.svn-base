<?php

/**
 * This is the model class for table "credential".
 *
 * The followings are the available columns in table 'credential':
 * @property integer $id
 * @property string $value
 * @property string $type
 * @property integer $update_time
 * @property integer $expires_time
 */
class Credential extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'credential';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, type, update_time, expires_time', 'required'),
			array('update_time, expires_time', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>1000),
			array('type', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value, type, update_time, expires_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'type' => 'Type',
			'update_time' => 'Update Time',
			'expires_time' => 'Expires Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('expires_time',$this->expires_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Credential the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//创建随机的字符串
	private function  createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $str = "";
	    for ($i = 0; $i < $length; $i++) {
	      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	    }
	    return $str;
	}

	//http Get请求
	private function httpGet($url) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    $res = curl_exec($curl);
	    curl_close($curl);
	    return $res;
  	}

	//获取  SignPackage 信息
	public static function getSignPackage() {
		$jsapiTicket = self::getJsApiTicket();

		// 注意 URL 一定要动态获取，不能 hardcode.
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	    $timestamp = time();
	    $nonceStr = self::createNonceStr();

	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	    $signature = sha1($string);
	    $signPackage = array(
			"appId"     => Yii::app()->params['appid'],
			"nonceStr"  => $nonceStr,
			"timestamp" => $timestamp,
			"url"       => $url,
			"signature" => $signature,
			"rawString" => $string
	    );
	    return $signPackage; 
	}

	//获取 JsApiTicket
	public static function getJsApiTicket() {
		$ticket_info = self::model()->find('type=:this_type', array(':this_type'=>'jsapi_ticket'));
		if(empty($ticket_info['value']) || $ticket_info['expires_time'] < time()){
			$accessToken = self::getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
			$res = CJSON::decode(self::httpGet($url), true);
			if(empty($ticket_info)) {                      //如果不存在，则创建一个记录
				$ticket_info = new Credential;
			}
			if(empty($res['errcode'])) { 			//如果返回信息不含错误信息，就保存数据
				$ticket_info['value'] = $res['ticket'];
				$ticket_info['type'] = "jsapi_ticket";
				$ticket_info['update_time'] = time();
				$ticket_info['expires_time'] = time() + (int)$res['expires_in'];
				$ticket_info->save();
			}
		}
		return $ticket_info['value'];
	}

	public static function getAccessToken() {
		$token_info = self::model()->find('type=:this_type', array(':this_type'=>'access_token'));
		if(empty($token_info['value']) || $token_info['expires_time'] < time()){
			$appid = Yii::app()->params['appid'];
        	$appsecret = Yii::app()->params['appsecret'];
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$res = CJSON::decode(self::httpGet($url), true);
			if(empty($token_info)) {
				$token_info = new Credential;
			}
			if(empty($res['errcode'])) {       //如果返回信息不含错误信息，就保存数据
				$token_info['value'] = $res['access_token'];
				$token_info['type'] = "access_token";
				$token_info['update_time'] = time();
				$token_info['expires_time'] = time() + (int)$res['expires_in'];
				$token_info->save();
			}
		}
		return $token_info['value'];
	}
}
