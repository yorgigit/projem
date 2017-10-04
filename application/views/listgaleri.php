<? include("inc_header.php");  ?>
	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
				<div class="col-sm-12">
					<? print $crumbs; ?>
				</div>
                
				<div class="col-sm-12">
					<div class="row">
                    
						
						<!-- sol kolon -->
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divler1"> <!-- col-md-3 hidden-sm hidden-xs -->
                            <? include("inc_herisim_menu.php"); ?>
                        </div>
                        <!-- sol kolon bitti-->
                    
						
						
						<div id="divler2" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        

                        <div class="col-sm-12 alSayfabaslik">
                                <div class="col-sm-10"><?=My::strtoupperTR($tip)?></div>
                                <div class="col-sm-2 text-right hidden-xs"><i class="fa fa-picture-o fa-lg"></i></div>
                        </div>
						                              
                            <?php if(count($galeriler)>0): ?>

                           
                            <!-- ARAMA ---------------------------------------------------->
                            <div class="arama_div">
                                <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-4" style="padding-top:5px">
                                    <? if(!empty($filtre)): ?>
                                            <a class="text-danger" href="<?=$tip?>" id="resetfrm"><?=__('tum_galeri')?></a>
                                        <? endif; ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-8">
                                    <?=Form::open("$tip?p=1",array('method'=>'post'));?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="filtre" id="filtre" placeholder="<?=__('filtrele_galeri')?>" value="<?=$filtre?>"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" id="ara-button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <!-- ----------------------------------------------------------->
                            

                            <?
                            //$count= (($pagination->current_page-1)*$pagination->items_per_page)+1;
                            
                            foreach ($galeriler as $v) {
                                if(!empty($v->resim_url)) $gal_onizle = FILES.'/galeri/'.$v->resim_url;
                                else $gal_onizle = ORTAK.'img/default_galeri.jpg';
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mobilAyir">
                              <div class="thumbnail">
                                <div class="galeritarih"><i class="fa fa-calendar"></i> <?=My::tarih_format($v->eklenme_tarihi,'mysqltod')?></div>
                                <img class="galeri-img" src="<?=$gal_onizle?>"/>
                                <div class="caption">
                                <p><? print substr($v->kategori_adi,0,80); if(strlen($v->kategori_adi)>80) print '...'; ?>
                                </p>
                                
                                <a class="btn btn-danger btn-md btn-block" href="<?=$slinkler['galeriler']['galeriler'][$dil]?>/<?=$v->baslik_seo?>">
                                <?=__('goster')?>
                                </a>
                              </div>
                              </div>
                              </div>
        					<? } ?>
                             <div class="col-xs-12 alert-warning" style="padding: 3px;"><?=__('toplam')?> <strong><?=$pagination->total_items?></strong> <?=__('adet')?> <?=__('bread_galeri')?></div>
                             <div class="col-xs-12"><?=$pagination;?></div>
                                
                            <? else: print '<div class="col-lg-12 alert alert-danger">'.$ERR['norecord']['galeri'].'</div>'; ?>
        					
                  <? endif;?>
                        
                    </div>
							
						
					</div>
				</div>
			</div>
		</div>
	<!-- altsayfa kapsa bitti -->
	
   	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>


                              
    
</body>
</html>  