<?php

 

class Controller_SiteSearch extends Controller_Site {



    public function before()

    {

        $this->view = "site_search";



        parent::before();

    }

    

    public function action_index()

    {

         $qa = $this->request->query('q');

        

         $this->view

            ->set('q',  $qa);

    }

}