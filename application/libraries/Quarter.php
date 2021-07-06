<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quarter{
    public static function get_quarter(){
         // Capture current month
         $get_month = (int)date("m"); 
         // Hardcode quarter definitions
         $first_quarter = array(7,8,9);
         $second_quarter = array(10,11,12);
         $third_quarter = array(1,2,3);     
           
         if(in_array($get_month, $first_quarter)) {
             $quarter = 1;
         }
         elseif (in_array($get_month, $second_quarter)) {
             $quarter = 2;
         }
         elseif (in_array($get_month, $third_quarter)) {
             $quarter = 3;
         }else{
             $quarter = 4; 
         }
         return $quarter; 
    }
}