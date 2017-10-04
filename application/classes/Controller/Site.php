<?php
class Controller_Site extends Controller 
{
    
    protected $dil  = '';
    protected $ayarlar  = '';
    protected $ayarlarGenel  = ''; 
    protected $err  = '';
    protected $view = null;
    protected $slinkler = null;
    protected $yayindurum = null;
    protected $genel_yayindurum = null;
    
	public function before()
	{
          Kohana_Exception::$error_view = 'error/500';
           
        // ******************************************************************
        /*
        *  Geçerli Aktif Diller Çekilir ve Oturuma Kaydedilir
        *  Varsayılan dil veritabanındaki ilk aktif dildir
        */
            
            $diller  = Model::factory('Diller')->getAktifDiller();
            $varsayilandil = $diller[0];

            $session = Session::instance();
            //$session->set('lngkisa', 'TR');
        
            if(is_null($session->get('lngkisa'))) { 
                $session->set('lngkisa', $varsayilandil->dil_kisa);
            }
        
            $this->dil = $session->get('lngkisa'); // aktif dil
  
        // ******************************************************************
            $yayindurum = NULL;
            foreach ($diller as $v) {
              $ydurum  = Model::factory('Ayarlar')->getYayinDurum($v->dil_kisa);
              $this->yayindurum[$v->dil_kisa] = $ydurum[0]["site_durum"];
              if($this->yayindurum[$v->dil_kisa] == 'yayinda') $genel_yayindurum = 1;
            }
            
            if (empty($genel_yayindurum)) {
                throw new Kohana_Exception('Bu sitenin yayını geçici olarak durdurulmuştur!<br/><br/><i>This site has been stopped temporarily!</i>');
            }
            
            $this->ayarlar  = Model::factory('Ayarlar')->get($this->dil);
        
            if (0 == $this->ayarlar->count()) {
                throw new Kohana_Exception('Ayarlar Bulunamadı !');
            }
            $this->ayarlar = $this->ayarlar[0];
        
        
            $this->ayarlarGenel  = Model::factory('AyarlarGenel')->get();
        
            if (0 == $this->ayarlarGenel->count()) {
             throw new Kohana_Exception('Ayarlar Bulunamadı !');
            }
            $this->ayarlarGenel = $this->ayarlarGenel[0];
            
            $iletisim_bilgiler  = Model::factory('Iletisim')->getTemel()[0];
        
    
            
        // ******************************************************************
            /*
            * Kullanıcı Tanımlı olan Menüler ve Alt Menüler Çekilir
            */
            $menurows =  ORM::factory('Menu')->getAnaMenu($this->dil);
            $altmenu = null;
            foreach ($menurows as $v) {
               $altmenu[$v->id] =  ORM::factory('Menu')->getAltMenu($this->dil, $v->id);
            }
            
            /*
            * Sabit Menüler ve Alt Menüler Çekilir
            */
            $menurows_sabit =  ORM::factory('Menu')->getAnaMenu($this->dil, '1');
            $altmenu_sabit = null;
            foreach ($menurows_sabit as $v) {
               $altmenu_sabit[$v->id] =  ORM::factory('Menu')->getAltMenu($this->dil, $v->id, '1');
            }
            
         
        // ******************************************************************
        /*
        *  CONFIG Ayarları Çekilir.
        */
             $siteConfigs = Kohana::$config->load('site');
             
             foreach($siteConfigs as $key => $val){
                 if($key=='tema')  $val=$val.$this->ayarlarGenel->tema.'/';
                 if($key=='files') $val=$val.$this->ayarlarGenel->cdn_dizin.'/';
                 if($key=='renk')  $val=$this->ayarlarGenel->tema_renk;
                 define(strtoupper($key), $val);    
             }

                
             //--------- CDN Kontrolü.CDN aktifmi------------------------------------
             $cdndurum = My::is_url_exist(CDN.'index.html');
             if(!$cdndurum) {
                  Kohana_Exception::$error_view = 'error/500';
                  throw new Kohana_Exception('Generel Server Error!');
             }
             //-----------------------------------------------------------------------
             
             $this->slinkler    = Kohana::$config->load('views');
            
             // Hata Mesajları
             $this->err = Kohana::message('Hatalar', $this->dil);
             $this->err = isset($this->err)? $this->err : Kohana::message('Hatalar', 'EN');
             
             $baglantilar = null;
             try {
                 $baglantilar = Curl::get_content(ORTAK.'/json/baglantilar');
                 $baglantilar = json_decode($baglantilar, true);
                 $baglantilar = isset($baglantilar[$this->dil]) ? $baglantilar[$this->dil] : NULL;            	
             } catch(Curl_Exception $e) {}
            
             //css
             $sayfa = $this->request->controller();
             $cssjs = Kohana::$config->load('cssjs');
             $cssjs = $cssjs->get($sayfa);   
         // ******************************************************************
            
        i18n::lang(strtolower($this->dil));  // Sabit değerler çekilir (Multilanguage)
        
        Breadcrumbs::add(array(__('menu_mainpage'),''));
        
        $uri = URL::site(Request::detect_uri(), TRUE) . URL::query();

        $this->view = is_null($this->view) ? $sayfa : $this->view;
        
        $this->view = View::factory($this->view)
                        ->set('dil',                $this->dil) //aktif dil
                        ->set('diller',             $diller)
                        ->set('ERR',                $this->err)
                        ->set('cssjs',              $cssjs)
                        ->set('ayarlar',            $this->ayarlar)
                        ->set('ayarlarGenel',       $this->ayarlarGenel)
                        ->set('yayindurum',         $this->yayindurum)
                        ->set('slinkler',           $this->slinkler)
                        ->set('baglantilar',        $baglantilar)
                        ->set('iletisim',           $iletisim_bilgiler)
                        ->set('busayfa',            $sayfa)
                        ->set('menuler',            $menurows)
                        ->set('altmenuler',         $altmenu)
                        ->set('menuler_sabit',      $menurows_sabit)
                        ->set('altmenuler_sabit',   $altmenu_sabit)                        
                        ->set('uri',                $uri);

 }

    public function after()
    {
        print $this->view;
    }

}
