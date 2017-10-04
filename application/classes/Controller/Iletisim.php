 <?php
 
class Controller_Iletisim extends Controller_Site {

    public function before()
    {
        $tip = $this->request->uri();
        //-----------------------------------------------------------------------
        /*
        *  Burada istek yapılan sayfanın hangi tip ve dil olduğu belirlenir
        */
         $tipler    = Kohana::$config->load('views.iletisim.iletisim');
        
         foreach($tipler as $key=>$val) {
                    if($tip==$val) {
                        $tip_dili = $key;
                        break; 
                    }
         }
        
        $this->view = "iletisim";

        parent::before();

        //--------Oturumun dili dönüştürülür.
         if($tip_dili<>$this->dil AND $this->yayindurum[$tip_dili]=='yayinda') {
              Session::instance()->set('lngkisa', $tip_dili);
              $this->dil = $tip_dili;
         }
         
        //------------------------------------------------------------------------------
    }
    
    public function action_index()
    {
        $iletisimveri = Model::factory('Iletisim')->get()[0];
        
        $tip = $this->request->uri();
        $breadyaz = __('menu_iletisim');
        
        Breadcrumbs::add(array($breadyaz, $tip));
        $crumbs = Breadcrumbs::render();
        
        $token = My::generateFormToken('');
        $session = Session::instance();
        $session->set('frmkey', $token);
        
        $captcha = Captcha::instance();
        
        $this->view
            ->set('veri', $iletisimveri)
            ->set('crumbs', $crumbs)
            ->set('token', $token)
            ->set('captcha', $captcha);
    }
  
}