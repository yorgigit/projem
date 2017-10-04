<div class="col-sm-12">
<div class="well ustAyir">
<div class="row-dashed"><h4><?=__('ekler')?></h4></div> 
    <? foreach ($ekler as $ek) { 
        
        if(!empty($ek->gorunen_isim)) {
            $ekisimgoster = $ek->gorunen_isim;
        }
        else {
		  $ekisimarr = explode("-",$ek->file_url);
		  $ekisimgoster = str_replace($ekisimarr[0]."-","",$ek->file_url);
		}
        
		$n = pathinfo($ek->file_url);
		$ext = $n['extension'];
		$simge = "<img style='width:24px' src='".ORTAK."img/icons/".$ext.".png'/>";
     ?>
    <div class="row row-dashed" id="fileshow<?=$ek->id?>">
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center"><?=$simge?></div>
    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-6"><?=$ekisimgoster?></div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5"><a class="btn btn-info btn-sm" onclick="viewer('<?=$ek->file_url?>')"><i class="fa fa-eye"></i> <?=__('goster')?></a>
     &nbsp; <a class="btn btn-warning btn-sm" href="<?=FILES?>files/<?=$ek->file_url?>"><i class="fa fa-download"></i> <?=__('indir')?></a></div>
    </div>
<?  } ?>
</div></div>