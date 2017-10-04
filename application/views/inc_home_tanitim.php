<?php if(isset($anatanitim) AND count($anatanitim)>2): ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 AltAlanAyir">
				<div class="row">
                    <?
                        foreach ($anatanitim as $v) {
                            
                        ?>
					<div class="col-md-4 col-sm-4 col-xs-12 mobilAyir">
						<div class="col-item cevre">
							<div class="altAlanResim">
                            <img src="<?=FILES?>/foto/<?=$v->resim_url?>" alt="<?=$v->baslik?>"/></div>
							
							<div class="altAlanicerik">
                                
								<h3><?=$v->baslik?></h3>
                                <div class="icerikdevami">
								    <p><?=$v->metin?></p>
                                    <p class="devami"><a href="#" class="devami_button">Devamını Oku</a></p>
                                </div>
							</div>
						</div>
					</div>
                    <? } ?>
					
				</div>
			</div>
		</div>
	</div>
    
<? endif; ?>    