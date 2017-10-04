<? include("inc_header.php");  ?>
  
<?php if(isset($haber)): ?>

<div class="container box top10 alt20">
    <div class="row kapsa">
				
        <!-- breadcrumbs baslasi -->
        <div class="col-sm-12">
            <? print $crumbs; ?>
        </div>
					<!-- breadcrumbs bitti -->
        <div class="col-sm-12">
            <div class="row">
					<!-- sol menu alanı basladi -->
                    
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divler1">
                    <? include("inc_herisim_menu.php"); ?>
                    
                    
                            <?php if(isset($haberson3)): ?>
        							<div class="col-sm-12 digerHaberBaslik sifirla hidden-xs ustAyir">
        								<i class="fa fa-newspaper-o"></i> <?=__('son')?> <?=$menu_baslik?> 
        							</div>
        							
                                    <?
                                        foreach ($haberson3 as $v) {
                                    ?>
        									<div class="col-lg-12 col-md-12 col-sm-12 hidden-xs digerhaber">
                                            <div class="row">
                                                <a class='thumbnail' href="<?=url::base().$amenu.'/'.$tip.'/'.$v->seourl.'.html'?>">
        										<? if($v->resim_url<>""): ?>
                                                <img class="digerHaberResim hidden-sm" src="<?=FILES?>foto/<?=$v->resim_url?>" alt=""/>
                                                <? endif; ?>
                                                <?=$v->baslik?>
                                                </a>
        									</div>
                                            </div>
                                            <? } ?>
        							
                            <? endif; ?> 
                   </div>
					<!-- sol menu alanı bitti -->
				

					<!-- alt sayfa sag alan basladi -->
					<div id="divler2" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 altSayfaicerik">
					
						<div class="col-sm-12 alSayfabaslik sifirla">
							<div class="col-sm-9"><?=$haber->baslik?></div>
							<div class="col-sm-3 text-right hidden-xs"><i class="fa fa-calendar"></i> <?=My::tarih_format($haber->yayin_tarihi,'mysqltod')?></div>
						</div>
						
						<div class="col-sm-12 altSayfaicerik">
							<div class="row">
								<? if($haber->ozet<>""):?>
                                    <p class="haberOzet"><?=$haber->ozet?></p>
                                <? endif;?>	
                                    
                                <? if($haber->resim_url<>''):?>			 
                                    <img src="<?=FILES?>foto/<?=$haber->resim_url?>"/>
                                <? endif; ?>
                  
							     <?=html_entity_decode($haber->metin)?>
							</div>
						</div>
                        
						 <? if(count($ekler)>0): include("inc_ekgoster.php"); endif; ?>
                         
                         <? if(!empty($haber->t_galeri_id)): 
                                $count =1;
                                foreach ($haber_galeri_fotos as $v) {
                            ?>
                                <? if($count==1): ?>
                                <div class="col-sm-12">
    								<div class="alert alert-warning ustAyir">
    									<strong><a class="fancybox" data-fancybox-group="gallery" href="<?=FILES?>galeri/<?=$v->resim_url?>">
                                        <i class="fa fa-picture-o fa-2x"></i> <?=__($dbtip.'_foto_tikla')?>
                                        </a></strong>
    								</div>
    							</div>
                                <? else: ?>
        						<div class="hidden">
                                    <a class="thumbnail fancybox" href="<?=FILES?>galeri/<?=$v->resim_url?>" data-fancybox-group="gallery" title="<?=$haber->galeri_adi?>">
    									<img src="<?=FILES?>galeri/<?=$v->resim_url?>"/>
                                    </a>
            					</div>
                                <? endif; ?>
                            <? $count++; } endif; ?>
                            
						
                            <div class="col-sm-12">	
                            <div class="row">&nbsp;</div>
								<div class="well"> 
								   <div class="row omb_socialButtons">
									<div class="col-sm-4 col-xs-4"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$uri?>" class="btn btn-sm btn-block omb_btn-facebook share"><i class="fa fa-facebook"></i> <?=__('paylas')?></a></div>
									<div class="col-sm-4 col-xs-4"><a target="_blank" href="https://twitter.com/intent/tweet?text=<?=$haber->baslik?>&amp;url=<?=$uri?>" class="btn btn-sm btn-block omb_btn-twitter share"><i class="fa fa-twitter"></i>  <?=__('paylas')?></a></div>	
									<div class="col-sm-4 col-xs-4"><a target="_blank" href="https://plus.google.com/share?url=<?=$uri?>" class="btn btn-sm btn-block omb_btn-google share"><i class="fa fa-google-plus"></i>  <?=__('paylas')?></a></div>	
								   </div>
								</div>
							</div>
                        
					</div>
					<!-- alt sayfa sag alan bitti -->
		    </div>
        </div>			
    </div>
</div>
	
<? endif; ?>	
    
   	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>
    

<script>
<? if(!empty($haber->t_galeri_id)): ?>    
    $(function () {
        $.fn.fancybox && $('.fancybox').fancybox();    
    });
<? endif; ?>
</script>

    
</body>
</html>          
	
