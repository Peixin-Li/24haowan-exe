<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $openid
 * @property string $name
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 * @property string $unionid
 * @property string $create_time
 * @property string $last_update_time
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property string $enable
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openid, name, sex, create_time', 'required'),
			array('openid, name', 'length', 'max'=>300),
			array('sex', 'length', 'max'=>1),
			array('province, city, country', 'length', 'max'=>50),
			array('headimgurl', 'length', 'max'=>500),
			array('unionid', 'length', 'max'=>100),
			array('last_login_ip', 'length', 'max'=>20),
			array('enable', 'length', 'max'=>3),
			array('last_update_time,last_login_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, openid, name, sex, province, city, country, headimgurl, unionid, create_time,last_update_time, last_login_time, last_login_ip, enable', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'openid' => 'Openid',
			'name' => 'Name',
			'sex' => 'Sex',
			'province' => 'Province',
			'city' => 'City',
			'country' => 'Country',
			'headimgurl' => 'Headimgurl',
			'unionid' => 'Unionid',
			'create_time' => 'Create Time',
			'last_update_time' => 'Last Update Time',
			'last_login_time' => 'Last Login Time',
			'last_login_ip' => 'Last Login Ip',
			'enable' => 'Enable',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('unionid',$this->unionid,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('last_update_time',$this->last_update_time,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('enable',$this->enable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//获取用户信息，本地数据库会存储用户信息
	public static function getLocalUserInfo($code) {
		$web_access_token_arr = Weixin::getWebAccessToken($code);      //获取网页授权access_token
		if(!empty($web_access_token_arr['openid']) ) {
			$openid = $web_access_token_arr['openid'];
            $web_access_token = $web_access_token_arr['access_token'];

            $local_user_info = User::model()->find('openid=:this_openid',array(':this_openid'=>$openid));
            $last_update_time = strtotime($local_user_info['last_update_time']);
            $expire_time = $last_update_time + 3600 * 6 ;
            if(empty($local_user_info['openid']) || ($expire_time < time()) ) {       //当前用户信息6小时个更新一次
                if($weixin_user_info = Weixin::getUserInfo($web_access_token, $openid)) {
                	if(empty($local_user_info)) {               //如果不存在改用户，则创建一条记录
                		$local_user_info = new User;
                		$local_user_info['create_time'] = date('Y-m-d H:i:s');
                		$local_user_info['openid'] = $openid;
                	}
                	$local_user_info['name'] = $weixin_user_info['nickname'];
                	$local_user_info['sex'] = $weixin_user_info['sex'];
                	$local_user_info['province'] = $weixin_user_info['province'];
                	$local_user_info['city'] = $weixin_user_info['city'];
                	$local_user_info['country'] = $weixin_user_info['country'];
                	// $local_user_info['headimgurl'] = $weixin_user_info['headimgurl'];
                	$local_user_info['last_update_time'] = date('Y-m-d H:i:s');
                }
            }
			$local_user_info['last_login_time'] = date('Y-m-d H:i:s');
			$local_user_info['last_login_ip'] = $_SERVER["REMOTE_ADDR"];
			$local_user_info->save();
			return $local_user_info;
        }
        else
        	return false;

	}
}
