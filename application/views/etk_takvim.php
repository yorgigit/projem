<? include("inc_header.php");  ?>
  
	<!-- altsayfa kapsa basladi -->
		<div class="container box top10 alt20">
			<div class="row kapsa">
				<div class="col-sm-12">
					<? 
                    print $crumbs;
                    ?>
				</div>
                
				<div class="col-sm-12">
					<div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 altSayfaicerik">
							<div class="col-sm-12 alSayfabaslik">
								<div class="col-sm-12"><?=__('menu_etkinliktakvim')?></div>
							</div>
							<div class="col-sm-12">
								  
                               <div id='calendar'></div>

                               
							</div>
                            
                            
 
						</div>
					</div>
                    
                    <div  class="row" style="margin: 2em 0; color:#fff;">
                                                <ul class="col-md-12 col-md-offset-2 list-inline">
                                                                <li style="background-color:#605ca8;"><?=__('etk_kategori1')?></li>
                                                                <li style="background-color:#7e5249;"><?=__('etk_kategori2')?></li>
                                                                <li style="background-color:#dd4b39;"><?=__('etk_kategori3')?></li>
                                                                <li style="background-color:#00a65a;"><?=__('etk_kategori4')?></li>
                                                                <li style="background-color:#0073b7;"><?=__('etk_kategori5')?></li>
                                                 </ul>
                        </div>
				</div>
			</div>
		</div>
	<!-- altsayfa kapsa bitti -->
    
   	<? include("inc_footer.php"); ?>
    <? include_once("inc_footer_js.php"); ?>

<? 
    if($dil=="TR") {  print '<script src="'.ORTAK.'js/fullcalendar/tr.js"></script>'; } 
 ?>
 
<script>
        function urlParam(key) {
            return (location.search.split(key + '=')[1] || '').split('&')[0];
        };
        
        $(document).ready(function() {

            $('#calendar').empty().fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek,month,listMonth'
                },              
                locale: 'tr',
                firstDay: 1,
                navLinks: true,
                editable: false,
                eventLimit:true,
                timeFormat: 'HH:mm',
                defaultView: (urlParam('v') === 'a' ? 'listMonth' : 'month'),
                events: [
                    <?=$veri?>
                ],
                // olayların üzerinde geldiğinde 'tooltip' göster
                eventRender: function(event, elem) {
                    $(elem).tooltip({
                        container: 'body',
                        title: event.title
                    });
                },
                // olay linklerini yeni pencerede aç
                eventClick: function(event) {
                    if (event.url) {
                        window.open(event.url);
                        return false;
                    }
                }
            });
        });
</script>

</body>
</html>          
	
