<?php

class FranchiseHelper
{
    
  public static function getMsisdnInfo($msisdn)
  {
    if (empty($msisdn)) return null;

    $telco_name = '';
    $sim_info = null;
    $rc = self::getFranchiseRC();
    $candidates = array();
    foreach($rc as $key => $entry) {
      if (preg_match("/" . $entry['RANGE'] . "/s", $msisdn)) {
        $entry['weight'] = 0;
        if (preg_match("/" . $telco_name . "/si", $entry['NETWORK'])) $entry['weight'] += 1;
        $candidates[] = $entry;
      }
    }
    usort($candidates, array('self', 'sort_by_weight'));
    if (count($candidates)) $sim_info = $candidates[0];

    return $sim_info;
  }


  private static function getFranchiseRc()
  {
    if(Yii::app()->params['enableFBCache']){
        //Unique APC Key
        if(Yii::app()->cache->get('frachise_rules_rc')){
            $global_telco_franchise_file = Yii::app()->cache->get('frachise_rules_rc');
        }else{
            $global_telco_franchise_file =  dirname(__FILE__) . "/../config/franchise.rc";
            Yii::app()->cache->set('frachise_rules_rc', $global_telco_franchise_file, Yii::app()->getSession()->getTimeout());
        }
    }else{
        $global_telco_franchise_file =  dirname(__FILE__) . "/../config/franchise.rc";
    }
                
    
    $franchise_rc = array();
    $handle = fopen($global_telco_franchise_file, 'r');
    if ($handle) {
      $current_key = "";
      while (!feof($handle)) {
        $buffer = trim(fgets($handle, 4096));
        if (substr($buffer, 0, 1) == '#' || $buffer == "") continue;
        if (preg_match("/^\<(.*)\>$/", $buffer, $matches)) {
          if (preg_match("/TELCOFRANCHISE/si", $matches[1])) continue;
          if (substr($matches[1], 0, 1) == '/') $current_key = "";
          else $current_key = $matches[1];
          if ($current_key != "" && !isset($FRANCHISE_RC[$current_key])) $FRANCHISE_RC[$current_key] = array();
        }
        else {
          $key = "";
          $value = "";
          if (preg_match("/(.*)=(.*)$/", $buffer, $matches)) {
            $key = trim($matches[1]);
            $value = trim($matches[2]);
          } else {
            $key = trim($matches[1]);
          }
          if ($current_key != "") {
            $franchise_rc[$current_key][$key] = $value;
          } else {
            $franchise_rc[$key] = $value;
          }
        }
      }
      fclose($handle);
    }
  
    return $franchise_rc;
  }
  
  private static function sort_by_weight($a, $b)
  {
    if ($a['weight'] == $b['weight']) return 0;
    return ($a['weight'] > $b['weight']) ? -1 : 1;
  }
}