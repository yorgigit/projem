<?php
 
class Controller_ShowEk extends Controller_Site {

    public function before()
    {
        $this->view = "inc_ekgoster"; 
        parent::before();
    }
    
    public function action_index()
	{
	   if(!$this->request->is_ajax())
			throw new HTTP_Exception_403;

        if ($this->request->method() == "POST") {
          $belgedokid = $this->request->post('bid');
          $ekler = Model::factory('BelgeDok')->getEkList($belgedokid);
          
          $this->view->set('ekler',  $ekler);
        }
    }
    
}