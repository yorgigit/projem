<?php

class Curl
{
    public static function get_headers($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
       	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
       	curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return $info;
    }
    
    public static function get_content($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
       	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        $info = curl_getinfo($ch);
        if (404 === $info['http_code']) {
            throw new Curl_Exception('uzak içerik bulunamadı!');
            //return null;
        }
        curl_close($ch);
        return $data;
    }
    
    public static function get_content_protected($url,$username,$password)
    {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://cdn.comu.edu.tr/cms/tema/ortak/json/noreply/no.reply");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$data = curl_exec($ch);
		$info = curl_getinfo($ch);
        if (404 === $info['http_code']) {
           throw new Curl_Exception('uzak içerik bulunamadı!');
        }
		curl_close($ch);
        return $data;
    }
}

class Curl_Exception extends Exception {}