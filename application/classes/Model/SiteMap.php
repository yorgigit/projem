<?
class Model_SiteMap extends Model
{
//-------------------------------------------------------------------------------------------------------------
	public function GetSayfa() {
        try {		
        
        return DB::query(Database::SELECT, "SELECT
                        CONCAT(t_sayfalar.seourl, '.html') AS loc,
                        t_sayfalar.islemzaman AS last_mod,
                        '0.8' AS priority,
                        'weekly' AS frequency
                        FROM
                        t_sayfalar
                        WHERE
                        t_sayfalar.aktif = '1'
                        AND t_sayfalar.dili IN (SELECT dili FROM t_ayarlar WHERE site_durum='yayinda')")
                      ->as_object()
                      ->execute();
               		
       } catch ( Database_Exception $e ) {   
              throw new Kohana_Exception('ERR:'.$e->getMessage());
          } 
    }
//-------------------------------------------------------------------------------------------------------------    
    public function GetMenu() {
        try {		
        
        return DB::query(Database::SELECT, "SELECT
                        IF(t_menuler.baslik_seo<>t_menuler.link, CONCAT(t_menuler.baslik_seo,'/',t_menuler.link), t_menuler.link) AS loc,
                        IF(t_menuler.hedef_turu='sayfa',
                        (SELECT islemzaman FROM t_sayfalar WHERE seourl+'.html'=t_menuler.link LIMIT 1),
                        t_menuler.islemzaman) AS last_mod,
                        '0.8' AS priority,
                        IF(t_menuler.sabitmi='1','daily','weekly') AS frequency
                        FROM
                        t_menuler
                        WHERE t_menuler.link<>'' AND t_menuler.link IS NOT NULL
                        AND t_menuler.dili IN (SELECT dili FROM t_ayarlar WHERE site_durum='yayinda')")
                      ->as_object()
                      ->execute();
               		
       } catch ( Database_Exception $e ) {   
              throw new Kohana_Exception('ERR:'.$e->getMessage());
          } 
    }
//-------------------------------------------------------------------------------------------------------------    
    public function GetGaleri($dizi) {
        try {		
        
            $sonuc = array();
            foreach($dizi as $dil=>$yol)
            {
                    $arr = DB::query(Database::SELECT, "SELECT
                        CONCAT('".$yol."/',t_galeri_kategori.baslik_seo) AS loc,
                        t_galeri_kategori.islemzaman AS last_mod,
                        '0.7' AS priority,
                        'daily' AS frequency
                        FROM
                        t_galeri_kategori
                        WHERE
                        t_galeri_kategori.aktif = '1' AND t_galeri_kategori.dili='".$dil."'
                        AND t_galeri_kategori.dili IN (SELECT dili FROM t_ayarlar WHERE site_durum='yayinda')")
                      ->as_object()
                      ->execute();
                      
                      if(count($arr)>0) {
                        foreach($arr as $row)
                        {   
                            array_push($sonuc,$row);     
                        }
                      }
            }   
            
            return $sonuc;  	
       } catch ( Database_Exception $e ) {   
              throw new Kohana_Exception('ERR:'.$e->getMessage());
          } 
    }
    
 //-------------------------------------------------------------------------------------------------------------
    public function GetHaberDuyuru($dizi) {
        try {		
  
            $sonuc = array();
            foreach($dizi as $tip=>$diller)
            {
                foreach($diller as $dil=>$yol)
                {
                    $arr = DB::query(Database::SELECT, "SELECT
                        CONCAT('".$yol."/',t_haberduyuru.seourl, '.html') AS loc,
                        t_haberduyuru.islemzaman AS last_mod,
                        '0.7' AS priority,
                        'daily' AS frequency
                        FROM
                        t_haberduyuru
                        WHERE
                        t_haberduyuru.aktif = '1' AND t_haberduyuru.dili='".$dil."' AND t_haberduyuru.tip='".$tip."'
                        AND t_haberduyuru.dili IN (SELECT dili FROM t_ayarlar WHERE site_durum='yayinda')")
                          ->as_object()
                          ->execute();
                   
                    if(count($arr)>0) {
                        foreach($arr as $row)
                        {   
                            array_push($sonuc,$row);     
                        }
                    }
                   
                }
            }   
            
            return $sonuc;       
                      		
       } catch ( Database_Exception $e ) {   
              throw new Kohana_Exception('ERR:'.$e->getMessage());
          } 
    }
    
}