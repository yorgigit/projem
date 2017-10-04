<?php if(isset($baglantilar['BaglantilarBtn'])): ?>
<!------------------ bahlantilar alani basladi ------------------>
		<div class="row sifirla">
			<div class="container">
				<div class="baglanti_alani yukari20">
					<p><?=__('baglantilar_txt')?></p>
				</div>
				<div class="baglanti_linkler">
					<ul class="baglanti_linksira">
                    <?
                        foreach($baglantilar['BaglantilarBtn'] as $key => $val){
                         print '<li><a href="'.$val.'" target="_blank">'.$key.'</a></li>';
                        }
                    ?>
                    
					</ul>
				</div>
			</div>
		</div>
		<!------------------ bahlantilar alani bitti ------------------>
<? endif; ?>        