<? include("inc_header.php");  ?>
  
<?php if(isset($sayfa)): ?>

	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
				<div class="col-sm-12">
					<? 
                    print $crumbs;
                    ?>
				</div>
                
				<div class="col-sm-12">
					<div class="row">
						
						
                        <!-- sol kolon -->
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divler1">
                            <? include("inc_herisim_menu.php"); ?>
                        </div>
                        <!-- sol kolon bitti-->
                        
                        
                        <div id="divler2" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 altSayfaicerik">
							<div class="col-sm-12 alSayfabaslik">
								<div class="col-sm-9"><?=$sayfa->baslik?></div>
							</div>
							<div class="col-sm-12">
								 <? 
                                preg_match("/^include\(\"(.*)\"/", $sayfa->metin, $metinkontrol);
                  
								if($metinkontrol AND $metinkontrol[1]<>"") include($metinkontrol[1]);
								else 	print html_entity_decode($sayfa->metin);
                                ?>		
							</div>
               
               
               <? if(count($ekler)>0): include("inc_ekgoster.php"); endif; ?>
               
                             
                             <? if(!empty($sayfa->t_galeri_id)): 
                                $count =1;
                                foreach ($sayfa_galeri_fotos as $v) {
                            ?>
                                <? if($count==1): ?>
                                <div class="col-sm-12">
                                  <div class="well">
                                        <strong><a class="fancybox" data-fancybox-group="gallery" href="<?=FILES?>galeri/<?=$v->resim_url?>">
                                        <?=__('foto_tikla')?>
                                        </a></strong>
                                  </div>
                                </div>
                                <? else: ?>
                                <div class="hidden">
                                    <a class="thumbnail fancybox" href="<?=FILES?>galeri/<?=$v->resim_url?>" data-fancybox-group="gallery" title="<?=$sayfa->galeri_adi?>">
                                      <img src="<?=FILES?>galeri/<?=$v->resim_url?>"/>
                                    </a>
                                </div>
                                <? endif; ?>
                            <? $count++; } endif; ?>
                             
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- altsayfa kapsa bitti -->
<? endif; ?>	
    
   	<? include("inc_footer.php"); ?>
    <? include_once("inc_footer_js.php"); ?>


<script>
<? if(!empty($sayfa->t_galeri_id)): ?>    
    $(function () {
        $.fn.fancybox && $('.fancybox').fancybox();    
    });
<? endif; ?>
</script>

</body>
</html>          
	
