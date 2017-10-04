<?php

class Model_HaberDuyuru extends Model
{
    public function getHaberSeo($seo,$tip) {
        /*
       return DB::select()
            ->from('haberduyuru')
            ->where('seourl', '=', $seo)
            ->where('tip', '=', $tip)
            ->as_object()
            ->execute();
            */
            $sonuc = NULL;
            
            $sonuc = DB::query(Database::SELECT, "SELECT
                    t_haberduyuru.* , 
                    (SELECT baslik_seo FROM t_galeri_kategori WHERE id = t_haberduyuru.t_galeri_id LIMIT 1) AS galeri_seo,
                    (SELECT baslik FROM t_galeri_kategori WHERE id = t_haberduyuru.t_galeri_id LIMIT 1) AS galeri_adi
                    FROM
                    t_haberduyuru
                    WHERE seourl=:seo AND tip=:tip")
                    ->param(':seo', $seo)
                    ->param(':tip', $tip)
                    ->as_object()
                    ->execute();
                    
           
           if(count($sonuc)==0) {
                $sonuc = DB::query(Database::SELECT, "SELECT t_haberduyuru.*, 
                    (SELECT baslik_seo FROM t_galeri_kategori WHERE id = t_haberduyuru.t_galeri_id LIMIT 1) AS galeri_seo,
                    (SELECT baslik FROM t_galeri_kategori WHERE id = t_haberduyuru.t_galeri_id LIMIT 1) AS galeri_adi
                     FROM t_haberduyuru 
                     WHERE id = (SELECT t_haberduyuru_id FROM t_haberduyuru_301 WHERE seourl=:seo ORDER BY zaman DESC LIMIT 1)")
                    ->param(':seo', $seo)
                    ->as_object()
                    ->execute();
           }      

           return $sonuc;
    }
    
    public function getEkList($id)
    {
        return DB::select()
            ->from('dosya_ek')
            ->where('t_haberduyuru_id', '=', $id)
            ->where('ekormetin', '=', 'ek')
            ->order_by('id','ASC')
            ->as_object()
            ->execute();
    }
    
     public function getCount($tip, $dil, $filtre = null) {
        
        
       $sonuc = DB::select('COUNT(id) AS adettum')
            ->from('haberduyuru')
            ->where('tip', '=', $tip)
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1');
        
        if ($filtre<>null) {
            $sonuc->where('baslik','like', "%$filtre%");
        }
        
            return $sonuc->execute()->get('adettum', 0);
    }
    
    public function getList($tip, $dil, $limit, $offset, $filtre = null) {
        
       $sonuc= DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', $tip)
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1');
       
        if ($filtre<>null) {
            $sonuc->where('baslik','like', "%$filtre%");
        }
        
        return $sonuc->order_by('onem','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->limit($limit)
            ->offset($offset)
            ->as_object()
            ->execute();
    }
    
     public function getListLimit($tip, $dil, $lim) {
        
       return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', $tip)
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->order_by('onem','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->limit($lim)
            ->as_object()
            ->execute();
    }
    
    public function getHaberList($adet, $dil) {
        
       return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', 'haber')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->limit($adet)
            ->order_by('onem','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->order_by('id','DESC')
            ->as_object()
            ->execute();
        
    }
    
    public function getAktifDuyuru($dil) {
        
      return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', 'duyuru')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->where('sonyay_tarihi', '>=', date('Y-m-d'))
            ->order_by('onem','ASC')
            ->order_by('sira','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->as_object()
            ->execute();
    }
    
    public function getEtkinlik($adet, $dil) {
        
       return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', 'etkinlik')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->limit($adet)
            ->order_by('onem','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->as_object()
            ->execute();
        
    }
    
    public function getHomeEtkinlik($adet, $dil) {
        
       return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', 'etkinlik')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->where('resim_url', '<>', '')
            ->limit($adet)
            ->order_by('onem','ASC')
            ->order_by('yayin_tarihi','DESC')
            ->as_object()
            ->execute();
        
    }
    
     public function okundu($id) {
        
       return DB::update('haberduyuru')
            ->set(array('okuma' => DB::expr('`okuma` + 1')))
            ->where('id', '=', $id)
            ->execute();
    }
    
     public function getTVDuyuru($adet, $dil) {
        
      return DB::select()
            ->from('haberduyuru')
            ->where('tip', '=', 'tvduyuru')
            ->where('dili', '=', $dil)
            ->where('aktif', '=', '1')
            ->where('sonyay_tarihi', '>', date('Y-m-d'))
            ->limit($adet)
            ->order_by('yayin_tarihi','DESC')
            ->as_object()
            ->execute();
    }
}