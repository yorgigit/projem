<?php if(isset($homebutons) AND count($homebutons)>0): ?>

<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="icgolge box">
					<div id="anasayfa_butonlar" class="js no-touch js csstransforms3d js cssanimations csstransforms csstransforms3d csstransitions">
						<nav class="cl-effect-2">
                        <?
                        foreach ($homebutons as $v) {
                        $hedef = (empty($v->target)) ? '_blank':$v->target;
                        ?>
					   <a target="<?=$hedef?>" href="<?=$v->link?>"><span data-hover="<?=$v->baslik?>"><?=$v->baslik?></span></a>
				        <? } ?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
    
<? endif; ?>   