<!DOCTYPE html>
<html lang="<?=strtolower($dil).'-'.$dil?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="refresh" content="900"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title><?=$ayarlar->site_baslik?></title>
    <meta name="description" content="<?=$ayarlar->site_baslik?>"/>
    <meta name="keywords" content="<?=$ayarlar->anahtar_kelimeler?>"/>
    <meta name="robots" content="index,follow" /> 
    <meta name="googlebot" content="all" />
    <meta name="revisit-after" content="1 Days" />
    <meta name="distribution" content="global" />
    <meta name="rating" content="general" />
    <meta name="author" content="<?=__('comu_yazi')?>" />
    
    <link href="<?=ORTAK?>css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?=TEMA?>css/style.css" rel="stylesheet"/>
    <link href="<?=ORTAK?>css/font-awesome.min.css" rel="stylesheet"/>
  
    <?php 
    if(isset($cssjs['css'])) {
        foreach ($cssjs['css'] as $style) {
            echo HTML::style($style) . PHP_EOL;
        };    
    }
    ?>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <base href="<?=$ayarlarGenel->site_adresi?>"/>

  </head>
  
  <body>

<?
    $sayac = 1;
    $slide_renk = 1;
?>
<div class="container2 demo-1">
    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">
				
<?php if(count($kayitlar)>0): ?>

<? 
    foreach ($kayitlar as $v) {
        if(($sayac%2)==1) { 
            $slide_yon = "horizontal";
        }
        else {
            $slide_yon = "vertical";
        }
        
        if(($sayac%8)==0) $slide_renk = 1;
?>
 
        <div class="sl-slide bg-<?=$slide_renk?>" data-orientation="<?=$slide_yon?>" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
			<div class="sl-slide-inner">
				<h2><?=$v->baslik?></h2>
				<blockquote>
                    <p><?=html_entity_decode($v->metin)?></p>
                    <!--<cite><?=My::tarih_format($v->yayin_tarihi,'mysqltod')?></cite>-->
                </blockquote>
			</div>
        </div>
 <?  $sayac++; $slide_renk++; } ?>
 
  <? else: ?>
  
       <div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
			<div class="sl-slide-inner">
				<h2><?=$ERR['norecord']['duyuru']?></h2>
			</div>
        </div>
  
 <? endif; ?>
 
    
        </div><!-- /sl-slider -->
				<!--
				<nav id="nav-arrows" class="nav-arrows">
					<span class="nav-arrow-prev">Previous</span>
					<span class="nav-arrow-next">Next</span>
				</nav>
                -->
				<nav id="nav-dots" class="nav-dots">
                    <?
                        for($mm=1; $mm<$sayac;$mm++) {
                    ?>
					   <span <? if($mm==1) print 'class="nav-dot-current"'; ?>></span>
                    <? } ?>
				</nav>
    </div><!-- /slider-wrapper -->
</div>

   <script src="<?=ORTAK?>js/jquery-1.11.3.min.js"></script>


    <?php 
    if(isset($cssjs['js'])) {
        foreach ($cssjs['js'] as $script) {
            echo html::script($script) . PHP_EOL;
        };    
    }
    ?>


	<script type="text/javascript">	
			$(function() {
			
				var Page = (function() {

					var $navArrows = $( '#nav-arrows' ),
						$nav = $( '#nav-dots > span' ),
						slitslider = $( '#slider' ).slitslider( {
							autoplay : true,
							interval : 10000,
							onBeforeChange : function( slide, pos ) {
								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );
							}
						} ),

						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':last' ).on( 'click', function() {

								slitslider.next();
								return false;

							} );

							$navArrows.children( ':first' ).on( 'click', function() {
								
								slitslider.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};

						return { init : init };

				})();

				Page.init();

			
			});
		</script>
</body>
</html>   