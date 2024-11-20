
<?php

class Env{

    public static function getEnv($key){
        $env = file_get_contents(INCLUDE_PATH.'.env');
        $env = explode("\n", $env);
        $env = array_filter($env);
        $env = array_map('trim', $env);
        $env = array_map(function($item){
            return explode("=", $item);
        }, $env);
        $newArray = [];
        foreach($env as $item){
            $newArray[$item[0]] = $item[1];
        }
        return $newArray[$key];
    }
    
}


?>