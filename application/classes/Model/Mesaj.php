<?php

class Model_Mesaj extends Model
{
    
    public function send($post, $gidecek_eposta) {
        
        //    $post['gonderen'],$post['eposta'], $post['konu'], $post['message'], date('Y-m-d H:i:s'), $ip
        
        $sonuc['durum'] = false;
        try {
            $sender_eposta = "noreply@comu.edu.tr";
            $sender_pass = self::EpostaInfo(); 
                       
            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                ->setUsername($sender_eposta)
                ->setPassword($sender_pass);
    
            // Create the Mailer using your created Transport
            $mailer = Swift_Mailer::newInstance($transport);
            
            // Create a message
            $body = '<b>Gönderen:</b>'.$post['gonderen'].'<br>'.
                    '<b>Eposta :</b><a href="mailto:'.$post['eposta'].'">'.$post['eposta'].'</a><br><br>'.
                    '<b>Konu :</b>'.$post['konu'].'<br><br>'.
                    '<b><u>Mesaj :</u></b><br><br>'.nl2br($post['message']).'<br><br>'.
                    '<font size="1">Gönderilme Zamanı:'.date('Y-m-d H:i:s').'</font><br><br><br>'.
                    '<font color="red">Lütfen bu mesajı aşağıdaki YANITLA ile yanıtlayınız!</font>'.
                    '<a href="mailto:'.$post['eposta'].'"><h1>YANITLA</h1></a>';
            
            $message = Swift_Message::newInstance('İletişim Formu Mesajı')
            ->setFrom(array($sender_eposta => 'ÇOMÜ - WEB | CMS'))
            ->setTo(array($gidecek_eposta))
            ->addPart($body, 'text/html');
            //->setBody($post['message']);
            
            // Send the message
            $result = $mailer->send($message);
            $sonuc['durum'] = true;
        } catch(Swift_TransportException $e) {
            $sonuc['durum'] = $e->getMessage();
        }
       return $sonuc;
    }    
    
     public function savemsg($post) {
        
        $sonuc['durum'] = false;
        $sonuc['eklenen'] = null;
        
         try {
            $ip = My::ipno();
     
            $insert =  DB::insert('mesajlar',array('gonderen', 'gonderen_eposta', 'konu', 'mesaj', 'zaman', 'ip'))
                    ->values(array($post['gonderen'],$post['eposta'], $post['konu'], $post['message'], date('Y-m-d H:i:s'), $ip));
            
            list($insert_id, $affected_rows) = $insert->execute();

            $sonuc['durum'] = true;
            $sonuc['eklenen'] = $insert_id;
            
          } catch ( Database_Exception $e ) {   
              $sonuc['durum'] = $e->getMessage();
          } 
        
        return $sonuc;
    }
    
    public function EpostaInfo()
    {
        $us = "NoreplyUser";
		$ps = "Bi3xQNoreplyPass45Q";
        $ortak = Kohana::$config->load('site.ortak');
        $pss = Curl::get_content_protected($ortak.'/json/noreply/no.reply', $us, $ps);
        return base64_decode($pss);
    } 
}