<?php

class Model_Popup extends Model
{
    public function getPopup($dil) {
        
        $sonuc =  DB::select()
                    ->from('acilis_ekran')
                    ->where('basla_zaman', '<=', date("Y-m-d H:i:s"))
                    ->where('bitis_zaman', '>', date("Y-m-d H:i:s"))
					->where('dili', '=', $dil)
                    ->limit(1)
                    ->as_object()
                    ->execute();
                    
        return $sonuc[0];
    }

  public function getPopupGenel($dil) {
            $donen = NULL;
            $url = ORTAK.'/json/popup/'.strtolower($dil);
            
            $popup_head = Curl::get_headers($url);
			  
			if($popup_head['http_code']<>200) {
                return $donen;
			}
			  
           try {
                      $popup_bilgi = Curl::get_content($url);
                      $popup_bilgi = json_decode($popup_bilgi, true);
                      $donen = (object)$popup_bilgi;
            } catch(Curl_Exception $e) {
                    $donen = null;
            }
             
            return $donen;
    }
    
}