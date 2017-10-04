 
  <? include("inc_header.php"); ?>
	
	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
				<div class="col-sm-12">
					<? print $crumbs; ?>
				</div>
				<div class="col-sm-12">
					<div class="row">
                     <div class="col-sm-6">
    						<div class="panel panel-default">
    						  <!-- Default panel contents -->
    						  <div class="panel-heading"><?=__('iletisim_bilgileri')?></div>
        
    						  <!-- Table -->
    						  <table class="table">
    							<tbody>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('eposta')?> :</th>
    								<td class="col-sm-8"><?=$veri->eposta?></td>
    							  </tr>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('telefon')?> :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->tel1?></td>
    							  </tr>
                                  <? if($veri->tel2<>"") { ?>
                                  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('telefon')?> 2 :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->tel2?></td>
    							  </tr>
                                  <? } if($veri->tel3<>"") { ?>
                                  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('telefon')?> 3 :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->tel3?></td>
    							  </tr>
                                  <? } ?>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('faks')?> :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->faks?></td>
    							  </tr>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('adres')?> :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->adres?></td>
    							  </tr>
                                  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('sosyal_medya')?> :</th>
    								<td class="col-sm-8 col-xs-7">
		
                    <? if($veri->facebook<>'') {?><a title="facebook" class="btn btn-primary btn-circle" href="<?=My::AddHttp($veri->facebook)?>" target="_blank"><i class="fa fa-facebook"></i></a><? } ?>
                    <? if($veri->twitter<>'') {?><a title="twitter" class="btn btn-info btn-circle" href="<?=My::AddHttp($veri->twitter)?>" target="_blank"><i class="fa fa-twitter"></i></a><? } ?>
                    <? if($veri->google_plus<>'') {?><a title="google plus" class="btn btn-danger btn-circle" href="<?=My::AddHttp($veri->google_plus)?>" target="_blank"><i class="fa fa-google-plus"></i></a><? } ?>
                    <? if($veri->youtube<>'') {?><a title="youtube" class="btn btn-danger btn-circle" href="<?=My::AddHttp($veri->youtube)?>" target="_blank"><i class="fa fa-youtube"></i></a><? } ?>
                                    </td>
    							  </tr>
    							</tbody>
    						  </table>
    						</div>
    				
                        
    						<div class="panel panel-info">
    						  <!-- Default panel contents -->
    						  <div class="panel-heading"><?=__('web_sorumlu_bilgileri')?></div>
    
    						  <!-- Table -->
    						  <table class="table">
    							<tbody>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('adi_soyadi')?> :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->websorumlu_adi?></td>
    							  </tr>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('eposta')?> :</th>
    								<td class="col-sm-8"><?=$veri->websorumlu_eposta?></td>
    							  </tr>
    							  <tr>
    								<th class="col-sm-4 col-xs-5"><?=__('telefon')?> :</th>
    								<td class="col-sm-8 col-xs-7"><?=$veri->websorumlu_tel?></td>
    							  </tr>
    							  
    							</tbody>
    						  </table>
    						</div>
    					
                    </div>
					<div class="col-sm-6 col-xs-12">						
						<div class="panel panel-warning">
						  <!-- Default panel contents -->
						  <div class="panel-heading"><?=__('bize_ulasin')?></div>						  
							<form id="mesajsend" method="POST" action="mesaj">
								<div class="col-lg-12 alUst10 borderpen">
									<div class="form-group">
										<label><?=__('adi_soyadi')?></label>
										<div class="input-group">
											<input type="text" data-validation="required" class="form-control" name="gonderen" id="gonderen" placeholder="<?=__('adi_soyadi')?>"/>
											<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label for="eposta"><?=__('eposta')?></label>
										<div class="input-group">
											<input type="email" data-validation="required" class="form-control" id="eposta" name="eposta" placeholder="<?=__('eposta')?>"/>
											<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label for="konu"><?=__('konu')?></label>
										<div class="input-group">
											<input type="text" data-validation="required" class="form-control" id="konu" name="konu" placeholder="<?=__('konu')?>"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
									</div>
									<div class="form-group">
										<label for="message"><?=__('mesaj')?></label>
										<div class="input-group">
											<textarea data-validation="length" data-validation-length="1-300" name="message" id="message" class="form-control" rows="3"></textarea>
											<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
									</div>
                                    <div class="form-group">
										<label for="konu"><?=__('captcha')?></label>
										<div class="input-group">
                                            <span class="input-group-addon"><?=$captcha?></span>
                                            
											<input type="text" data-validation="required" class="form-control" id="captcha" name="captcha" placeholder="<?=__('captcha_ack')?>"/>
										</div>
									</div>
									<input type="hidden" name="token" id="token" value="<?=$token?>"/>
                                    <input type="submit" name="submit" id="submit" value="<?=__('gonder')?>" class="btn btn-success"/>
                                    <span id="formSonuc"></span>
								</div>
							</form>							
						</div>
					</div>
					<? if($ayarlar->harita=='acik'):?>
					<div class="col-sm-12 col-xs-12 AltAlanAyir">
						<div class="panel panel-success">
						  <div class="panel-heading"><?=__('ulasim')?></div>
						  <div class="panel-body">
							<div id="googleMap" style="height:380px;"></div>
						  </div>
						</div>
					</div>
					<? endif; ?>
				</div>
				</div>
			</div>
		</div>
	<!-- altsayfa kapsa bitti -->
    
    
    
	<?
	 if($veri->harita_tip<>"") $maptip = $veri->harita_tip; 
    else $maptip = "ROADMAP";
   ?>
    
	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>
    
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?&language=<?=$dil?>"></script>
    <script>
        $(function (){ 
            
            $.validate({
                form : '#mesajsend',
                validateOnBlur : true,
                onSuccess : function($form) {
                      $.ajax({
						url: "mesaj",	
						type: "POST",
						data: $('#mesajsend').serialize(),		
						dataType:"json",
                        beforeSend: function() { 
                            $('#submit').attr('disabled', 'disabled');
                            $("#mesaj").html("Mesaj Gönderiliyor. Lütfen Bekleyiniz...");
						    $('#loading').show();
						},
                        complete: function(){
                            $('#submit').removeAttr('disabled');
                            $('#loading').fadeOut(200);
                        },
						success: function (json) {
						    if(json.durum) {
						      $('#formSonuc').addClass('alert alert-success');
						    }
                            else {
                              $('#formSonuc').addClass('alert alert-danger');  
                            }
                            $('#formSonuc').html(json.msg);
						},
						error: function(x,e){ 	 
							ajx_error(x,e); 	
						}
					  });
                      return false; // Will stop the submission of the form
                    },

            });
        });
        
        
		function init_map() {
		var var_location = new google.maps.LatLng(<?=$veri->harita_koordinat?>);
		var var_mapoptions = {
		  center: var_location,
		  zoom: <?=$veri->harita_zoom?>,
		  mapTypeId: google.maps.MapTypeId.<?=strtoupper($maptip)?>
		};
		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title:""});
		var var_map = new google.maps.Map(document.getElementById("googleMap"),
			var_mapoptions);
		var_marker.setMap(var_map);	
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	</script>
   
  </body>
</html>      