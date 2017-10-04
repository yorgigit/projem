<?php
class Controller_Error extends Controller_Site {

    public function before()
    {
        $this->view = "error/404";
        parent::before();
    }
    
    public function action_index()
    {
        $any = $this->request->param('any');
    }
}