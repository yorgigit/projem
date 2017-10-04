<?php

class Model_Menu extends Model
{
    public function getAnaMenu($dil, $sabitmi = '0') {
        
        return DB::select()->from('menuler')
            ->where('dili', '=', $dil)
            ->where('ana_menuid', '=', NULL)
            ->where('sabitmi', '=', $sabitmi)
            ->order_by('sira','ASC')
            ->as_object()
            ->execute();
    }
    
    public function getAltMenu($dil, $amenuid, $sabitmi = '0') {
        return DB::select()->from('menuler')
            ->where('dili', '=', $dil)
            ->where('ana_menuid', '=', $amenuid)
            ->where('sabitmi', '=', $sabitmi)
            ->order_by('sira','ASC')
            ->as_object()
            ->execute();
    }
    
     public function getBaslik($seo) {
        return DB::select('baslik','id','link')->from('menuler')
            ->where('baslik_seo', '=', $seo)
            ->as_object()
            ->execute();
    }
    
    public function getUrlMenuLink($amenu, $menu, $link) {
        
        if(!empty($amenu)) { 
              return DB::query(Database::SELECT, "SELECT t2.baslik AS abaslik, t2.baslik_seo AS abaslik_seo, t1.baslik, t1.baslik_seo, t1.link
                                                  FROM t_menuler AS t1
                                                  INNER JOIN t_menuler AS t2 ON t1.ana_menuid = t2.id AND t2.baslik_seo = :amenu
                                                  WHERE t1.baslik_seo = :menu AND t1.link = :link")
                    ->param(':amenu', $amenu)
                    ->param(':menu', $menu)
                    ->param(':link', $link)
                    ->as_object()
                    ->execute();
         }
        else { 
              $altmenusay = DB::query(Database::SELECT, "SELECT COUNT(t1.ana_menuid) AS altmenuadet
                                                          FROM t_menuler AS t1
                                                          WHERE t1.ana_menuid = (SELECT t2.id FROM t_menuler AS t2 WHERE t2.baslik_seo = :menu AND t2.ana_menuid IS NULL LIMIT 1)")
                    ->param(':menu', $menu)
                    ->param(':link', $link)
                    ->as_object()
                    ->execute();

              
              if((int)$altmenusay[0]->altmenuadet > 0) {
                $sorgu = "SELECT t1.baslik, t1.baslik_seo, t1.link, (SELECT baslik FROM t_menuler WHERE baslik_seo = :menu LIMIT 1) AS abaslik
                                                    FROM t_menuler AS t1
                                                    WHERE t1.link = :link AND t1.ana_menuid = (
                                                    SELECT t2.id FROM t_menuler AS t2 WHERE t2.baslik_seo = :menu AND t2.ana_menuid IS NULL LIMIT 1)";
                      
             }
             else {
                    if(!empty($menu)) {
                      $sorgu = "SELECT t1.baslik, t1.baslik_seo, t1.link
                              FROM t_menuler AS t1
                              WHERE t1.link = :link AND t1.baslik_seo = :menu AND t1.ana_menuid IS NULL";
                   }
                   else {
                      $sorgu = "SELECT t1.baslik, t1.baslik_seo, t1.link
                              FROM t_menuler AS t1  WHERE (t1.link = :link OR t1.baslik_seo = :menu) AND t1.ana_menuid IS NULL";
                   }
             
             }
             
             return DB::query(Database::SELECT, $sorgu)
                      ->param(':menu', $menu)
                      ->param(':link', $link)
                      ->as_object()
                      ->execute();
        }
        
        
        
    }
    
    public function getUrlMenu($amenu, $menu) {
        
              return DB::query(Database::SELECT, "SELECT t2.baslik AS abaslik, t2.baslik_seo AS abaslik_seo, t1.baslik, t1.baslik_seo, t1.link, t1.dili
                                                  FROM t_menuler AS t1
                                                  INNER JOIN t_menuler AS t2 ON t1.ana_menuid = t2.id AND t2.baslik_seo = :amenu
                                                  INNER JOIN t_diller AS t3 ON t1.dili=t3.dil_kisa AND t3.aktif='1'
                                                  WHERE t1.baslik_seo = :menu")
                    ->param(':amenu', $amenu)
                    ->param(':menu', $menu)
                    ->as_object()
                    ->execute();
     
        
    }
}