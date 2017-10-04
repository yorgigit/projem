<?php

class Model_Galeri extends Model
{
    
    public function getHomeGaleri($dil, $offset, $limit, $filtre = null) {
        
        $ek_filtre = null;
        
        if($filtre<>null) $ek_filtre = " AND kategori_adi LIKE '%".$filtre."%'";
        
        return DB::query(Database::SELECT, "SELECT
                    id, kategori_adi, baslik_seo, eklenme_tarihi,
                    (SELECT resim_url FROM t_galeri_resim WHERE id = 
                    (SELECT t_galeri_resim_id FROM t_galeri_kategori_resim WHERE t_galeri_kategori_id= t_galeri_kategori.id ORDER BY sira ASC LIMIT 1))
                    AS resim_url
                    FROM
                    t_galeri_kategori
                    WHERE dili=:dil AND aktif='1'".$ek_filtre."
                    ORDER BY eklenme_tarihi DESC LIMIT ".$offset.", ".$limit)
                    ->param(':dil', $dil)
                    ->as_object()
                    ->execute();
    }
   
   public function getCount($dil, $filtre = null) {

       $sonuc = DB::select('COUNT(id) AS adettum')
            ->from('galeri_kategori')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1');
        
        if ($filtre<>null) {
            $sonuc->where('kategori_adi','like', "%$filtre%");
        }
        
            return $sonuc->execute()->get('adettum', 0);
    }
    
    public function getGaleriBaslik($dil, $seo) {
        
          return DB::select('kategori_adi')
                    ->from('galeri_kategori')
                    ->where('baslik_seo', '=', $seo)
                    ->where('dili', '=', $dil)
                    ->as_object()
                    ->execute();
    }
    
   
   public function getGaleriFotos($dil, $seo, $adet = null) {
        
        $ek_limit = null;
        
        if($adet<>null) $ek_limit = ' LIMIT '.$adet;
        
        return DB::query(Database::SELECT, "SELECT
                                    t_galeri_resim.*, t_galeri_kategori.eklenme_tarihi
                                    FROM
                                    t_galeri_kategori
                                    INNER JOIN t_galeri_kategori_resim ON t_galeri_kategori_resim.t_galeri_kategori_id = t_galeri_kategori.id
                                    INNER JOIN t_galeri_resim ON t_galeri_kategori_resim.t_galeri_resim_id = t_galeri_resim.id
                                    WHERE
                                    t_galeri_kategori.baslik_seo = :seo AND
                                    t_galeri_kategori.aktif = '1'
                                    ORDER BY
                                    t_galeri_kategori_resim.sira ASC".$ek_limit)
                    ->param(':dil', $dil)
                    ->param(':seo', $seo)
                    ->as_object()
                    ->execute();
    }
    
    
    public function getGaleriFotosRandom($dil, $adet = null) {
        
        $ek_limit = null;
        
        if($adet<>null) $ek_limit = ' LIMIT '.$adet;
        
        return DB::query(Database::SELECT, "SELECT
                                    t_galeri_resim.*, t_galeri_kategori.eklenme_tarihi
                                    FROM
                                    t_galeri_kategori
                                    INNER JOIN t_galeri_kategori_resim ON t_galeri_kategori_resim.t_galeri_kategori_id = t_galeri_kategori.id
                                    INNER JOIN t_galeri_resim ON t_galeri_kategori_resim.t_galeri_resim_id = t_galeri_resim.id
                                    WHERE
                                    t_galeri_kategori.dili = :dil AND
                                    t_galeri_kategori.aktif = '1'
                                    ORDER BY
                                    t_galeri_kategori_resim.sira ASC".$ek_limit)
                    ->param(':dil', $dil)
                    ->param(':seo', $seo)
                    ->as_object()
                    ->execute();
    }
}