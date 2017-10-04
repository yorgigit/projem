<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sitemap extends Controller_Site { 
    
    
    public function before()
    {
        $this->view = "sitemap";

        parent::before();
    }
    
    public function action_index()
    {
        $base_loc = $this->ayarlarGenel->site_adresi;
        $slinkler = $this->slinkler;  //dillere göre urller 'dizi'
        
        // Set response headers
        $this->request->headers['Content-Type'] = 'text/xml';
    
        // Sitemap class
        $sitemap = new Sitemap;
    

        //--------------ANA URL ------------------------------------------------------------------
            $url = new Sitemap_URL();
    
            // Core attributes
            $url->set_loc($base_loc);
            //$url->set_last_mod(time());
            $url->set_priority(1.00);
            $url->set_change_frequency('always');
    
            $sitemap->add($url);
    
        //-----------------İLETİŞİM -----------------------------------------------------------------

        foreach($slinkler->iletisim['iletisim'] as $key=>$value)
        {
            if(isset($this->yayindurum[$key]) AND $this->yayindurum[$key]=='yayinda') {
                $url = new Sitemap_URL();
        
                // Core attributes
                $url->set_loc($base_loc.'/'.$value);
                //$url->set_last_mod(time());
                $url->set_priority(1.00);
                $url->set_change_frequency('always');
        
                $sitemap->add($url);
            }
        }
        
        //----------------MENÜLER -------------------------------------------------------------------------
        $menuler = Model::factory('SiteMap')->GetMenu();
    
        // Add the URLs
        foreach($menuler as $row)
        {
            $url = new Sitemap_URL();
    
            // Core attributes
            $url->set_loc($base_loc.'/'.$row->loc);
            if(!empty($row->last_mod)) $url->set_last_mod(strtotime($row->last_mod));
            $url->set_priority($row->priority);
            $url->set_change_frequency($row->frequency);
    
            $sitemap->add($url);
        }
        
        //-----------------SAYFALAR -----------------------------------------------------------------
        $sayfalar = Model::factory('SiteMap')->GetSayfa();
    
        // Add the URLs
        foreach($sayfalar as $row)
        {
            $url = new Sitemap_URL();
    
            // Core attributes
            $url->set_loc($base_loc.'/'.$row->loc);
            if(!empty($row->last_mod)) $url->set_last_mod(strtotime($row->last_mod));
            $url->set_priority($row->priority);
            $url->set_change_frequency($row->frequency);
    
            $sitemap->add($url);
        }
        
      //-----------------GALERİLER -----------------------------------------------------------------
        $galeriler = Model::factory('SiteMap')->GetGaleri($slinkler->galeriler['galeriler']);
    
        // Add the URLs
        foreach($galeriler as $row)
        {
            $url = new Sitemap_URL();
    
            // Core attributes
            $url->set_loc($base_loc.'/'.$row->loc);
            if(!empty($row->last_mod)) $url->set_last_mod(strtotime($row->last_mod));
            $url->set_priority($row->priority);
            $url->set_change_frequency($row->frequency);
    
            $sitemap->add($url);
        }
        
        //----------------MENÜLER -------------------------------------------------------------------------
        
        $haberduyurular = Model::factory('SiteMap')->GetHaberDuyuru($slinkler->haberduyuru);
    
        
        // Add the URLs
        foreach($haberduyurular as $row)
        {
      
            $url = new Sitemap_URL();
    
            // Core attributes
            $url->set_loc($base_loc.'/'.$row->loc);
            if(!empty($row->last_mod)) $url->set_last_mod(strtotime($row->last_mod));
            $url->set_priority($row->priority);
            $url->set_change_frequency($row->frequency);
    
            $sitemap->add($url);
        }
        
        $sitemap->ping($sitemap);
      
        //$this->request->response = $sitemap->render();
        
        $this->view->set('sitemap',  $sitemap);
    }
    
}