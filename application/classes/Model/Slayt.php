<?php

class Model_Slayt extends Model
{
    public function getSlayt($adet, $dil) {
        
        return DB::select()->from('slayt')
            ->where('aktif', '=', '1')
            ->where('dili', '=', $dil)
            ->limit($adet)
            ->order_by('sira','ASC')
            ->order_by('id','DESC')
            ->as_object()
            ->execute();
    }
}