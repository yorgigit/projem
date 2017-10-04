<?php

class Model_Iletisim extends Model
{
    
    public function get() {
        
        return DB::select()
                    ->from('iletisim_ulasim')
                    ->limit(1)
                    ->as_object()
                    ->execute();
    }

    public function getTemel() {
        
        return DB::select('tel1', 'faks', 'eposta', 'facebook', 'twitter', 'youtube', 'google_plus')
                    ->from('iletisim_ulasim')
                    ->limit(1)
                    ->as_object()
                    ->execute();
    }
    
}