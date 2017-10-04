<?php

class Model_BelgeDok extends Model
{
    public function getBelgeDokKategori($seo) {
        
       return DB::select()
            ->from('belgedok_kategori')
            ->where('seourl', '=', $seo)
            ->as_object()
            ->execute();
    }
    
    public function getCountBelgeDok($katid, $filtre = null) {
        
        
       $sonuc = DB::select('COUNT(id) AS adettum')
             ->from('belgedok')
            ->where('t_belgedok_kategori_id', '=', $katid)
            ->where('aktif', '=', '1');
        
        if ($filtre<>null) {
            $sonuc->where('baslik','like', "%$filtre%");
        }
        
            return $sonuc->execute()->get('adettum', 0);
    }
    
     public function getBelgeDokList($katid, $limit, $offset, $filtre = null) {
        
       $sonuc= DB::select()
            ->from('belgedok')
            ->where('t_belgedok_kategori_id', '=', $katid)
            ->where('aktif', '=', '1');
       
        if ($filtre<>null) {
            $sonuc->where('baslik','like', "%$filtre%");
        }
        
        return $sonuc
            ->order_by('arsiv','ASC')
            ->order_by('eklenme_tarihi','DESC')
            ->order_by('id','DESC')
            ->limit($limit)
            ->offset($offset)
            ->as_object()
            ->execute();
    }
    
     public function getEkList($id)
    {
        return DB::select()
            ->from('dosya_ek')
            ->where('t_belgedok_id', '=', $id)
			->order_by('id','ASC')
            ->as_object()
            ->execute();
    }
}   