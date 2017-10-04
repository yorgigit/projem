<? include("inc_header.php");  ?>

<!-- altsayfa kapsa basladi -->
<div class="container box top10 alt20">
	<div class="row kapsa">
                <div class="col-sm-12">&nbsp;</div>
				<div class="col-sm-12">
					<div class="row">
						
                        <!-- sol kolon -->
                        <div class="col-md-3 hidden-sm hidden-xs" id="solhack">
                            <? include("inc_herisim_menu.php"); ?>
                        </div>
                        <!-- sol kolon bitti-->
                        
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 altSayfaicerik">
							<div class="col-sm-12">
<div class="row">
<div id="cse" style="width: 100%;align:center;"><?=__('yukleniyor')?></div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  function parseQueryFromUrl () {
    var queryParamName = "q";
    var search = window.location.search.substr(1);
    var parts = search.split('&');
    for (var i = 0; i < parts.length; i++) {
      var keyvaluepair = parts[i].split('=');
      if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
        //return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
		var donen = keyvaluepair[1].replace(/\+/g, ' ');
			donen = donen.replace(/\%FD/g,'ı');
			donen = donen.replace(/\%FC/g,'ü');
			donen = donen.replace(/\%FE/g,'ş');
			donen = donen.replace(/\%F6/g,'ö');
			donen = donen.replace(/\%E7/g,'ç');
			donen = donen.replace(/\%F0/g,'ğ');
			donen = donen.replace(/\%DD/g,'İ');
			donen = donen.replace(/\%DC/g,'Ü');
			donen = donen.replace(/\%DE/g,'Ş');
			donen = donen.replace(/\%D6/g,'Ö');
			donen = donen.replace(/\%C7/g,'Ç');
			donen = donen.replace(/\%D0/g,'Ğ');
		return donen;
      }
    }
    return '';
  }
  google.load("search", "1", {style: google.loader.themes.MINIMALIST});
  google.load('search', '1', {language : '<?=strtolower($dil)?>'});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('<?=$ayarlarGenel->google_search_no?>');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
	options.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED); 
    //options.enableSearchResultsOnly();
    customSearchControl.draw('cse', options);
    var queryFromUrl = parseQueryFromUrl();
	//document.write(queryFromUrl);
    if (queryFromUrl) {
      customSearchControl.execute(queryFromUrl);
    }
  }, true);
</script>
</div>
                        </div>
						</div>
					</div>
				</div>
	</div>
</div>    
	<!-- altsayfa kapsa bitti -->
	<? include("inc_footer.php"); ?>
    <? include("inc_footer_js.php"); ?>
</body>
</html>       