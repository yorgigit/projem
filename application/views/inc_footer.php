<div class="beyazBg">	
     
     <? include('inc_baglantilar.php'); ?>
     
    <!------------------ footer alani basladi ------------------>
		<footer class="foobar">
			<div id="footerlogo"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php if(isset($baglantilar['Ogrenci'])): ?>
                        <div class="footer-widget">
							<h4 class="footer-baslik">ÖĞRENCİ</h4>
							<ul class="list-links">
                            <?
                                foreach($baglantilar['Ogrenci'] as $key => $val){
                                 print '<li><a href="'.$val.'" target="_blank">'.$key.'</a></li>';
                                }
                            ?>
							</ul>
						</div>
                        <? endif; ?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
                        <?php if(isset($baglantilar['KampusYasam'])): ?>
						<div class="footer-widget">
							<h4 class="footer-baslik">KAMPÜSTE YAŞAM</h4>
							<ul class="list-links">
							<?
                                foreach($baglantilar['KampusYasam'] as $key => $val){
                                 print '<li><a href="'.$val.'" target="_blank">'.$key.'</a></li>';
                                }
                            ?>
						  </ul>
						</div>
                        <? endif; ?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
                        <?php if(isset($baglantilar['Baglantilar'])): ?>
						<div class="footer-widget">
							<h4 class="footer-baslik"><?=__('baglantilar_txt')?></h4>
							<ul class="list-links">
							<?
                                foreach($baglantilar['Baglantilar'] as $key => $val){
                                 print '<li><a href="'.$val.'" target="_blank">'.$key.'</a></li>';
                                }
                            ?>
							</ul>
						</div>
                        <? endif; ?>
					</div>
					<? 
              $tel1 = $faks = $eposta = $face = $twit = $youtube = $gplus = NULL;
					if(!empty($iletisim)) {
              $tel1 = $iletisim->tel1;
              $faks = $iletisim->faks;
              $eposta = $iletisim->eposta;
              $face = $iletisim->facebook;
              $twit = $iletisim->twitter;
              $youtube = $iletisim->youtube;
              $gplus = $iletisim->google_plus;
					} ?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="footer-widget">
							<h4 class="footer-baslik">İletişim</h4>
							<ul class="list-links">
								<? if($tel1<>'') { ?><li class="listyok"><span><i class="fa fa-phone"></i></span><?=$tel1?></li><? } ?>
								<? if($faks<>'') { ?><li class="listyok"><span><i class="fa fa-fax"></i></span><?=$faks?></li><? } ?>
								<? if($eposta<>'') { ?><li class="listyok"><span><i class="fa fa-envelope-o"></i></span><?=$eposta?></li><? } ?>
							</ul>
							<ul class="footersocial">
								<? if($face<>'') { ?><li><a href="<?=$face?>" class="facebook" target="_blank"></a></li><? } ?>
								<? if($twit<>'') { ?><li><a href="<?=$twit?>" class="twitter" target="_blank"></a></li><? } ?>
								<? if($youtube<>'') { ?><li><a href="<?=$youtube?>" class="youtube" target="_blank"></a></li><? } ?>
								<? if($gplus<>'') { ?><li><a href="<?=$gplus?>" class="gplus" target="_blank"></a></li><? } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="bottom-footer">
					<div class="row">
						<p class="small-text"><?=__('copyright_yazi')?> <a href="http://www.comu.edu.tr" title="<?=__('comu_yazi')?>"><strong><?=__('comu_yazi')?></strong></a> »
						<a href="http://bidb.comu.edu.tr/" title="<?=__('bidb_yazi')?>"><?=__('bidb_yazi')?></a> » 
                        <a href="http://bidb.comu.edu.tr/birimler/web-birimi" title="<?=__('team_yazi')?>" target="_blank"><?=__('team_yazi')?></a>
                        </p> 
					</div>
				</div>
			</div>
		</footer>	
		<!------------------ footer alani bitti ------------------>
	</div><!--beyazBg-->
	
    
    <div id="divler3" class="hidden"></div> <!-- He Menü (sayfa boyutuna göre) yer değişikliği için gerekli -->
    