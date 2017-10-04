<? include("inc_header.php");  ?>
	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
				<div class="col-sm-12">
					<? print $crumbs; ?>
				</div>
                
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="row">
                        <!-- sol kolon -->
                        <div class="col-md-3 hidden-sm hidden-xs" id="solhack">
                    <? include("inc_herisim_menu.php"); ?>
                    
                        <?php if(isset($galeriler)): ?>
    							<div class="col-sm-12 digerHaberBaslik sifirla hidden-xs ustAyir">
    								<i class="fa fa-picture-o"></i> <?=__('son_galeriler')?>
    							</div>
    							<div class="col-sm-12 hidden-xs">
    								<div class="row">
                                        <?
                                            foreach ($galeriler as $v) {
                                        ?>
    									<div class="digerhaber">
    										<a class='thumbnail' href="<?=$slinkler['galeriler']['galeriler'][$dil]?>/<?=$v->baslik_seo?>">
                                            <img class="digerHaberResim" src="<?=FILES?>galeri/<?=$v->resim_url?>" alt=""/>
                                            
                                            <?=$v->kategori_adi?></a>
    									</div>
                                        <? } ?>
    								</div>
    							</div>
                         <? endif; ?> 
                        </div>
                        <!-- sol kolon bitti-->
                        
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <?php if(isset($galerifotos)){ ?>
                              <div class="col-sm-12 alSayfabaslik sifirla">
								<div class="col-sm-10"><?=My::strtoupperTR($baslik)?></div>
                                <div class="col-sm-2 text-right hidden-xs"><i class="fa fa-camera fa-lg"></i></div>
						      </div>
                            <?
                            if(count($galerifotos)>0):
                                $cc=0;
                                foreach ($galerifotos as $v) {
                            ?>
                            
                            <? if($cc==0) { ?>
                            <div class="col-sm-12 alert alert-warning"><i class="fa fa-calendar"></i> <?=My::tarih_format($v->eklenme_tarihi,'mysqltod')?></div>
                            <? } ?>
                            
        						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <a class="thumbnail fancybox" href="<?=FILES?>galeri/<?=$v->resim_url?>" data-fancybox-group="gallery" title="<?=$baslik?>">
    									<img src="<?=FILES?>galeri/<?=$v->resim_url?>"/>
                                    </a>
            					</div>
                                <? $cc++; } ?>
                            <? else: print '<div class="col-lg-12 alert alert-danger">'.$ERR['norecord']['foto'].'</div>'; ?>
                            <? endif; ?>
                            <? }?>
                        </div>
							
					</div>
				</div>
			</div>
		</div>

	<!-- altsayfa kapsa bitti -->
	
   	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>

<script>
    $(function () {
        $.fn.fancybox && $('.fancybox').fancybox();    
    });
</script>
     
</body>
</html>  