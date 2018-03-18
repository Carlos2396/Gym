<?php
    abstract class Helper {
    	public static function baseurl() {
            return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/Gym/";
        }
    }
?>

