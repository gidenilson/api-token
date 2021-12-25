<?php

namespace APIToken;

class Token {

    private static $letters = "abcdedfgijklmnopqrstuvxwyz";
    public static function generate($id = '', $length = 4){
        $ip = $_SERVER['SERVER_ADDR'];
        $seed = '';
        for($i = 0; $i<$length; $i++){
            $seed .= substr(self::$letters, random_int(0, strlen(self::$letters)), 1);
        }
        $seed .= (string) random_int(1, 100 * $length);
        
        $token = json_encode(['ip'=>$ip, 'seed' => $seed, 'id'=>$id]);
        $token = base64_encode($token);
        
        return $token;
    }

    public static function verify($token, $id = ''){
        $token = base64_decode($token);
        $token = json_decode($token, true);

        return $token['ip'] == $_SERVER['SERVER_ADDR'] && $token['id'] == $id;
    }
}