<? include("inc_header.php");  ?>

	<!-- altsayfa kapsa basladi -->
	<div class="row altSayfaKapsa sifirla">
		<div class="container yukari30">
			<div class="row altSayfaBg sifirla">
				<div class="col-sm-12">
					<? print $crumbs; ?>
                    
				</div>
                
				<div class="col-sm-12">
					<div class="row">
                    
						<? if($ayarlar->hizli_menu=='acik'): ?>
                        <!-- sol kolon -->
                        <div id="divler1" class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <? include("inc_herisim_menu.php"); ?>
                        </div>
                        <!-- sol kolon -->
						<? endif; ?>
						
                        
						<div id="divler2" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

              <div class="col-sm-12 alSayfabaslik sifirla">
                  <div class="col-sm-12"><?=$kategori?></div>
              </div>
						                        
                        <?php if(count($kayitlar)>0): ?>
                        
                        <div class="col-sm-12">
                        <div class="row asagi20">
                        
                        <!-- ARAMA ---------------------------------------------------->
                            <div class="arama_div">
                                <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8" style="padding-top:5px">
                                    <? if(!empty($filtre)): ?>
                                            <a class="text-danger" href="<?=$tamlink?>" id="resetfrm"><?=__('tum_kayitlar')?></a>
                                        <? endif; ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
                                    <?=Form::open("$tamlink?p=1",array('method'=>'post'));?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="filtre" id="filtre" placeholder="<?=__('filtrele_kayit')?>" value="<?=$filtre?>"/>
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
                            
                            <table class="table table-hover table-striped table-bordered icerik">
                                <thead>
                                	<tr>
                                		<th width='8%'></th>
                                		<th width='88%'><?=__('baslik')?></th>
                                        <th width='4%'></th>
                                	</tr>
                                </thead>
                                
                                <tbody>
                                <? 
                                   $count= (($pagination->current_page-1)*$pagination->items_per_page)+1;
                                   foreach ($kayitlar as $v) {
                                    
                                    $v->baslik  = str_ireplace($filtre,"<span class=\"arama_vurgula\">$filtre</span>",$v->baslik);
                                    $tr_class   = ($v->arsiv=='1') ? 'class="arsivtr"' : '';
                                    $arsiv_yazi = ($v->arsiv=='1') ? __('arsiv_text') : '';
                                ?>
                                	<tr <?=$tr_class?>>
                                		<td><?=$count?></td>
                                		<td><a class="cursor-pointer" onclick="showek(<?=$v->id?>,'<?=htmlentities($v->baslik)?>')"><?=$v->baslik?></a></td>
                                        <td><?=$arsiv_yazi?></td>
                                	</tr>
                                <?  $count++; } ?>
                                </tbody>
                            </table>
                            <div class="alert-warning" style="padding: 3px;"><strong><?=__('toplam')?> <?=$pagination->total_items?> <?=__('kayit')?></strong></div>
                            <?=$pagination;?>
                        </div>
                        </div>
                       <? else: 
                           if(!empty($filtre)){
                        ?>
                                            <a class="text-danger" href="<?=$tamlink?>" id="resetfrm"><?=__('tum_kayitlar')?></a>
                          <?
                                        }
                            print '<div class="col-lg-12 alert alert-danger">'.$ERR['norecord']['genel'].'</div>'; 
                        ?>
                        
                        <? endif; ?>


                    </div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- altsayfa kapsa bitti -->



<!--  MODAL PENCERE -->
 <div class="modal fade popupModal" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" >
         <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body modal-showek">
                <div class="row" id="div_showek"></div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal"><?=__('kapat')?></button>
            </div>
         </div>
  </div>
</div>  
                           
 <!-- MODAL PENCERE END -->	
    
   	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>

<script>
    function ara() {
        var ara = $('#ara').val();
        var mevcutara = $('#mevcutara').val();
        
        $.redirect('list-'+adil, {page: pg, ara:ara, mevcutara:mevcutara, dil:adil });
    }
    
     function showek(id,adi) {
        $('#myModalLabel').html(adi);
        
                      $.ajax({
						url: "showek",	
						type: "POST",
						data: "&bid="+id,
                        complete: function(){
                            $('#popupModal').modal('show');
                        },
						success: function (rsp) {
						    $('#div_showek').html(rsp);
						},
						error: function(x,e){ 	 
							ajx_error(x,e); 	
						}
					  });
                      
        }    
</script>    
</body>
</html> 