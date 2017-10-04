<?php
class Controller_Dil extends Controller {

	public function action_degistir()
	{
	   $yenidil = $this->request->param('id');
       Session::instance()->set('lngkisa', $yenidil);
       
       //$ref = $this->request->referrer();
       $base_uri = URL::base();
       
       $this->redirect($base_uri);
	}
}
