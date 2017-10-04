<?php

class Controller_FileView extends Controller_Site {



    public function before() {

        

        $this->view='fileViewer/fileViewer';

        parent::before();

    } 

    

	public function action_index()

	{

        $fname = $this->request->post('fname');

        $this->view->set('fname',  $fname);

	}

}

