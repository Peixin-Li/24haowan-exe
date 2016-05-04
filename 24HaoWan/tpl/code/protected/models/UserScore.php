<?php

/**
 * This is the model class for table "user_score".
 *
 * The followings are the available columns in table 'user_score':
 * @property integer $id
 * @property integer $user_id
 * @property integer $game_id
 * @property integer $last_score
 * @property integer $score
 * @property integer $badge
 * @property integer $game_time
 * @property string $create_time
 * @property string $update_time
 * @property integer $stage
 */
class UserScore extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_score';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, game_id', 'required'),
			array('user_id, game_id, last_score, score, badge, game_time, stage, role_id', 'numerical', 'integerOnly'=>true),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, game_id, last_score, score, badge, game_time, create_time, update_time, stage, role_id', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'game_id' => 'Game',
			'last_score' => 'Last Score',
			'score' => 'Score',
			'badge' => 'Badge',
			'game_time' => 'Game Time',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'stage' => 'Stage',
			'role_id' => 'Role Id',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('game_id',$this->game_id);
		$criteria->compare('last_score',$this->last_score);
		$criteria->compare('score',$this->score);
		$criteria->compare('badge',$this->badge);
		$criteria->compare('game_time',$this->game_time);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('stage',$this->stage);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserScore the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getScoreSort($game_id="", $score=0, $user_id="") {
		$all_user_count = self::model()->count("game_id=:t_game_id", array(':t_game_id'=>$game_id));

		if($user_score = self::model()->find('game_id=:t_game_id and user_id=:t_user_id', array(':t_game_id'=>$game_id, ':t_user_id'=>$user_id))) {
			$low_user_count = self::model()->count("game_id=:t_game_id and (score<:t_score or (score=:t_score and id >:t_id) )",
				array(':t_game_id'=>$game_id, ':t_score'=>$score , ':t_id'=>$user_score['id']));
		}
		else {
			$low_user_count = self::model()->count("game_id=:t_game_id and score<:t_score",
				array(':t_game_id'=>$game_id, ':t_score'=>$score));
		}
		$all_user_count_int = (int)$all_user_count;
		$low_user_count_int = (int)$low_user_count;
		$result = array();
		if( empty($all_user_count_int) ) {
			$result['rank'] = 0;
			$result['persent'] = 0;
		}
		else {
			$result['rank'] = $all_user_count_int - $low_user_count_int;
			$result['persent'] = (int)( ($low_user_count_int)/$all_user_count_int * 100);
		}
		return $result;
	}

	public static function getAllPlayerCount($game_id="") {
		if(!empty($game_id)) {
			return self::model()->count("game_id=:t_game_id", array(':t_game_id'=>$game_id));
		}
		else {
			return 0;
		}
	}
}
