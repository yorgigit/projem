<? include("inc_header.php");  ?>

<div class="container box top10 alt20">
	<div class="row kapsa">
		<!-- breadcrumbs baslasi -->
		<div class="col-sm-12">
            <? print $crumbs; ?>
		</div>
		<!-- breadcrumbs bitti -->
					
        <div class="col-lg-12">
            <div class="row">
    					<!-- sol menu alanı basladi -->
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="divler1">
    					   <? include("inc_herisim_menu.php"); ?>			
                        </div>	
    					<!-- sol menu alanı bitti -->
				

					<!-- alt sayfa sag alan basladi -->
					<div id="divler2" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 altSayfaicerik" > <!-- class="col-md-9 col-sm-12 col-xs-12 altSayfaKapsa" -->
					
						<div class="col-sm-12 alSayfabaslik sifirla">
							<div class="col-sm-9"><?=My::strtoupperTR(__('tum_'.$dbtip))?></div>
							<div class="col-sm-3 text-right hidden-xs"><i class="fa fa-archive fa-lg"></i></div>
						</div>
						
                        <?php if(count($kayitlar)>0): ?>
                        
                        <div class="col-sm-12 altsayfaicerik">
                        <div class="row top10">
                        
                        <!-- ARAMA ---------------------------------------------------->
                            <div class="arama_div">
                                <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-4" style="padding-top:5px">
                                    <? if(!empty($filtre)): ?>
                                            <a class="text-danger" href="<?=$tamlink?>" id="resetfrm">Filtreyi Kaldır</a>
                                        <? endif; ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-8">
                                    <?=Form::open("$tamlink?p=1",array('method'=>'post'));?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="filtre" id="filtre" placeholder="<?=__('filtrele_'.$dbtip)?>" value="<?=$filtre?>"/>
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
                            
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                	<tr>
                                		<th></th>
                                		<th><?=__('baslik')?></th>
                                		<th><?=__('yayin_tarihi')?></th>
                                		<? if($dbtip=='duyuru') { ?><th><?=__('son_yayin_tarihi')?></th><? } ?>
                                	</tr>
                                </thead>
                                
                                <tbody>
                                <? 
                                   $count= (($pagination->current_page-1)*$pagination->items_per_page)+1;
                                   foreach ($kayitlar as $v) {
                                    
                                    $v->baslik = str_ireplace($filtre,"<span class=\"arama_vurgula\">$filtre</span>",$v->baslik);
                                ?>
                                	<tr>
                                		<td><?=$count?></td>
                                		<td><a href="<?=url::base().$tamlink.'/'.$v->seourl.'.html'?>"><?=$v->baslik?></a></td>
                                		<td><?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></td>
                                		<? if($dbtip=='duyuru') { ?><td><?=My::tarih_format($v->sonyay_tarihi,'mysqltod')?></td><? } ?>
                                	</tr>
                                <?  $count++; } ?>
                                </tbody>
                            </table>
                            <div class="alert-warning" style="padding: 3px;"><strong><?=__('toplam')?> <?=$pagination->total_items?> <?=__('kayit')?></strong></div>
                            <?=$pagination;?>
                        </div>
                        </div>
                        <? else: print '<div class="col-lg-12 alert alert-danger">'.$ERR['norecord'][$dbtip].'</div>'; ?>
                        
                        <? endif; ?>


					</div>
					<!-- alt sayfa sag alan bitti -->
					
				</div>
			</div>
		</div>
</div>    
   	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>

<script>
    function ara() {
        var ara = $('#ara').val();
        var mevcutara = $('#mevcutara').val();
        
        $.redirect('list-'+adil, {page: pg, ara:ara, mevcutara:mevcutara, dil:adil });
    }
</script>    
</body>
</html>  