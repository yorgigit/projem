<?php

class My
{
    
    
     public static function AddHttp($s)
    {
       if(!preg_match('/^https?:\/\//', $s)) $s = 'http://'.$s;
       return $s;
    }
    
    public static function SEO_donusum($s)
    {
        $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','\'','"','’','“','”','‘','?','&#39;','&#34;','&quot;','!');
        $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','','','','','','','','','','','');
        $s = strtolower(str_replace($tr, $eng, $s));
        $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
        $s = preg_replace('/\s+/', '-', $s);
        $s = preg_replace("@[^A-Za-z0-9\-_]@i", '', $s);
        $s = preg_replace('|-+|', '-', $s);
        $s = preg_replace('/#/', '', $s);
        $s = str_replace('.', '', $s);
        $s = trim($s, '-');
        $s = substr($s, 0, 50);
        return $s;
    }
    
    //throw new Curl_Exception('uzak içerik bulunamadı!');
    
    public static function d($var, $son=null)
    {
        print '<pre>';
        print_r($var);
        print '</pre>';
        if($son==null) exit;
    }

    public static function strtoupperTR($str)
    {
        $str = str_replace(array('i', 'ı', 'ü', 'ğ', 'ş', 'ö', 'ç'), array('İ', 'I', 'Ü', 'Ğ', 'Ş', 'Ö', 'Ç'), $str);
        return strtoupper($str);
    }
    
    public static function strtolowerTR($str)
    {
        $str = str_replace(array('İ', 'I', 'Ü', 'Ğ', 'Ş', 'Ö', 'Ç'), array('i', 'ı', 'ü', 'ğ', 'ş', 'ö', 'ç'), $str);
        return strtolower($str);
    }


    public static function tarih_format($tarih, $tur = null)
    {
        if ($tarih <> null) {
            if ($tur == "mysql") {
                $tarih_donen = substr($tarih, 6, 4) . "-" . substr($tarih, 3, 2) . "-" . substr($tarih, 0, 2);
            }
            else if ($tur == "mysqltod") {
                $tarih_donen = substr($tarih, 8, 2) . "." . substr($tarih, 5, 2) . "." . substr($tarih,0, 4);
            }
            else if ($tur == "dttomysql") {
                $tarih_donen = substr($tarih, 6, 4) . "-" . substr($tarih, 3, 2) . "-" . substr($tarih,0, 2)." ".substr($tarih,11,5).":00";
            }
            else if ($tur == "mysqltodt") {
                $tarih_donen = substr($tarih, 8, 2) . "-" . substr($tarih, 5, 2) . "-" . substr($tarih,0, 4)." ".substr($tarih,11,5);
            }
             else {
                $tarih_donen = substr($tarih, 8, 2) . "/" . substr($tarih, 5, 2) . "/" . substr($tarih,0, 4);
            }
        }
        return $tarih_donen;
    }
    
    
    
    public static function ipno()
    {
              $ipno = '';
              if (isset($_SERVER['HTTP_CLIENT_IP'])) 			{	$ipno = $_SERVER['HTTP_CLIENT_IP']; 		}
              else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))  {   $ipno = $_SERVER['HTTP_X_FORWARDED_FOR']; 	}
              else if(isset($_SERVER['HTTP_X_FORWARDED'])) 		{   $ipno = $_SERVER['HTTP_X_FORWARDED']; 		}
              else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) 	{   $ipno = $_SERVER['HTTP_FORWARDED_FOR']; 	}
              else if(isset($_SERVER['HTTP_FORWARDED'])) 		{   $ipno = $_SERVER['HTTP_FORWARDED']; 		}
              else if(isset($_SERVER['REMOTE_ADDR'])) 			{   $ipno = $_SERVER['REMOTE_ADDR']; 			}
              else 												{   $ipno = '0.0.0.0';							}
              return $ipno;
    }
    
    public static function is_url_exist($url){
	
        $ch = curl_init($url);    
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
           $status = true;
        }else{
          $status = false;
        }
        curl_close($ch);
        return $status;
    }
	
    public static function worduret($harfsayi, $sayiuret, $harfuret)
    {
        $gidecek = null;
    	$harf = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'y', 'z', 'q', 'w', 'x');
    	$harf_b = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'Y', 'Z', 'Q', 'W', 'X');
    	$sayi = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
    
        if (($sayiuret == "1") && ($harfuret == "1")) {
            $denetim = "3";
        } elseif (($sayiuret == "1") && ($harfuret == "0")) {
            $salla = "2";
        } elseif (($sayiuret == "0") && ($harfuret == "1")) {
            $salla = "1";
        }
    
        for ($i = 0; $i < $harfsayi; $i++)
        {
            if ($denetim == "3")
            {
                $salla = rand(1, 3);
            }
    
            if ($salla == "3")
            {
                $gidecek = $gidecek . "" . $harf_b[rand(0, 25)];
            } elseif ($salla == "2")
            {
                $gidecek = $gidecek . "" . $sayi[rand(0, 9)];
            } elseif ($salla == "1")
            {
                $gidecek = $gidecek . "" . $harf[rand(0, 25)];
            }
        }
        return $gidecek;
    }
    
    public static function generateFormToken($word, $formkey = 'var_frmkey')
    {
        $rnd_word = self::worduret(10,1,1);
        $rnd_word = md5($rnd_word);
        return $rnd_word;
    }
    
    public static function generateCaptcha() {
        $imagestring = null;
        
        for($i=0;$i<5;$i++) {
            $b = rand(1,3);
            if($b==1) $char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 1));
            else if($b==2) $char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 1)); 
            else if($b==3) $char = rand(1,9); 
            
            $imagestring = $imagestring.$char;
        }
        return $imagestring;
    }
}


class My_Exception extends Exception {}