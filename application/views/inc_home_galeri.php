<?php if(count($galeriler)>0): ?>

<div class="galeritum_div">        
        <div class="container">
			<div class="row etkinlikAyir">
            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
				<div class="col-lg-3 col-md-3 col-sm-8 col-xs-7">
    				<div class="row">
                        <div class="galeriBaslik">
    				        <span><?=__('baslik_galeri')?></span>
                        </div>
    				</div>	
				</div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                    <div class="row">
    						<span class="haberTumu">
    							<a href="<?=__('tum_galeri_link')?>"><?=__('tum_galeri')?></a>
    						</span>
                     </div>
				</div>
            </div>      
			</div>
	   </div>
        <div class="home_div_galeri">
            <div class="container">
    		<div class="row">
    			<div class="col-sm-12 AltAlanAyir">
    				<div class="row">
                        <?
                        $i=1;
                        foreach ($galeriler as $v) {
                        if($i==4) $sonclass="hidden-lg hidden-md hidden-sm col-xs-6"; else $sonclass="col-lg-4 col-md-4 col-sm-4 col-xs-6";
                        ?>
						<div class="<?=$sonclass?> mobilAyir">
							<div class="gridhover"> <!-- galeri_cerceve -->
							<!--
                            <ul class="grid cs-style-3">
									<li>
									<figure>
									<img src="<?=FILES?>galeri/<?=$v->resim_url?>" alt="<?=$v->baslik_seo?>"/>
									<figcaption>
										<h3><?=$v->kategori_adi?></h3>
										<span></span>
										<a href="<?=$slinkler['galeriler']['galeriler'][$dil]?>/<?=$v->baslik_seo?>"><?=__('goster')?></a>
									</figcaption>
									
									</figure>
    								</li>
                            </ul>
                            -->
                            
                                <figure class="effect-apollo">
        						<img src="<?=FILES?>galeri/<?=$v->resim_url?>" alt="<?=$v->baslik_seo?>"/>
        						<figcaption>
        							<h4><?=html_entity_decode($v->kategori_adi)?></h4>
        							<a href="<?=$slinkler['galeriler']['galeriler'][$dil]?>/<?=$v->baslik_seo?>"><?=__('goster')?></a>
        						</figcaption>			
        					     </figure>
							</div>	
    					</div>
                        <? $i++; } ?>
    				</div>
    			</div>
    		</div>
            </div>
        </div>
</div>
<? endif; ?>