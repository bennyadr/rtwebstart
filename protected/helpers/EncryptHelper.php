<?php

class EncryptHelper
{
    public static function encrypting($password){
        return sha1(Yii::app()->params['salt'].$password);		
    }
}