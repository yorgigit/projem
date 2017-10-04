 <?php
 
class Controller_HaberDuyuru extends Controller_Site {

    protected $tip          = null;
    protected $dbtip        = null;
    protected $seo          = null;
    protected $search_term  = null;
    protected $page         = null;
    protected $view_page    = null;
    protected $istek_dil    = null;

//*************************************************************************************************************    
   public function before()
    {
        $this->amenu  = $this->request->param('amenu');
        $this->tip    = $this->request->param('tip');
        $this->slug   = $this->request->param('slug');
        $this->format = $this->request->param('format');

        //-----------------------------------------------------------------------
        /*
        *  Burada istek yapılan sayfanın hangi tip ve dil olduğu belirlenir
        */
        
         $tipler    = Kohana::$config->load('views.haberduyuru');
        
         foreach($tipler as $key=>$val) {
                foreach($val as $key2=>$val2) {
                    if($this->tip==$val2) {
                        $this->istek_dil = $key2;
                        $this->dbtip = $key;
                        break; 
                    }
                }
            }
        //------------------------------------------------------------------------


         if($this->istek_dil<>$this->dil AND $this->yayindurum[$this->istek_dil]=='yayinda') {
              Session::instance()->set('lngkisa', $this->istek_dil);
         }
        
        $this->view = 'haberduyuru';

        parent::before();
    }
    

//*************************************************************************************************************   
    public function action_index()
    {
        $URL = null;
        
        $URL = Model::factory('Menu')->getUrlMenu($this->amenu, $this->tip)[0];
        
        if (empty($URL)) {
              HTTP::redirect('notfound', 302);
        }
        
        $haber_galeri_fotos = null;
        $ekler              = null;
        
        $haber = Model::factory('HaberDuyuru')->getHaberSeo($this->slug, $this->dbtip)[0];
        
        if(empty($haber)) {
            //throw new Kohana_Exception($this->err['norecord'][$this->dbtip]);
            HTTP::redirect('notfound', 302);
        }

        $tamlink = $this->amenu.'/'.$this->tip.'/'.$haber->seourl.'.'.$this->format;

        $haberson3 = Model::factory('HaberDuyuru')->getListLimit($this->dbtip,$this->dil, 3);

        $haber_galeri_fotos = Model::factory('Galeri')->getGaleriFotos($this->dil,$haber->galeri_seo);
        
        $ekler = Model::factory('HaberDuyuru')->getEkList($haber->id);
        
        /*
        * Okuma Sayısı Artırılır
        */
        Model::factory('HaberDuyuru')->okundu($haber->id);

        /* BreadCrumbs */
        if(!empty($URL->abaslik)) { 
                                    Breadcrumbs::add(array($URL->abaslik,$this->amenu.'/'));
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$this->amenu.'/'.$this->tip));
         }
         else {
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
        
        Breadcrumbs::add(array($haber->baslik, $tamlink));
        $crumbs = Breadcrumbs::render();
        
        
        $this->view
            ->set('haber',      $haber)
            ->set('haber_galeri_fotos',  $haber_galeri_fotos)
            ->set('ekler',      $ekler)
            ->set('haberson3',  $haberson3)
            ->set('tip',        $this->tip)
            ->set('amenu',      $this->amenu)
            ->set('dbtip',      $this->dbtip)
            ->set('menu_baslik',$URL->baslik)
            ->set('crumbs',     $crumbs);
                
    }
//*************************************************************************************************************   
}