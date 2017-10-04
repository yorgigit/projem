<?php defined('SYSPATH') or die('No direct script access.');

class Controller_HaberDuyuruJSON extends Controller_Site { 
    
     public function before()
    {
        $this->view = "blank";

        parent::before();
    }
    
    public function action_index()
    {
        // Set response headers
        
        $base_loc = $this->ayarlarGenel->site_adresi;
        $slinkler = $this->slinkler;  //dillere göre urller 'dizi'
        
        $gelendil = $this->request->param('dil');
        $adet     = $this->request->param('adet');
        
        $adet = (empty($adet))? 2 : $adet;
        $haberduyurular = Model::factory('HaberDuyuru')->getHaberList($adet,$gelendil);
    
        $data = array();
        // Add the URLs
        $arsiv_dir = ($gelendil=='TR')?'arsiv':'archive';
        
        $haber_base_url = $base_loc.'/'.$arsiv_dir.'/'.$slinkler['haberduyuru']['haber'][$gelendil].'/';
        
        //$data[0]['birim']     = $this->ayarlar->site_adi;
        //$data[0]['haberadet'] = count($haberduyurular);
        
        $i = 0;
        foreach($haberduyurular as $row)
        {
            // Core attributes
            $data[$i]['baslik']       = $row->baslik;
            $data[$i]['dili']         = $row->dili;
            $data[$i]['ktarih']       = strtotime($row->kayit_tarih);
            //$data[$i]['metin']      = $row->metin;
            $data[$i]['adres']        = $haber_base_url.$row->seourl.'.html';
            $data[$i]['foto']         = FILES.'foto/'.$row->resim_url;
            $data[$i]['birim']        = $this->ayarlar->site_adi;
            $i++;
        }
               
        $this->response->headers('Content-Type','application/json');
       
        echo json_encode($data);
    }
    
}