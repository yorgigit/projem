<?php
 
class Controller_Mesaj extends Controller {

    public function action_index()
    {
        if ($this->request->method() == "POST") {
            
            $rsp = array();
            $session = Session::instance();
            $gettoken = $session->get('frmkey');
            $frm_token = $this->request->post('token');
            $err = Kohana::message('Hatalar', $session->get('lngkisa'));
            
            if(Captcha::valid($this->request->post('captcha')) AND $gettoken == $frm_token) {
                
                    $session->set('frmkey',''); // form key sıfırlanır

                    $ayarlarGenel  = Model::factory('AyarlarGenel')->get();
                    $gidecek_eposta = $ayarlarGenel[0]->eposta_adres; 
                    
                    if(!empty($gidecek_eposta)) { 
                        // Ayarlar_genel tablosunda kayıtlı Eposta Adresine gönderilir.
                        $sonuc = Model::factory('Mesaj')->send($this->request->post(), $gidecek_eposta);
                    }
                    else  { 
                        // DB'ye Kayıt yapılır. Panelde gözükür.
                        $sonuc = Model::factory('Mesaj')->savemsg($this->request->post());
                    }
                    
                    
                    if($sonuc['durum']) {
                            $rsp['durum'] = true;
                            $rsp['msg'] = $err['mesaj']['send'];
                    }         
                    
            } else {
                     $rsp['durum'] = false;
                     $rsp['msg'] = $err['mesaj']['nosend'];                
            }
            
                $this->response->body(json_encode($rsp));
            
        }
    }
    
}