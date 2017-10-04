    <script src="<?=ORTAK?>js/jquery-1.11.3.min.js"></script>
    <script src="<?=ORTAK?>js/bootstrap.min.js"></script>
    <script src="<?=ORTAK?>js/myjs/genel.js"></script>                      <!-- tüm sayfalar -->
    <script src="<?=ORTAK?>js/myjs/mydinamik_menu.js"></script>
    <script src="<?=ORTAK?>js/jquery_redirect.js"></script>
    
    <?php 
    if(isset($cssjs['js'])) {
        foreach ($cssjs['js'] as $script) {
            echo html::script($script) . PHP_EOL;
        };    
    }
    ?>