<?php
class Controller_BelgeDok extends Controller_Site {


    public function before()
    {
        $this->view = "listbelgedok";
        parent::before();
    }
    
    public function action_index()
    {
        //Request::factory('Error/index/{'.$any.'}')->execute()->response;

            $session        = Session::instance();
            $filtre         = null;
            $katid          = $this->request->param('katid');
            $kategori       = $this->request->param('katadi');
            $kategoriseo    = $this->request->param('katseo');
            $menu           = $this->request->param('menu');
            $amenu          = $this->request->param('amenu');
            $p              = $this->request->query('p');
            
            if(empty($menu)) {
                $menu = $amenu; $amenu = NULL;
                $tamlink = $menu.'/'.$kategoriseo;
            }
            else {
                $tamlink = $amenu.'/'.$menu.'/'.$kategoriseo;
            }
        
            $URL = Model::factory('Menu')->getUrlMenuLink($amenu, $menu, $kategoriseo)[0];
        
            if (!empty($menu) AND empty($URL)) {
                //throw new Kohana_Exception($this->err['sayfa']['noicerik']);
                HTTP::redirect('notfound', 302);
            }
            
            //---------------- Kayıtlar -------------------------------------------------------
            
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
    
            $count_all = Model::factory('BelgeDok')->getCountBelgeDok($katid, $filtre);
            
            $pagination = Pagination::factory(array(
                            'total_items'    => $count_all,
                            'items_per_page' => 25,
                            //'current_page'   => Request::current()->param("page"),
                           )
                        )
                        ->route_params(array(
                            'directory'  => Request::current()->directory(),
                            'controller' => Request::current()->controller(),
                            'action'     => Request::current()->action(),
                            'any'        => $this->request->param('any'),
                            'menu'       => $menu,
                            'amenu'      => $amenu,
                            'p'          => $p
                        ));
    
                $limit  = $pagination->items_per_page;
                $offset = $pagination->offset;
            
              $kayitlar = Model::factory('BelgeDok')->getBelgeDokList($katid, $limit, $offset, $filtre);
            //--------------------------------------------------------------------------------------------------
            

        /* BreadCrumbs */
        if(!empty($URL->abaslik)) { 
                                    Breadcrumbs::add(array($URL->abaslik,'')); //$amenu.'/'
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
         else {
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
        
        //Breadcrumbs::add(array($kategori, $tamlink));
        $crumbs = Breadcrumbs::render();
                       
    
            $this->view
                ->set('kategori',       $kategori)
                ->set('tamlink',        $tamlink)
                ->set('kayitlar',       $kayitlar)
                ->set('crumbs',         $crumbs)
                ->set('pagination',     $pagination)
                ->set('filtre',         $filtre);
   
    }
}