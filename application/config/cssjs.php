<?php


return array
(
    'Anasayfa' => array
    (
        'css' => array(
            ORTAK.'css/owl.carousel.css',               // Etkinlik
            ORTAK.'css/owl.theme.css',                  // Etkinlik
            ORTAK.'css/linkeffects/component.css',         // ana sayfa buton effect
            ORTAK.'css/galerihovereffect/galerihovereffect.css',                  // Ana Sayfa GAleri
        ),
        'js' => array(
            ORTAK.'js/owl.carousel.js',                         // Etkinlik
            ORTAK.'js/jquery.phancy.js',                        // Duyuru Listesi Scroll
            ORTAK.'js/jquery.cookie.js',                        // popup için cookie
            ORTAK.'js/linkeffects/modernizr.custom.js',           // ana sayfa buton effect
        )
    ),
    'Sayfa' => array (
      'css' => array(
            ORTAK.'css/jquery.fancybox.css',
        ),
        'js' => array(
            ORTAK.'js/jquery.rcrumbs.min.js', // respsonsive breadcrumbs
            ORTAK.'js/myjs/my_hemenu.js',
            ORTAK.'js/jquery.fancybox.js',
        )
    ),
    
    'HaberDuyuru' => array (
        'css' => array(
            ORTAK.'css/jquery.fancybox.css',
        ),
        'js' => array(
            ORTAK.'js/jquery.rcrumbs.min.js', // respsonsive breadcrumbs
            ORTAK.'js/jquery.fancybox.js',
            ORTAK.'js/myjs/my_hemenu.js',
        )
    ),  
    'HaberDuyuruList' => array (
        'css' => array(
            ORTAK.'css/jquery.fancybox.css',
        ),
        'js' => array(
            ORTAK.'js/jquery.rcrumbs.min.js', // respsonsive breadcrumbs
            ORTAK.'js/jquery.fancybox.js',
            ORTAK.'js/myjs/my_hemenu.js',
        )
    ),      
    'Iletisim' => array
    (
       
        'js' => array(
            ORTAK.'js/form_validator/jquery.form-validator.min.js',       //form control
            ORTAK.'js/jquery.rcrumbs.min.js', // respsonsive breadcrumbs
        )
    ),
    
    'EtkTakvim' => array
    (
       'css' => array(
            ORTAK.'css/fullcalendar/fullcalendar.min.css',
            [ORTAK.'css/fullcalendar/fullcalendar.print.min.css', 'print'],
        ),
        'js' => array(
            ORTAK.'js/fullcalendar/moment.min.js',
            ORTAK.'js/fullcalendar/fullcalendar.min.js',
        )
    ),
    
    'Galeri' => array
    (
        'css' => array(
            ORTAK.'css/jquery.fancybox.css',
        ),
        'js' => array(
            ORTAK.'js/jquery.fancybox.js',
            ORTAK.'js/jquery.rcrumbs.min.js', // respsonsive breadcrumbs
            ORTAK.'js/myjs/my_hemenu.js',
        )
    ),
	'BelgeDok' => array
    (
        'js' => array(
            ORTAK.'js/myjs/my_hemenu.js',
        )
    ),
	'SiteSearch' => array
    (
        'js' => array(
            ORTAK.'js/myjs/my_hemenu.js',
        )
    ),
    'Tv' => array
    (
        'css' => array(
          ORTAK.'css/tv/tv.css',
        ),
        'js' => array(
            ORTAK.'js/tv/modernizr.custom.79639.js',
            ORTAK.'js/tv/jquery.ba-cond.min.js',
            ORTAK.'js/tv/jquery.slitslider.js',
        )
    )
);