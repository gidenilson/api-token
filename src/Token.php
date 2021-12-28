<?php

namespace APIToken;

class Token {

    private static $letters = "abcdedfgijklmnopqrstuvxwyz";
    public static function generate($id = '', $length = 4){
        
        if(isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }else{
            $ip = '';
        }
        
        $seed = '';
        for($i = 0; $i<$length; $i++){
            $seed .= substr(self::$letters, random_int(0, strlen(self::$letters)), 1);
        }
        $seed .= (string) random_int(1, 100 * $length);
        
        $token = json_encode(['ip'=>$ip, 'seed' => $seed, 'id'=>$id]);
        $token = base64_encode($token);
        
        return $token;
    }

    public static function verify($token){
        $token = base64_decode($token);
        $token = json_decode($token, true);
        if(isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }else{
            $ip = '';
        }
        if(!is_array($token)){
            return false;
        }
        return $token['ip'] == $ip;
    }
    public static function getId($token){
        $token = base64_decode($token);
        $token = json_decode($token, true);
        if(isset($token['id'])){
            return $token['id'];
        }else{
            return false;
        }
        
    }
}