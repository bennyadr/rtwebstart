<?php

class MobileNumberHelper
{
    private static $_country_code = "63";
    private static $_mobile_prefixes = array(
        'smart' => array(
		    '0907' => '0907',
                    '0908' => '0908',
                    '0909' => '0909',
                    '0910' => '0910',
                    '0912' => '0912',
                    '0918' => '0918',
                    '0919' => '0919',
                    '0920' => '0920',
                    '0921' => '0921',
                    '0924' => '0924',
                    '0928' => '0928',
                    '0929' => '0929',
                    '0930' => '0939',
                    '0938' => '0938',
                    '0946' => '0946',
                    '0947' => '0947',
                    '0948' => '0948',
                    '0949' => '0949',
                    '0989' => '0989',
                    '0999' => '0999',
	),
        'globe' => array(
		    '0905' => '0905',
                    '0906' => '0906',
                    '0915' => '0915',
                    '0916' => '0916',
                    '0917' => '0917',
                    '0926' => '0926',
                    '0927' => '0927',
                    '0935' => '0935',
                    '0937' => '0937',
	),
        'sun' => array(
                    '0922' => '0922',
                    '0923' => '0923',
                    '0932' => '0932',
                    '0933' => '0933',
                    '0942' => '0942',
                    '0943' => '0943',
	)
    );
    
    
    private static $_mobile_prefixes_js = array(
        'smart' => array(
		    array('label' => '0907', 'network' => 'smart'),
                    array('label' => '0908', 'network' => 'smart'),
                    array('label' => '0909', 'network' => 'smart'),
                    array('label' => '0910', 'network' => 'smart'),
                    array('label' => '0912', 'network' => 'smart'),
                    array('label' => '0918', 'network' => 'smart'),
                    array('label' => '0919', 'network' => 'smart'),
                    array('label' => '0920', 'network' => 'smart'),
                    array('label' => '0921', 'network' => 'smart'),
                    array('label' => '0924', 'network' => 'smart'),
                    array('label' => '0928', 'network' => 'smart'),
                    array('label' => '0929', 'network' => 'smart'),
                    array('label' => '0930', 'network' => 'smart'),
                    array('label' => '0938', 'network' => 'smart'),
                    array('label' => '0946', 'network' => 'smart'),
                    array('label' => '0947', 'network' => 'smart'),
                    array('label' => '0948', 'network' => 'smart'),
                    array('label' => '0949', 'network' => 'smart'),
                    array('label' => '0989', 'network' => 'smart'),
                    array('label' => '0999', 'network' => 'smart'),
	),
        'globe' => array(
		    array('label' => '0905', 'network' => 'globe'),
                    array('label' => '0906', 'network' => 'globe'),
                    array('label' => '0915', 'network' => 'globe'),
                    array('label' => '0916', 'network' => 'globe'),
                    array('label' => '0917', 'network' => 'globe'),
                    array('label' => '0926', 'network' => 'globe'),
                    array('label' => '0927', 'network' => 'globe'),
                    array('label' => '0935', 'network' => 'globe'),
                    array('label' => '0937', 'network' => 'globe'),
	),
        'sun' => array(
                    array('label' => '0922', 'network' => 'sun'),
                    array('label' => '0923', 'network' => 'sun'),
                    array('label' => '0932', 'network' => 'sun'),
                    array('label' => '0933', 'network' => 'sun'),
                    array('label' => '0942', 'network' => 'sun'),
                    array('label' => '0943', 'network' => 'sun'),
	)
    );

    public static function regularToCountryCodeFormat($mobile_number){
        $mobile_number = self::$_country_code.substr($mobile_number, 1);

        return $mobile_number;
    }
  
    public static function countrycodeToRegularFormat($mobile_number){
        $mobile_number = "0".substr($mobile_number, 2);

        return $mobile_number;
    }
    
    public function isValidMobilePrefix($mobile_prefix){
        $prefix = self::getMobilePrefixesByFranchise(Yii::app()->params['franchise']);

        if(is_array($prefix)){
            foreach($prefix as $value){
                if(in_array($mobile_prefix, $value)){
                    return true;
                }
            }
            return false;
        }else{
            return false;
        }
    }
    
    public static function getMobilePrefixesByFranchise($franchise){
        $mobile_franchise = array();
        array_merge_recursive($mobile_franchise);
        if(is_array($franchise)){
            foreach ($franchise as $value) {
                $mobile_franchise[ucfirst($value)] = self::getFranchisePrefixes($value);
            }
            
        }else{
            $mobile_franchise = self::getFranchisePrefixes($franchise);
        }
        
        return $mobile_franchise;
    }
    
    public static function getFranchisePrefixes($franchise, $format = 'PHP'){
        if(in_array(strtolower($franchise), array('smart', 'globe', 'sun'))){
            if($format == 'PHP'){
                $prefixes = self::$_mobile_prefixes;
            }else{
                $prefixes = self::$_mobile_prefixes_js;
            }
            
            $mobile_prefix = $prefixes[strtolower($franchise)];
            ksort($mobile_prefix);
            
            return $mobile_prefix;
        }else{
            return FALSE;
        }
    }
    
    public static function getMobilePrefixesJSByFranchise($franchise){
        $mobile_franchise = array();
        if(is_array($franchise)){
            foreach ($franchise as $value) {
                $mobile_franchise = array_merge($mobile_franchise, self::getFranchisePrefixes($value, 'JS'));
            }
            
        }else{
            $mobile_franchise = self::getFranchisePrefixes($franchise, 'JS');
        }
        
        return $mobile_franchise;
    }
    
}
