 <?php
 
class Controller_HaberDuyuruList extends Controller_Site {

    protected $amenu        = null;
    protected $tip          = null;
    protected $p            = null;
    protected $dbtip        = null;
    protected $search_term  = null;
    protected $page         = null;
    protected $view_page    = null;
    protected $istek_dil    = null;

//*************************************************************************************************************    
    public function before()
    {
        $this->amenu  = $this->request->param('amenu');
        $this->tip    = $this->request->param('tip');
        $this->p      = $this->request->query('p');
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
        
        $this->view = 'listhaberduyuru';

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
        
        $tamlink = $this->amenu.'/'.$this->tip;
        
        $session = Session::instance();

        $filtre = $this->request->query('filtre');
        
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

        $count_all = Model::factory('HaberDuyuru')->getCount($this->dbtip, $this->istek_dil, $filtre);
        
        //you can configure routes and custom routes params
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
                        'tip'        => $this->tip,
                        'amenu'      => $this->amenu,
                        'p'          => $this->p,
                    ));

        $limit  = $pagination->items_per_page;
        $offset = $pagination->offset;
        
        
        $kayitlar = Model::factory('HaberDuyuru')->getList($this->dbtip, $this->istek_dil, $limit, $offset, $filtre);

        if(empty($kayitlar)) {
            HTTP::redirect('notfound', 302);
            //throw new Kohana_Exception($this->err['norecord'][$this->dbtip]);
        }


        /* BreadCrumbs */
        if(!empty($URL->abaslik)) { 
                                    Breadcrumbs::add(array($URL->abaslik,$this->amenu.'/'));
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
         else {
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }

        $crumbs = Breadcrumbs::render();
                
        $this->view
            ->set('kayitlar',   $kayitlar)
            ->set('tip',        $this->tip)
            ->set('tamlink',    $tamlink)
            ->set('dbtip',      $this->dbtip)
            ->set('crumbs',     $crumbs)
            ->set('pagination', $pagination)
            ->set('filtre',     $filtre);
    }
}