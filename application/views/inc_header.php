<!DOCTYPE html>
<html lang="<?=strtolower($dil).'-'.$dil?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title><?=$ayarlar->site_baslik?></title>
    <meta name="description" content="<?=$ayarlar->site_baslik?>"/>
    <meta name="keywords" content="<?=$ayarlar->anahtar_kelimeler?>"/>
    <meta name="robots" content="index,follow" /> 
    <meta name="googlebot" content="all" />
    <meta name="revisit-after" content="1 Days" />
    <meta name="distribution" content="global" />
    <meta name="rating" content="general" />
    <meta name="author" content="<?=__('comu_yazi')?>" />

    <link rel="shortcut icon" href="<?=ORTAK?>img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?=ORTAK?>img/apple-touch-icon.png">
    <link rel="apple-touch-icon" href="<?=ORTAK?>img/apple-touch-icon-72x72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="<?=ORTAK?>img/apple-touch-icon-114x114.png" sizes="114x114">
    
    <link href="<?=ORTAK?>css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?=TEMA?>css/style.css" rel="stylesheet"/>
    <link id="renk_css" href="<?=TEMA?>css/renk/<?=RENK?>.css" rel="stylesheet"/>
    <link href="<?=ORTAK?>css/font-awesome.min.css" rel="stylesheet"/>
   <link href="<?=ORTAK?>css/dropdown-submenu.css" rel="stylesheet"/>
  
    <?php 
    if(isset($cssjs['css'])) {
        foreach ($cssjs['css'] as $style) {
            if(is_array($style)) {
                echo HTML::style($style[0], ['media' => $style[1]]) . PHP_EOL;
            } else {
                echo HTML::style($style) . PHP_EOL;
            }
        };    
    }
            //özel css varmı?
             if (file_exists("./public/css/ozel.css")) {
                print '<link href="/public/css/ozel.css" rel="stylesheet"/>';
             }
        
            //özel ayarlar varmı?       
            if (file_exists("./public/ozelayar.php")) {
                require './public/ozelayar.php';
             }    
        ?>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <base href="<?=$ayarlarGenel->site_adresi?>"/>
  
  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-<?=$ayarlarGenel->webstats_no?>', 'auto');
      ga('send', 'pageview');

    </script>
    
  </head>
  
  <body>
  
  <!-- ... LOADING ........................................................................-->
    <div id="loading" style="display:none"><div id="mesaj" class='alert alert-info'></div></div>
  <!-- ... LOADING END....................................................................-->

   <div id="boyut"></div>
                    
	<!------------------ header alani basladi ------------------>
	<div class="headerUst">
		<div class="container">
              <div class="col-sm-12 col-xs-12">  
                  
                <div class="row">
                   
                    <? if(count($diller)>0): 
						$yayindaki_dilsayi=0;
					foreach($diller as $d) {
                           if ($dil <> $d->dil_kisa AND $yayindurum[$d->dil_kisa]=='yayinda') { $yayindaki_dilsayi+=1; } } ?>
					
                    <div style="width:<?=(($yayindaki_dilsayi)*80)?>px;" class="div-dil text-right">
                          <?php
                              $i=0;
                                foreach($diller as $d) {
                                    if ($dil <> $d->dil_kisa AND $yayindurum[$d->dil_kisa]=='yayinda') {
									
                                        if($i>0) print '<span class="ustHeaderAyirac">|</span>';
                                        $bayrak = '<img width="22" class="bayrak" alt="'.$d->dil.'" src="'.ORTAK.'img/flags/'.strtolower($d->dil_kisa).'.png"/> '.$d->dil ;
                                        print HTML::anchor("dil/degistir/{$d->dil_kisa}", $bayrak, array('title'=>$d->dil));
                                        $i++;
                                    }
                                }
                          ?>
                    </div>
                    <? endif; ?>
                    
                     <?
                        //arama yanında konacak özel bir buton var mı?
                        if (file_exists("./public/ozelicerik/topbuton.txt")) {
                            include "./public/ozelicerik/topbuton.txt";
                        }
                    ?>
                    <!-- ARAMA ---------------------------------------------------->
                       <div class="div-arama">
                         
                         <?=Form::open("search",array('method'=>'get', 'id' => 'src_form')); ?> 
                            <div class="form-group has-feedback">
                                <input type="search" name="q" id="search" placeholder="<?=__('arayaz')?>"/>
                        	</div>
                        </form>
                        
                        </div>
                    <!------------------------------------------------------------->
                    
					<div class="hidden-lg hidden-md hidden-sm col-xs-3 linkmain text-center"><a href='/'><?=__('menu_mainpage')?></a></div>
                    
            </div>
          </div>
		</div>
	</div>
    
    <div class="header">
		<div class="container">
			<div class="row">
				<div class="siluetHeader"></div>
				<div class="logoAlani">					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
                        
							<?
    						if(@getimagesize(FILES.'foto/logo.png')){
    							
                                $logotitle = (!empty($ozel_ayar_logotitle)) ? $ozel_ayar_logotitle : $ayarlar->site_adi;
    							$logolink = (!empty($ozel_ayar_logolink)) ? $ozel_ayar_logolink : '/';
    							$logotarget = (!empty($ozel_ayar_target)) ? $ozel_ayar_target: '_top';
    							
    							$logo_sol = '<a href="'.$logolink.'" target="'.$logotarget.'" title="'.$logotitle.'"><img class="logo" alt="'.$logotitle.'" src="'.FILES.'foto/logo.png"/></a>';
    							$logo_sag = '<a href="http://www.comu.edu.tr" title="Çanakkale Onsekiz Mart Üniversitesi"><img class="logo" alt="Çanakkale Onsekiz Mart Üniversitesi" src="'.ORTAK.'img/logo.png"/></a>';
    						}else{
    							$logo_sol = '<a href="http://www.comu.edu.tr" title="Çanakkale Onsekiz Mart Üniversitesi"><img class="logo" alt="Çanakkale Onsekiz Mart Üniversitesi" src="'.ORTAK.'img/logo.png"/></a>';
    							$logo_sag = '';
    						}
                            ?>
                            <div class="sol_logo col-lg-2 col-md-2 col-sm-2 col-xs-2"><?=$logo_sol?></div>
    						
    						<div class="logo_yazi col-lg-8 col-md-8 col-sm-8 col-xs-8">
    							<p><?=__('comu_yazi')?><br/><?=$ayarlar->site_adi?></p>
    						</div>
    						
    						<div class="sag_logo col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right"><?=$logo_sag?></div>
	
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------ header alani bitti ------------------>
	<!-- navbar ------------------------------------------------->
    <div class="menufull">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container">		
					<div class="row">
					
						<div class="navbar-header">
							<button id="navbar_mobile_button" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav target-active" style="position: absolute;" >
							  <li class="<? if($busayfa=='Anasayfa') print 'active'; ?>"><a href="/"><?=__('menu_mainpage')?></a></li>
                              
                              <?php if(isset($menuler)): ?>
                              <? 
                                 $count = 1;
                                 foreach ($menuler as $v) { 
                                     
                                     if($v->aktif=='1'):
                                     $altmenu_var = false;
                                     $altmenu_prop = '';
                                     $altmenu_icon = '';
                                     $altmenu_li_cls = '';
                                      
                                     if(count($altmenuler[$v->id])>0) {
                                         $altmenu_var = true;
                                         $altmenu_prop = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"';
                                         $altmenu_icon = '<span id="caret'.$count.'" class="caret"></span>';
                                     }
                                     
                                     $target_main = '';
                                      
                                     if(empty($v->link)) $linkyaz_main = ''; //$v->baslik_seo; //'#';
                                     else { 
                                            if( !preg_match('/^https?:\/\//', $v->link) ) {
                                                        //$linkyaz_main = $v->baslik_seo.'/'.$v->link;
                                                        $linkyaz_main = $v->link;
                                                    }
                                                    else { 
                                                        $linkyaz_main = $v->link;
                                                        $target_main = 'target="_blank"';
                                                    }
                                     }
                                     
                              ?>
                                    <li id="limenu<?=$count?>" <?=$altmenu_li_cls?>><a title="<?=$v->baslik_seo?>" href="<?=$linkyaz_main?>" <?=$target_main?> <?=$altmenu_prop?>><?=$v->baslik?> <?=$altmenu_icon?></a>
                                        <? if($altmenu_var):?>
                                            <ul class="dropdown-menu">
                                            <? foreach ($altmenuler[$v->id] as $am) { 
                                               if($am->aktif=='1'):
                                                $target = '';
                                                if(empty($am->link)) $linkyaz = '#';
                                                else {
                                                    if( !preg_match('/^https?:\/\//', $am->link) ) {
                                                        //$linkyaz = $v->baslik_seo.'/'.$am->baslik_seo.'/'.$am->link;
                                                        $linkyaz = $v->baslik_seo.'/'.$am->link;
                                                    }
                                                    else { 
                                                        $linkyaz = $am->link;
                                                        $target = 'target="_blank"';
                                                    }
                                                }
                                                
                                                ?>
                                                <li><a href="<?=$linkyaz?>" <?=$target?>><?=$am->baslik?></a></li>
                                            <? endif; } ?>
                                            </ul>
                                        <? endif;?>
                                    </li>
                              <? 
                                $count++;
                                endif; 
                              } endif; ?>
							  
                              
                              <li id="gizlimenu">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?=My::strtoupperTR(__('diger'))?> <span class="caret"></span></a>
                                <ul id="gizlimenualt" class="dropdown-menu multi-level">
                                   
                                </ul>
                              </li>
                              
                              
                              <?php if(isset($menuler_sabit)): ?>
                              <? 
                                 foreach ($menuler_sabit as $v) { 
                                     
                                     if($v->aktif=='1'):
                                     $altmenu_var = false;
                                     $altmenu_prop = '';
                                     $altmenu_icon = '';
                                     
                                     if(count($altmenuler_sabit[$v->id])>0) {
                                         $altmenu_var = true;
                                         $altmenu_prop = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"';
                                         $altmenu_icon = '<span class="caret"></span>';
                                     }
                                     
                                     $target_main = '';
                                      
                                     if(empty($v->link)) $linkyaz_main = $v->baslik_seo; //'#';
                                     else $linkyaz_main = $v->link;
                                     
                              ?>
                                    <li class=""><a href="<?=$linkyaz_main?>" <?=$target_main?> <?=$altmenu_prop?>><?=$v->baslik?> <?=$altmenu_icon?></a>
                                        <? if($altmenu_var):?>
                                            <ul class="dropdown-menu">
                                            <? foreach ($altmenuler_sabit[$v->id] as $am) { 
                                               if($am->aktif=='1'):
                                                $target = '';
                                                if(empty($am->link)) $linkyaz = '#';
                                                else {
                                                    $linkyaz = $v->baslik_seo.'/'.$am->link;
                                                    if( preg_match('/^https?:\/\//', $am->link) ) {
                                                        $target = 'target="_blank"';
                                                    }
                                                }
                                                
                                                ?>
                                                <li><a href="<?=$linkyaz?>" <?=$target?>><?=$am->baslik?></a></li>
                                            <? endif; } ?>
                                            </ul>
                                        <? endif;?>
                                    </li>
                              <? endif; } endif; ?>
                              
                              
                              <li class="<? if($busayfa=='Iletisim') print 'active'; ?>"><a href="<?=$slinkler['iletisim']['iletisim'][$dil]?>"><?=__('menu_iletisim')?></a></li>
                            </ul>
                             
                        </div>
                          
                        <div style="display:none; position: absolute;top:0;">
                              <input type="hidden" id="limenusayac" value="<?=$count-1?>"/>
                              <input type="hidden" id="silinen_limenu_adet" value="0"/>
                              <input type="hidden" id="tummenu" value="1"/>
							  <input type="hidden" id="tummenuwdt" value="1"/>
                        </div> 
						
					</div>
				</div>
			</nav>
	</div>
    <!-- navbar bitti------------------------------------------------->     