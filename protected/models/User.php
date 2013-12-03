<?php

/**
 * This is the model class for table "rtw_user".
 *
 * The followings are the available columns in table 'rtw_user':
 * @property string $uid
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthdate
 * @property string $gender
 * @property string $email
 * @property string $username
 * @property string $mobile_prefix
 * @property string $mobile_number
 * @property string $mobile_franchise
 * @property string $mobile_account
 * @property string $verification_code
 * @property integer $is_verify
 * @property string $invitation_code
 * @property integer $is_login
 * @property string $last_login_time
 * @property integer $acc_status
 * @property string $createdate
 *
 * The followings are the available model relations:
 * @property Userattributes[] $userattributes
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rtw_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, birthdate, gender, email, createdate', 'required'),
			array('is_verify, is_login, acc_status', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, middle_name, email', 'length', 'max'=>50),
			array('gender, verification_code, invitation_code', 'length', 'max'=>10),
			array('username, mobile_franchise', 'length', 'max'=>20),
			array('mobile_prefix', 'length', 'max'=>4),
			array('mobile_number', 'length', 'max'=>7),
			array('mobile_account, last_login_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, first_name, last_name, middle_name, birthdate, gender, email, username, mobile_prefix, mobile_number, mobile_franchise, mobile_account, verification_code, is_verify, invitation_code, is_login, last_login_time, acc_status, createdate', 'safe', 'on'=>'search'),
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
			'userattributes' => array(self::HAS_MANY, 'Userattributes', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'middle_name' => 'Middle Name',
			'birthdate' => 'Birthdate',
			'gender' => 'Gender',
			'email' => 'Email',
			'username' => 'Username',
			'mobile_prefix' => 'Mobile Prefix',
			'mobile_number' => 'Mobile Number',
			'mobile_franchise' => 'Mobile Franchise',
			'mobile_account' => 'Mobile Account',
			'verification_code' => 'Verification Code',
			'is_verify' => 'Is Verify',
			'invitation_code' => 'Invitation Code',
			'is_login' => 'Is Login',
			'last_login_time' => 'Last Login Time',
			'acc_status' => 'Acc Status',
			'createdate' => 'Createdate',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('mobile_prefix',$this->mobile_prefix,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('mobile_franchise',$this->mobile_franchise,true);
		$criteria->compare('mobile_account',$this->mobile_account,true);
		$criteria->compare('verification_code',$this->verification_code,true);
		$criteria->compare('is_verify',$this->is_verify);
		$criteria->compare('invitation_code',$this->invitation_code,true);
		$criteria->compare('is_login',$this->is_login);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('acc_status',$this->acc_status);
		$criteria->compare('createdate',$this->createdate,true);

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
        
        /**
        * Returns User model by its email
        * 
        * @param string $email 
        * @access public
        * @return User
        */
       public function findByEmail($email)
       {
         return self::model()->findByAttributes(array('email' => $email));
       }
}
