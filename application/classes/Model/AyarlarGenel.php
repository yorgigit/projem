<?php

class Model_AyarlarGenel extends Model
{
    public function get() {
        
        return DB::select()
                    ->from('ayarlar_genel')
                    ->limit(1)
                    ->as_object()
                    ->execute();
    }

}