<? include(APPPATH."/views/inc_header.php");  ?>

	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
                <div class="col-sm-12">
					&nbsp;
				</div>
				<div class="col-sm-12">
					<div class="row">

                        <div class="col-md-3 hidden-sm hidden-xs" id="solhack">
                            <? include(APPPATH."/views/inc_herisim_menu.php"); ?>
                        </div>

                        
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 altSayfaicerik">
							<div class="col-sm-12 alSayfabaslik">
								<div class="col-sm-9"><?=__('ERR_noicerik')?></div>
							</div>
							<div class="col-sm-12 text-center">
								<img class="noborder" src="<?=ORTAK?>/img/404_<?=strtolower($dil)?>.png"/><br />
                                    <!--<h3><?=__('ERR_noicerik')?></h3>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- altsayfa kapsa bitti -->
   
          
   	<? include(APPPATH."/views/inc_footer.php"); ?>
    <? include(APPPATH."/views/inc_footer_js.php"); ?>

</body>
</html>          
	
          