<? include("inc_header.php"); ?>
              <?php if(isset($slider) AND count($slider)>0): ?>
                <!------------------ slider alani basladi ------------------>
					<div class="container">
						<div class="row">
							<div class="container top15 <? if(count($homebutons)==0) print 'alt10';?>">
								<div id="myCarousel<? if($ayarlarGenel->slayt_tur=='tam') print 'Tam'; ?>" class="carousel slide carousel-fade" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								  <div class="carousel-inner">
								  
                                   <? $count = 0;
                                      foreach ($slider as $v) { 
                                      $aktif = ($count==0)? " active":"";
                                      $linkbas = null;
                                      $linkson = null;
                                      $httpekle = null;
                                      $target_main = '';
                                      
                                      if(!empty($v->foto_link)) {
                                            if( !preg_match('/^https?:\/\//', $v->foto_link) AND !preg_match('/^www./', $v->foto_link)) {
                                                        if(!empty($v->foto_link_tip)) $linkdizin = __('arsiv_link').'/'.$slinkler['haberduyuru'][$v->foto_link_tip][$dil]."/".$v->foto_link;
                                                        else $linkdizin = $v->foto_link;
                                                    }
                                                    else { 
                                                        if(preg_match('/^www./', $v->foto_link)) $httpekle = 'http://';
                                                        $linkdizin = $httpekle.$v->foto_link;
                                                        $target_main='target="_blank"';
                                                    }
                                                    $linkbas = '<a '.$target_main.' href="'.$linkdizin.'">';
                                                    $linkson = '</a>';
                                     }

                                    ?>
                                            
                                       	<div class="item<?=$aktif?>">
    									  <?=$linkbas?><img src="<?=FILES?>slider/<?=$v->resim_url?>" style="width:1140px;" alt="<?=$v->foto_baslik?>"/><?=$linkson?>
										  
    									   <? if($ayarlarGenel->slayt_tur=='tam') $cap_cls = 'carousel-caption-tam'; else $cap_cls='carousel-caption'; ?>
										   <div class="<?=$cap_cls?>">
    										<h4><a href="#"><?=$v->foto_baslik?></a></h4>
    									  </div>
										  
    									</div><!-- End Item -->
                                   
                                   <? $count++; } ?>

								  </div><!-- End Carousel Inner -->
								<? if($ayarlarGenel->slayt_tur=='detayli'): ?>
                                <div class="slider-list-panel col-sm-4">
									<ul class="list-group col-sm-12 sifirla">
									 <?   $count = 0;
										  foreach ($slider as $v) { 
										  $aktif = ($count==0)? " active":"";
										?>
										<li id="li<?=$count?>" value="<?=$count+1?>" class="list-group-item<?=$aktif?>" data-target="#myCarousel" data-slide-to="<?=$count?>">
										<div class="slideyazi"><div><?=substr($v->foto_baslik,0,120)?><? if(strlen($v->foto_baslik)>120) print '...'; ?></div></div></li>
										<? $count++; } ?>
									</ul>
                                </div>
								<? endif; ?>
								<!-- Controls -->
								<div class="carousel-controls">
								  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								  </a>
								  <a class="right carousel-control" href="#myCarousel" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								  </a>
								</div>

								</div><!-- End Carousel -->
							</div>
						</div>
					</div>
                    <input type="hidden" id="top_kayan" value="0"/><!-- Yücel tarafından yazıldı -->
				<!------------------ slider alani bitti ------------------>	
                
                <?php endif; ?>
  
<?
    include('inc_anasayfa_butons.php');
?>

<?
    //resimli buton yada slider altında yayınlanacak özel bir içerik var mı?
    if (file_exists("./public/ozelicerik/htmkod.txt")) {
        include "./public/ozelicerik/htmkod.txt";
    }
?>

	<div class="container">
		<div class="col-md-12 box top10 alt20">
			<div class="row">
				<div class="kapsa">
				
					<!-- sol menu alanı basladi -->
                    <div class="col-md-3" id="solfixmenu"> <!-- hidden-sm hidden-xs -->
                    <? include("inc_herisim_menu.php"); ?>
                    </div>
					<!-- sol menu alanı bitti -->
				

					<!-- anasayfa sag alan basladi -->
					<div class="col-md-9 col-sm-12 col-xs-12" id="saghack">
					
                    <?php if(isset($haberler) AND count($haberler)>0): ?>
                    
						<!-- haber basliyor -->
						<div class="haberler">
							<div class="etkinlikbaslik top15">
								<span><?=__('baslik_haberler')?></span>
								<span class="tumu"><i class="fa fa-ellipsis-v iconsag"></i>
                                <a href="<?=__('arsiv_link').'/'.__('tum_haber_link')?>"><?=__('tum_haber')?></a>
                                </span>
							</div>
                            <? 
                                $solcol = (count($haberler)>1)? 6 : 12;
                                $count=0;
                                foreach ($haberler as $v) {
                                    if($count==0) {
                                        if(empty($v->resim_url)) $foto_yaz = ORTAK."img/default_haber.jpg";
                                        else $foto_yaz = FILES."foto/thumb/3thumb-".$v->resim_url;
                                        
                                        $etk = ($v->ozet<>'')?$v->ozet:$v->metin;
                                        $etk_metin = html_entity_decode($etk);
                            ?>
							<div class="col-md-<?=$solcol?> col-sm-<?=$solcol?> col-xs-12" id="solhack">
								<div class="thumbnail">
									<img src="<?=$foto_yaz?>"/>
									<div class="caption">
										<div class="bhaberyazi">
											<a href="<?=url::base().__('arsiv_link').'/'.$slinkler['haberduyuru']['haber'][$dil].'/'.$v->seourl.'.html'?>"><b><?=$v->baslik?></b></a>
                                            <br />
                                            <div class="haber_metin">
                                            <? print substr($etk_metin,0,250); 
    									    if(strlen($etk_metin)>250) print '...';
                                            ?>
                                            </div>
										</div>
											<span class="habersol"><i class="fa fa-clock-o"></i> <?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></span>
											<span class="habersag"><i class="fa fa-bar-chart"></i> <?=$v->okuma?></span>
										</p>
									</div>
								</div>
							</div>
							<? } $count++; } ?>
                            
                            <? if(count($haberler)>1) { ?>
							<div class="col-md-6 col-sm-6 col-xs-12 cevceve top15">
							
                                <?
                                $count=0;
                                foreach ($haberler as $v) {
                                    if(empty($v->resim_url)) $foto_yaz = ORTAK."img/default_haber.jpg";
                                    else $foto_yaz = FILES."foto/thumb/thumb-".$v->resim_url;
                                    if($count>0) {
                                        
                                        $etk = ($v->ozet<>'')?$v->ozet:$v->metin;
                                        $etk_metin = html_entity_decode($etk);
                                ?>
                            
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="row borderHaber top10">
										<img class="khaberresim" src="<?=$foto_yaz?>" alt="<?=$v->baslik?>"/>
										<div class="khaberyazi">
											<a href="<?=url::base().__('arsiv_link').'/'.$slinkler['haberduyuru']['haber'][$dil].'/'.$v->seourl.'.html'?>">
                                            <b><?=$v->baslik?></b>
                                            </a>
                                            <br />
                                                <div class="haber_metin">
                                                    <? print substr($etk_metin,0,100); 
            									    if(strlen($etk_metin)>100) print '...';
                                                    ?>
                                                </div>
                                          </div>
										<p>
											<span class="habersol"><i class="fa fa-clock-o"></i> <?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></span>
											<span class="habersag"><i class="fa fa-bar-chart"></i> <?=$v->okuma?></span>
										</p>
									</div>
								</div>
                                <?
                                    }
                                    $count++;
                                }
                                ?>
							</div>
							<? } ?>
						</div>
						<!-- haber bitti -->
						<? //else: print $ERR['norecord']['haber'];
                                endif; ?>
						
						<!-- Duyuru alani basladi -->
						<div class="duyuru">
							<div class="etkinlikbaslik top15">
								<span><?=__('baslik_duyurular')?></span>
								<span class="tumu"><i class="fa fa-ellipsis-v iconsag"></i>
                                <a href="<?=__('arsiv_link').'/'.__('tum_duyuru_link')?>"><?=__('tum_duyuru')?></a>
                                </span>
							</div>
						</div>
						<div class="duyurular comu_scrool">
						
                        <?php if(isset($duyurular) AND count($duyurular)>0): ?>
        				<ul class="duyuru">
                            <?
                               foreach ($duyurular as $v) {
                                
                                $yeni_res = ($v->yenimi=='1')? ' &nbsp;<span class="yeni_me">'.__('yeni').'</span>':'';
                            ?>
        					<li>
                                <p>
                                <?=$yeni_res?>
        						<a href="<?=url::base().__('arsiv_link').'/'.$slinkler['haberduyuru']['duyuru'][$dil].'/'.$v->seourl.'.html'?>">
                                <i class="fa fa-caret-right kirmizi"></i> <?=$v->baslik?></a>
                                </p>
                                <span class="pull-right"><i class="fa fa-calendar"></i> <?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></span>
                                
        					</li>
        					<? } ?>
        				</ul>
                        <? else: 
                              print "<div class='col-md-12'>".$ERR['norecord']['duyuru']."</div>";
                         endif; ?>
                         
						</div>
						<!-- duyuru alani bitti -->
						
						
                        
                        <?php if(isset($etkinlikler) AND count($etkinlikler)>0): ?>
                        <!-- Duyuru alani basladi -->
						<div class="duyuru">
								<div class="etkinlikbaslik top15">
									<span><?=__('baslik_etkinlikler')?></span>
									<span class="tumu"><i class="fa fa-ellipsis-v iconsag"></i>
                                    <a href="<?=__('arsiv_link').'/'.__('tum_etkinlik_link')?>"><?=__('tum_etkinlik')?></a>
                                    </span>
								</div>
						</div>
                        
						<div class="box_etkinlikler">

        				<ul class="duyuru">
                            <?
                               foreach ($etkinlikler as $v) {
                            ?>
        					<li>
                                <p>
        						<a href="<?=url::base().__('arsiv_link').'/'.$slinkler['haberduyuru']['etkinlik'][$dil].'/'.$v->seourl.'.html'?>">
                                <i class="fa fa-caret-right kirmizi"></i> <?=$v->baslik?></a>
                                </p>
                                <span class="pull-right date_etkinlik"><i class="fa fa-calendar"></i> <?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></span>
                                
        					</li>
        					<? } ?>
        				</ul>

						</div>
						<!-- duyuru alani bitti -->
                        <? endif; ?>
                       
			
					</div>
					<!-- anasayfa sag alan bitti -->
					
					
					
				
				</div>
			</div>
		</div>
	
	</div>
    

    <? //include("inc_home_tanitim.php"); ?>


    <?
    /*
    * Eğer ana sayfa galeri ayarı açık ise galeri sayfası include edilir.
    */
    //if($ayarlar->anasayfa_galeri=="acik") include("inc_home_galeri.php");
    ?>


<?php if(isset($popup) AND !empty($popup)):  ?>
<!--  MODAL PENCERE -->
 <div class="modal fade popupModal" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" >
         <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
           <div class="modal-body">
           <? 
                if($popup->resim_url<>'') print '<img src="'.FILES.'foto/'.$popup->resim_url.'" alt="popup"/>'; 
                if($popup->resim_url<>'' AND $popup->metin<>'')  print '<br><br>';
                if($popup->metin<>'') print html_entity_decode($popup->metin); 
           ?>
           </div>
         </div>
  </div>
</div>                             
 <!-- MODAL PENCERE END -->
<? endif; ?>


<?php if(isset($popupGenel) AND !empty($popupGenel)):  ?>
<!--  MODAL PENCERE -->
 <div class="modal fade popupModal" id="popupModalGenel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" >
         <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
           <div class="modal-body">
           <? 
                if($popupGenel->resim_url<>'') print '<img src="'.$popupGenel->resim_url.'" alt="popup"/>'; 
                if($popupGenel->resim_url<>'' AND $popupGenel->metin<>'')  print '<br><br>';
                if($popupGenel->metin<>'') print html_entity_decode($popupGenel->metin); 
           ?>
           </div>
         </div>
  </div>
</div>                             
 <!-- MODAL PENCERE END -->
<? endif; ?>

	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>


<script>

$(function() {
        
    <?php if(isset($popup) AND !empty($popup)): 
        
        if($popup->tekrar_zaman==0) $cookie_expires='99999999999';
        else $cookie_expires= intval($popup->tekrar_zaman) * 60;
        
        $ekran_zaman = intval($popup->kalma_suresi)*1000;
    ?>
		//$.cookie("pop<?=$popup->id?>", null, {expires: -1});
    
        if($.cookie('pop<?=$popup->id?>') == null)
        {
            var yasam_zaman = new Date();
            yasam_zaman.setTime(yasam_zaman.getTime() + (<?=$cookie_expires?> * 1000));
            $.cookie('pop<?=$popup->id?>', '<?=$popup->id?>', {expires: yasam_zaman});
        
            $("#popupModal").modal('show');
            $('#popupModal').on('shown.bs.modal', function (e) {
                  setTimeout("$('#popupModal').modal('hide')",<?=$ekran_zaman?>);
            });
       }
    <? endif;?>
 
	<?php if(isset($popupGenel) AND !empty($popupGenel)): 
        
        if($popupGenel->tekrar_zaman==0) $cookie_expires='99999999999';
        else $cookie_expires= intval($popupGenel->tekrar_zaman) * 60;
        
        $ekran_zaman = intval($popupGenel->kalma_suresi)*1000;
    ?>
		//$.cookie("popGenel<?=$popupGenel->id?>", null, {expires: -1});
    
        if($.cookie('popGenel<?=$popupGenel->id?>') == null)
        {
            var yasam_zaman = new Date();
            yasam_zaman.setTime(yasam_zaman.getTime() + (<?=$cookie_expires?> * 1000));
            $.cookie('popGenel<?=$popupGenel->id?>', '<?=$popupGenel->id?>', {expires: yasam_zaman});
        
            $("#popupModalGenel").modal('show');
            $('#popupModalGenel').on('shown.bs.modal', function (e) {
                  setTimeout("$('#popupModalGenel').modal('hide')",<?=$ekran_zaman?>);
            });
       }
    <? endif;?>
 

    $(".comu_scrool").customScroll({ scrollbarWidth: 5 });

<? 
    $yukduy=0;
    if(count($duyurular)==0) { $yukduy=40; }
    elseif(count($duyurular)<5) { $yukduy = count($duyurular)*60; }
    if($yukduy>0) {
?>
    $(".phancy-scroller").height('<?=$yukduy?>px');
<? } ?>

<? if(isset($etkinlikler) AND count($etkinlikler)>0): 
    $yuketk = count($etkinlikler)*60;
?>
    $(".box_etkinlikler").height('<?=$yuketk?>px');

    /*
    $("#owl-demo").owlCarousel({
	  navigation : true,
	  slideSpeed : 300,
	  paginationSpeed : 400,
	  singleItem : true,
      autoPlay : 4000,
      stopOnHover : true
  });
  
  $('#custom_carousel').on('slide.bs.carousel', function (evt) {
      $('#custom_carousel .controls li.active').removeClass('active');
      $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    });
    */
<? endif; ?>    
    //---
    
<?php if(isset($slider) AND count($slider)>0): ?>
    
    var clickEvent = false;
    
    $('#top_kayan').val('0');
    
	$('#myCarousel').carousel({
		interval:   4000	
    }).on('click', '.list-group li', function() {
            clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');
            
            //---yücel tarafından yazıldı -------------------------
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			var yukseklik_kaydir = current.height()+18;
			var id = parseInt(current.data('slide-to'));
			
			if(current.val()==1 && id!=0) {
				$('.list-group').animate({top: "+="+yukseklik_kaydir }, 500, function() {	sira_kaydir(count,-1)  });
				var top_kayanval = parseFloat($('#top_kayan').val())-yukseklik_kaydir;
				$('#top_kayan').val(top_kayanval);
			}
			else if($(this).val()>5 && count!=id) { //id>=5 && $('#li'+count).val()>6 
				$('.list-group').animate({top: "-="+yukseklik_kaydir }, 500, function() {	sira_kaydir(count,1)  });
				var top_kayanval = parseFloat($('#top_kayan').val())+yukseklik_kaydir;
				$('#top_kayan').val(top_kayanval);
			}
			//-------------------------------------------------------------------------------
            	
    }).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
            
            //---yücel tarafından yazıldı--------------------------------------------------
            var yukseklik_kaydir = current.height()+19;
			if(id>=4 && count-1!=id && count!=id) {
				$('.list-group').animate({top: "-="+yukseklik_kaydir }, 500, function() {	sira_kaydir(count,1)  });
				var top_kayan = parseFloat($('#top_kayan').val())+yukseklik_kaydir;
				$('#top_kayan').val(top_kayan);
			}
			else if(id==0 || count==id) {
				$('.list-group').animate({top: "+="+$('#top_kayan').val() }, 500, function() {	sira_kaydir(count,0)  });
				$('#top_kayan').val(0);
			}
			//-----------------------------------------------------------------------------
            
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
  
  //yücel tarafından yazıldı -----------------------------
  function sira_kaydir(adet,sifirla) {
		if(sifirla!=0) {
			for(var i=0;i<=adet;i++) {
				$('#li'+i).val($('#li'+i).val()-sifirla);
				
			}
		}
		else {
			for(var i=0;i<=adet;i++) {
				$('#li'+i).val(i+1);
			}
		}
		return;
	}
  //------------------------------------------------------------------
<? endif; ?>
    
    <?php if(isset($anatanitim) AND count($anatanitim)>2): ?>
    
            var $el, $ps, $up, totalHeight;			
			$(".devami_button").click(function() {						
				totalHeight = 0			
					$el = $(this);
					$p  = $el.parent();
					$up = $p.parent();
					$ps = $up.find("p:not('.devami')");
					$ps.each(function() {
					totalHeight += $(this).outerHeight();
				});
				$up
					.css({
						"height": $up.outerHeight(),
						"max-height": 9999
					})
					.animate({
						"height": totalHeight
					});
				$p.fadeOut();
				return false;
					
			});
    
    <? endif; ?>
    
    (function blink() { 
      $('.yeni_me').fadeOut(700).fadeIn(700, blink); 
    })(); 
    
});
</script>


  </body>
</html> 