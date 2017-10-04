
	<div class="nav-side-menu">
		<div class="brand box"> <i class="glyphicon glyphicon-th-list"></i> <?=__('menu_herisim')?></div>
			<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
		<div class="menu-list">
			<ul id="menu-content" class="menu-content collapse out target-active">
                
                <!--<li><a href="#"><i class="fa fa-caret-right fa-lg"></i> <?=__('menu_mainpage')?></a></li>-->
        <?php if(isset($menuler)): ?>
                            
          <? $count = 0;
               foreach ($menuler as $v) { 
                   
                   if($v->herisim=='1'):
                   $altmenu_var = false;
                   $altmenu_prop = '';
                   $target_main = '';
                   $linkyaz_main = '';
                   $altmenu_icon = '';
                   
                   if(count($altmenuler[$v->id])>0) {
                       $altmenu_var = true;
                       $linkyaz_main = 'javascript:;';
                       $altmenu_prop = 'data-toggle="collapse" data-target="#'.$v->baslik_seo.'" class="collapsed"';
                      // $menu_yazi = '<a title="'.$v->baslik_seo.'"><i class="fa fa-caret-right fa-lg"></i> '.$v->baslik.'<span class="arrow"></span></a>';
                       $altmenu_icon = '<span class="arrow"></span>';
                   }
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
                  <li <?=$altmenu_prop?>>
                  <i class="fa fa-caret-right fa-lg hmenu_ok_ana"></i>
                  <a class="hmenu_ana_a" href="<?=$linkyaz_main?>" <?=$target_main?> title="<?=$v->baslik_seo?>"><?=$v->baslik?></a>
                  <?=$altmenu_icon?>
                  </li>
                      <? if($altmenu_var):?>
                          <ul class="sub-menu collapse" id="<?=$v->baslik_seo?>">
                          <? foreach ($altmenuler[$v->id] as $am) { 
                             if($am->herisim=='1'):
                              $target = '';
                              $linkyaz = '#';
                            
                                if(!preg_match('/^https?:\/\//', $am->link)) {
                                    //$linkyaz = $v->baslik_seo.'/'.$am->baslik_seo.'/'.$am->link;
                                    $linkyaz = $v->baslik_seo.'/'.$am->link;
                                }
                                else { 
                                    $linkyaz = $am->link;
                                    $target = 'target="_blank"';
                                }
                                /*
                                  if(empty($am->link)) $linkyaz = '#';
                                  else {
											if( preg_match('/^https?:\/\//', $am->link) ) {
												$target = 'target="_blank"';
												$linkyaz = $am->link;
											}
											else $linkyaz = $v->baslik_seo.'/'.$am->link;
                                  }
                              */
                              ?>
                              <li><i class="fa fa-caret-right hmenu_ok"></i><a href="<?=$linkyaz?>" <?=$target?>><?=$am->baslik?></a></li>
                          <? endif; } ?>
                          </ul>
                      <? endif;?>
                  
          <?  endif; } endif; ?>
          
		  
          
          <?php if(isset($menuler_sabit)): ?>
          <? 
             foreach ($menuler_sabit as $v) { 
                 
                 if($v->herisim=='1'):
                   $altmenu_var = false;
                   $altmenu_prop = '';
                 
                 if(count($altmenuler_sabit[$v->id])>0) {
                     $altmenu_var = true;
                     $altmenu_prop = 'data-toggle="collapse" data-target="#'.$v->baslik_seo.'" class="collapsed"';
                     $menu_yazi = '<i class="fa fa-caret-right fa-lg hmenu_ok_ana"></i><a class="hmenu_ana_a" title="'.$v->baslik_seo.'">'.$v->baslik.'</a><span class="arrow"></span>';
                 }
				 else { $menu_yazi = '<a href="'.$v->link.'" '.$target_main.'><i class="fa fa-caret-right fa-lg"></i> '.$v->baslik.'</a>';
                 }
          ?>
                <li <?=$altmenu_prop?>><?=$menu_yazi?></li>
                    <? if($altmenu_var):?>
                        <ul class="sub-menu collapse" id="<?=$v->baslik_seo?>">
                        <? foreach ($altmenuler_sabit[$v->id] as $am) { 
                           if($am->herisim=='1'):
                            $target = '';
                            if(empty($am->link)) $linkyaz = '#';
                            else {
                                $linkyaz = $v->baslik_seo.'/'.$am->link;
                                if( preg_match('/^https?:\/\//', $am->link) ) {
                                    $target = 'target="_blank"';
                                }
                            }
                            ?>
                            <li><i class="fa fa-caret-right hmenu_ok"></i><a href="<?=$linkyaz?>" <?=$target?>><?=$am->baslik?></a></li>
                        <? endif; } ?>
                        </ul>
                    <? endif;?>
          <? endif; } endif; ?>
          
	 <li class=""><a href="<?=$slinkler['iletisim']['iletisim'][$dil]?>"><i class="fa fa-caret-right fa-lg"></i> <?=__('menu_iletisim')?></a>
	</li>
    
			</ul>
		 </div>
	</div>