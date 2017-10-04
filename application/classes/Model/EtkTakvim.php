<?php

class Model_EtkTakvim extends Model
{
    
    public function get($yil, $dil) {
        
        return  DB::select()
                    ->from("etkinlik_takvim")
                    ->where('dili','=', "$dil")
                    ->where('baslatarih','like', "$yil%")
                    ->where('aktif','=', "1")
                    ->order_by('baslatarih','ASC')
                    ->execute();
    }

}