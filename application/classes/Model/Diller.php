<?php

class Model_Diller extends Model
{
    public function getAktifDiller() {
        /*
        return DB::select()
                    ->from('diller')
                    ->where('aktif', '=', '1')
                    ->as_object()
                    ->execute();
					*/
					
		return DB::query(Database::SELECT, "SELECT
						t_ayarlar.site_durum,
						t_diller.aktif,
						t_diller.dil_kisa,
						t_diller.dil,
						t_diller.id
						FROM
						t_ayarlar
						INNER JOIN t_diller ON t_ayarlar.dili = t_diller.dil_kisa
						WHERE
						t_diller.aktif = 1 AND t_ayarlar.site_durum = 'yayinda'")
                    ->as_object()
                    ->execute();					
    }

}