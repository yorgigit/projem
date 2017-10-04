<?php
class Controller_Galeri extends Controller_Site {

    protected $bread_link = null;
    
    public function before() {
        
        $tip = $this->request->param('tip');
        $seo = $this->request->param('slug');
        
        $tip_dili = $this->dil;
        
         //-----------------------------------------------------------------------
            /*
            *  Burada istek yapılan sayfanın hangi tip ve dil olduğu belirlenir
            */
             $tipler    = Kohana::$config->load('views.galeriler.galeriler');
            
             foreach($tipler as $key=>$val) {
                        if($tip==$val) {
                            $tip_dili = $key;
                            $this->bread_link = $val;
                            break; 
                        }
             }
            
            //------------------------------------------------------------------------------
            
         if(empty($seo)) {
                    $this->view='listgaleri';
         }
         else {
                    $this->view='galerishow';
         }
         
        parent::before();

            //--------Oturumun dili dönüştürülür.
             if($tip_dili<>$this->dil) {
                  Session::instance()->set('lngkisa', $tip_dili);
                  $this->dil = $tip_dili;
             }
    } 
  
    public function action_index()
	{
        $tip = $this->request->param('tip');
        $seo = $this->request->param('slug');
        $galerirows     = null;
        $baslik         = null;
        $galerifotos    = null;
        $limit=$offset=$filtre = NULL;
        $pagination     = NULL;
        
        if(!empty($seo)) { 
            $galerirows = Model::factory('Galeri')->getHomeGaleri($this->dil,0,3);
            $galerifotos = Model::factory('Galeri')->getGaleriFotos($this->dil, $seo);
            $baslik     = Model::factory('Galeri')->getGaleriBaslik($this->dil, $seo)[0];
            
            if(empty($galerifotos) OR empty($baslik)) {
                //throw new Kohana_Exception($this->err['norecord']['galeri']);
                HTTP::redirect('notfound', 302);
            }
            $baslik = $baslik->kategori_adi;
        }
        else { // LISTELEME
        
            
            $session = Session::instance();

            $filtre = $this->request->query('filtre');
            $p      = $this->request->query('p');
            
            if(!empty($filtre)) {
                $session->set('filtre', $filtre);
            }
            else if($this->request->method() == "POST") {
                $filtre = $this->request->post('filtre');
                $session->set('filtre', $filtre);    
            }
            else {
                if(empty($this->p)) $session->delete('filtre');
                $filtre = $session->get('filtre'); 
            }
        
            $count_all = Model::factory('Galeri')->getCount($this->dil, $filtre);
            
            $pagination = Pagination::factory(array(
                        'total_items'    => $count_all,
                        //'items_per_page' => $num,
                        //'current_page'   => Request::current()->param("page"),
                       )
                    )
                    ->route_params(array(
                        'directory'  => Request::current()->directory(),
                        'controller' => Request::current()->controller(),
                        'action'     => Request::current()->action(),
                        'p'          => $p,
                        'tip'        => $tip,
                    ));

            $limit  = $pagination->items_per_page;
            $offset = $pagination->offset;
            
            
            $galerirows = Model::factory('Galeri')->getHomeGaleri($this->dil, $offset, $limit, $filtre);
            
        }
        
        /* BreadCrumbs */
        $breadyaz = __('bread_galeri');
        Breadcrumbs::add(array($breadyaz, $this->bread_link));
        $crumbs = Breadcrumbs::render();
        
        $this->view
                ->set('galeriler',      $galerirows)
                ->set('galerifotos',    $galerifotos)
                ->set('baslik',         $baslik)
                ->set('crumbs',         $crumbs)
                ->set('pagination',     $pagination)
                ->set('filtre',         $filtre)
                ->set('tip',            $tip);
	}
}
