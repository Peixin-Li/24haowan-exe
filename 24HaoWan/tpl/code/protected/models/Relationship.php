<?php

/**
 * This is the model class for table "relationship".
 *
 * The followings are the available columns in table 'relationship':
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $create_time
 */
class Relationship extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Relationship the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'relationship';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_user_id, to_user_id', 'required'),
			array('from_user_id, to_user_id', 'numerical', 'integerOnly'=>true),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('from_user_id, to_user_id, create_time', 'safe', 'on'=>'search'),
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
			'from_user_id' => 'From User',
			'to_user_id' => 'To User',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//新建用户关系函数
	public static function createRelation($from_user_id, $to_user_id)   //保存用户关系
	{
		if( (!empty($from_user_id)) &&(!empty($to_user_id)) ) {
			if(!$relationship_info = Relationship::model()->findByPk(array('from_user_id'=>$from_user_id, 'to_user_id'=>$to_user_id))) {
                $relationship_info = new Relationship;
                $relationship_info['from_user_id'] = $from_user_id;
                $relationship_info['to_user_id'] = $to_user_id;
                $relationship_info['create_time'] = date("Y-m-d H:i:s");
                $relationship_info->save();
            }
        }
	}
}