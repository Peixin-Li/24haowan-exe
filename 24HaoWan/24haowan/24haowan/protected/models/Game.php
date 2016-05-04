<?php

/**
 * This is the model class for table "game".
 *
 * The followings are the available columns in table 'game':
 * @property integer $game_id
 * @property string $game_name
 * @property string $star
 * @property integer $quantity
 * @property string $gametype
 * @property string $description
 * @property integer $comment_times
 * @property integer $subject_id
 * @property string $img
 * @property string $share_img
 * @property string $game_url
 * @property string $create_time
 * @property string $start_time
 */
class Game extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'game';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_name, img, game_url', 'required'),
			array('quantity, comment_times, subject_id', 'numerical', 'integerOnly'=>true),
			array('game_name, gametype', 'length', 'max'=>50),
			array('star', 'length', 'max'=>20),
			array('description', 'length', 'max'=>500),
			array('img, share_img, game_url', 'length', 'max'=>200),
			array('create_time, start_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('game_id, game_name, star, quantity, gametype, description, comment_times, subject_id, img, share_img, game_url, create_time, start_time', 'safe', 'on'=>'search'),
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
			'game_id' => 'Game',
			'game_name' => 'Game Name',
			'star' => 'Star',
			'quantity' => 'Quantity',
			'gametype' => 'Gametype',
			'description' => 'Description',
			'comment_times' => 'Comment Times',
			'subject_id' => 'Subject',
			'img' => 'Img',
			'share_img' => 'Share Img',
			'game_url' => 'Game Url',
			'create_time' => 'Create Time',
			'start_time' => 'Start Time',
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

		$criteria->compare('game_id',$this->game_id);
		$criteria->compare('game_name',$this->game_name,true);
		$criteria->compare('star',$this->star,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('gametype',$this->gametype,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('comment_times',$this->comment_times);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('share_img',$this->share_img,true);
		$criteria->compare('game_url',$this->game_url,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('start_time',$this->start_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Game the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
