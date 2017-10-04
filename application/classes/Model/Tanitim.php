<?php

class Model_Tanitim extends Model
{
    
    public function getTanitim($adet, $dil) {
        
       return DB::select()
            ->from('anasayfa_tanitim')
            ->where('dili', '=', $dil)
            ->limit($adet)
            ->order_by('sira','ASC')
            ->as_object()
            ->execute();
        
    }

}