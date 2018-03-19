<?php
    abstract class Helper {

        // base URL of the project
    	public static function baseurl() {
            return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/Gym/";
        }
    }
?>

