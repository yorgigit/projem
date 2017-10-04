<?php
class Controller_Anasayfa extends Controller_Site {

    public function before()
    {
        $this->view = "anasayfa";

        parent::before();
    }
    
	public function action_index()
	{
        $haberrows 		= null;
        $galerirows 	= null;
        $duyururows 	= null;
        $slaytrows 		= null;
        $tanitimrows 	= null;
        $popup 			= null; 
		$popupGenel 	= null;
        $homebutons 	= null;
        
        $haberrows = Model::factory('HaberDuyuru')->getHaberList(4,$this->dil);
        
        $duyururows = Model::factory('HaberDuyuru')->getAktifDuyuru($this->dil);
        
        $slaytrows =  Model::factory('Slayt')->getSlayt(12,$this->dil);
        
        $etkinlikrows = Model::factory('HaberDuyuru')->getEtkinlik(4,$this->dil);
        
        //$tanitimrows = Model::factory('Tanitim')->getTanitim(3,$this->dil);

        $popup 		= Model::factory('Popup')->getPopup($this->dil);
        $popupGenel = Model::factory('Popup')->getPopupGenel($this->dil);
        
        $homebutons = Model::factory('HomeButons')->getList($this->dil);
        
        if($this->ayarlar->anasayfa_galeri=="acik") {
            $galerirows = Model::factory('Galeri')->getHomeGaleri($this->dil,0,4);
        }
        
        $this->view->set('slider',          $slaytrows)
                    ->set('haberler',       $haberrows)
                    ->set('duyurular',      $duyururows)
                    ->set('etkinlikler',    $etkinlikrows)
                    ->set('galeriler',      $galerirows)
                    //->set('anatanitim',     $tanitimrows)
                    ->set('popup',          $popup)
					->set('popupGenel',     $popupGenel)
                    ->set('homebutons',     $homebutons);
	}
}
