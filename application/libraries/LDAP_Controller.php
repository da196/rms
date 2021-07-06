<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class LDAP_Controller{

    public static function ldap_connection($username, $password){
     
        $username_only =  str_replace("@tcra.go.tz","",$username); 
        $domain_name = "tcra.go.tz";
        $username_only = $username_only."@".$domain_name;

        $ldap_con = ldap_connect($domain_name);    
            if (@ldap_bind($ldap_con,$username_only, $password)) {
                return true;
            } else {
                return false;
            }
        
    }


}



