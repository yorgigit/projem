<?php

class Model_Ayarlar extends Model
{
    public function getTumu() {
        
        return DB::select()
                    ->from('ayarlar')
                    ->as_object()
                    ->execute();
    }

  public function get($dil) {
        
        return DB::select()
                    ->from('ayarlar')
                    ->where('dili', '=', $dil)
                    ->as_object()
                    ->execute();
    }
    
    public function getYayinDurum($dil) {
        
        $sonuc =  DB::select('site_durum')
                    ->from('ayarlar')
                    ->where('dili', '=', $dil)
                    ->as_assoc()
                    ->execute();
        return $sonuc;
    }
    
}