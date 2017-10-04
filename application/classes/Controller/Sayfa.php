<?php
class Controller_Sayfa extends Controller_Site {

    public function before()
    {
        $this->view = "sayfa";

        parent::before();
    }
    
    public function action_index()
    {
        $ekler              = null;
        $sayfa_galeri_fotos = null;
        $sayfa				= null;
        $URL				= null;
        
        $amenu  = $this->request->param('amenu');
        $menu    = $this->request->param('menu');
        $slug    = $this->request->param('slug');
        $format    = $this->request->param('format');
        
        if(empty($menu)) {
          $menu = $amenu; $amenu = NULL;
        }
        
        $URL = Model::factory('Menu')->getUrlMenuLink($amenu, $menu, $slug.'.'.$format)[0];
        
        if (!empty($menu) AND empty($URL)) {
                HTTP::redirect('notfound', 302);
        }
        
        $sayfa = Model::factory('Sayfa')->getSayfaSeo($slug)[0];
        
        if (empty($sayfa)) {
                HTTP::redirect('notfound', 302);
        }
       
        if(!empty($amenu) AND !empty($menu)) $tamlink = $amenu.'/'.$menu.'/'.$sayfa->seourl.'.'.$format;
        else if(!empty($menu)) $tamlink = $menu.'/'.$sayfa->seourl.'.'.$format;
        else $tamlink = $sayfa->seourl.'.'.$format;

        
        $sayfa_galeri_fotos = Model::factory('Galeri')->getGaleriFotos($this->dil,$sayfa->galeri_seo);
        
        $ekler = Model::factory('Sayfa')->getEkList($sayfa->id);
        
        /* Okuma Sayısı Artırılır  */
        Model::factory('Sayfa')->okundu($sayfa->id);


        /* BreadCrumbs */
        if(!empty($URL->abaslik)) { 
                                    Breadcrumbs::add(array($URL->abaslik,'')); //$amenu.'/'
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
         else {
            if(!empty($URL->baslik)) Breadcrumbs::add(array($URL->baslik,$tamlink));
         }
        
        //Breadcrumbs::add(array($sayfa->baslik, $tamlink));
        $crumbs = Breadcrumbs::render();
        
        
        $sayfa->metin = str_replace('@','<i class="fa fa-at"></i>',$sayfa->metin);
        $sayfa->metin = preg_replace('|mailto:([A-Za-z0-9_\-.]+)(<i.*?>.*?</i>)([A-Za-z0-9_\-.]+)|', 'mailto:$1@$3',$sayfa->metin);
        
        $this->view
            ->set('sayfa',  $sayfa)
            ->set('sayfa_galeri_fotos',  $sayfa_galeri_fotos)
            ->set('ekler',  $ekler)
            ->set('crumbs', $crumbs);
    }
}