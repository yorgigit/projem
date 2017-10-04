<?php
 
class Controller_EtkTakvim extends Controller_Site {

    public function before()
    {
        $tip = $this->request->uri();
        //-----------------------------------------------------------------------
        /*
        *  Burada istek yapýlan sayfanýn hangi tip ve dil olduðu belirlenir
        */
         $tipler    = Kohana::$config->load('views.etkinliktakvimi');
        
         foreach($tipler as $key=>$val) {
                    if($tip==$val) {
                        $tip_dili = $key;
                        break; 
                    }
         }
        
       
        $this->view = "etk_takvim";
            
        parent::before();
        
        //--------Oturumun dili dönüþtürülür.
         if($tip_dili<>$this->dil AND $this->yayindurum[$tip_dili]=='yayinda') {
              Session::instance()->set('lngkisa', $tip_dili);
              $this->dil = $tip_dili;
         }
         
        //------------------------------------------------------------------------------
    }
    
    public function action_index()
    {
           
        $etkinlikRenkleri    = Kohana::$config->load('views.etkrenkler');
        $veriler             = Model::factory('EtkTakvim')->get(date("Y"),$this->dil);
        $output = null;
        
        if(count($veriler)>0) {
            foreach($veriler as $etk) {
                
                $link = $end = NULL;
                
                $start = $etk['baslatarih'];
                
                if(!empty($etk['link'])) {
                    $link=$etk['link'];
                    if(strpos($link,"http://")===false) $link = "http://".$link;
                    $link=array('url' => $link);
                }
                
                if(!empty($etk['baslasaat'])) {
                    $start = sprintf('%sT%s', $etk['baslatarih'],  substr($etk['baslasaat'],0,5));
                }
                
                if(!empty($etk['bitistarih'])) {
                    if(!empty($etk['bitissaat'])) $end =sprintf('%sT%s', $etk['bitistarih'],  substr($etk['bitissaat'],0,5));
                    else $end = $etk['bitistarih'];
                    $end=array('end' => $end);
                }
                
                $json = array(
                    'title' => html_entity_decode($etk['baslik']),
                    'start' => $start,
                    'color' => $etkinlikRenkleri[$etk['kategori']],
                );
                
                if(!empty($end)) $json += $end;
                if(!empty($link)) $json += $link;
                
                $output[] = json_encode($json);
            }
            $output = join(',', $output);
        }
        
        $tip = $this->request->uri();
        $breadyaz = __('menu_etkinliktakvim');
        
        Breadcrumbs::add(array($breadyaz, $tip));
        $crumbs = Breadcrumbs::render();
        
        $token = My::generateFormToken('');
        $session = Session::instance();
        $session->set('frmkey', $token);
        
        $this->view
            ->set('veri', $output)
            ->set('crumbs', $crumbs)
            ->set('token', $token);
    }
  
}