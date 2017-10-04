<?php

class Model_Sayfa extends Model
{
    public function getSayfaSeo($seo) {
        /*
       return DB::select()
            ->from('sayfalar')
            ->where('seourl', '=', $seo)
            ->as_object()
            ->execute();
            */
            
              return DB::query(Database::SELECT, "SELECT
                    t_sayfalar.* , 
                    (SELECT baslik_seo FROM t_galeri_kategori WHERE id = t_sayfalar.t_galeri_id LIMIT 1) AS galeri_seo,
                    (SELECT baslik FROM t_galeri_kategori WHERE id = t_sayfalar.t_galeri_id LIMIT 1) AS galeri_adi
                    FROM
                    t_sayfalar
                    INNER JOIN t_diller AS t3 ON t_sayfalar.dili=t3.dil_kisa AND t3.aktif='1'
                    WHERE t_sayfalar.seourl=:seo AND t_sayfalar.aktif='1'")
                    ->param(':seo', $seo)
                    ->as_object()
                    ->execute();
    }
    
    public function getEkList($id)
    {
        return DB::select()
            ->from('dosya_ek')
            ->where('t_sayfalar_id', '=', $id)
            ->where('ekormetin', '=', 'ek')
			->order_by('gorunen_isim','ASC')
            ->as_object()
            ->execute();
    }
    public function okundu($id) {
        
       return DB::update('sayfalar')
            ->set(array('okuma' => DB::expr('`okuma` + 1')))
            ->where('id', '=', $id)
            ->execute();
    }
}    