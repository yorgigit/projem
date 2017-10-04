 <?php
 
class Controller_Tv extends Controller_Site {

    public function before()
    {
        $this->view = "tv_show";

        parent::before();
    }
    
    public function action_index()
    {
        
	    $tvveri = Model::factory('HaberDuyuru')->getTVDuyuru(50, $this->dil);
        
        $this->view
            ->set('kayitlar', $tvveri);
    }
}