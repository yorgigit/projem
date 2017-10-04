<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Istanbul');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	    'base_url'   => '/',
      'index_file' => false,
      'errors'        => TRUE,
      'profile'       => (Kohana::$environment == Kohana::DEVELOPMENT),
      'caching'       => (Kohana::$environment == Kohana::PRODUCTION)
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	// 'auth'       => MODPATH.'auth',       // Basic authentication
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	// 'minion'     => MODPATH.'minion',     // CLI Tasks
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
    'pagination'   => MODPATH.'pagination',    // Sayfalama
    'breadcrumbs' => MODPATH.'breadcrumbs',    // Breadcrumbs
    'captcha' => MODPATH.'captcha',             // Captcha
	'sitemap' => MODPATH.'sitemap',             // Sitemap
    'swiftmailer' => MODPATH.'swiftmailer',     // swiftmailer
	));


/**
 * Cookie Salt
 * @see  http://kohanaframework.org/3.3/guide/kohana/cookies
 * 
 * If you have not defined a cookie salt in your Cookie class then
 * uncomment the line below and define a preferrably long salt.
 */
Cookie::$salt = 'ÇOMÜ CMS Web Yönetim Sistemi';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */



//------------------------------------------------------------------------------------------------
Route::set('indexgelirse', 'index')
	->defaults(array(
        'controller' => 'Anasayfa',
        'action'     => 'index'
	));
//-------------------------------------------------------------------------------------------------

/*
*  DUYURU, HABER, ETKİNLİK ROOTING
*/

// TR|EN|FR|IT|DE  şeklinde gidiyor
//$arsiv_tip = '(duyurular|announcements|annonces|annunci|ankundigungen|haberler|news|nouvelles|notizie|nachrichten|etkinlikler|activities|activites|attivita|aktivitaten)';
$arsiv_tip = '(duyurular|announcements|haberler|news|etkinlikler|activities)';
$galeri_tip = '(galeriler|galleries)';

Route::set('haberduyuru', '<amenu>/<tip>(/<slug>.<format>)', 
array(
    'amenu' => '(arsiv|archive)',
    'tip' => $arsiv_tip,
    'slug' => '[0-9a-zA-Z-]{3,60}',
    'format' => '(htm|html)',
))
->filter(function($route, $params, $request)
    {
        if(count($params)>3) {
            $params['controller'] = 'HaberDuyuru';
        }
        else {
            $params['controller'] = 'HaberDuyuruList';
        }
        
        return $params;

    })
    ->defaults(array(
        'action'     => 'index',
    ));

//------------------------------------------------------------------------------------------------
/*  Haber Duyuru Service   */

Route::set('hd_json', 'service/news/<dil>(/<adet>)',
  array(
    'dil' => '(TR|EN)',
    'adet' => '[0-9]{1,2}',
  ))
	->defaults(array(
        'controller' => 'HaberDuyuruJSON',
        'action'     => 'index'
	)); 
        
//------------------------------------------------------------------------------------------------
/*  Dil   */

Route::set('dil', 'dil/degistir/<id>',
  array(
    'id' => '[A-Z]{2,2}',
  ))
	->defaults(array(
        'controller' => 'Dil',
        'action'     => 'degistir'
	));  

//-------------------------------------------------------------------------------------------------
/*
*  SAYFALAR ROOTING
*/

Route::set('sayfa', '(<amenu>/)(<menu>/)<slug>.<format>',
  array(
    'slug' => '[0-9a-zA-Z-~]{3,60}',
    'format' => '(htm|html)',
  ))
  ->filter(function($route, $params, $request)
    {
        $slug = $params['slug'];

        if(substr($slug, 0,5)=='~form') {
          $params['controller'] = 'Ozel'; //ucfirst(substr($slug, 1));
        }
        else {
          $params['controller'] = 'Sayfa';
        }
        return $params;
    })
  ->defaults(array(
    'action'     => 'index',
  ));

//-------------------------------------------------------------------------------------------------
/*
*  GALERİ LIST AND SHOW ROOTING
*/

Route::set('galeri', '<tip>(/<slug>)',
  array(
    'tip' => $galeri_tip,
    'slug' => '[0-9a-zA-Z-]{3,60}',
  ))
  ->defaults(array(
    'controller' => 'Galeri',
    'action'     => 'index',
  ));

//-------------------------------------------------------------------------------------------------
// cesitli route

Route::set('cesitli', '(<amenu>/)(<menu>/)<any>', 
array(
    'any' => '(.+)',
))
->filter(function($route, $params, $request)
    {
        $any = $params['tip'] = $params['any'];

        $Belgedok = Model::factory('BelgeDok')->getBelgeDokKategori($any)[0];
        
        if(substr($any, 0,1)=='~') {
          $params['controller'] = 'Ozel'; //ucfirst(substr($any, 1));
        }
        else if(!empty($Belgedok) AND count($Belgedok)>0) {
            $params['controller'] = 'BelgeDok';
            $params['katid'] = $Belgedok->id;
            $params['katadi'] = $Belgedok->adi;
            $params['katseo'] = $Belgedok->seourl;
        }
        else {
            switch ($any) {
                case 'tv':      $params['controller'] = 'Tv';
                break;
                case 'mesaj':   $params['controller'] = 'Mesaj';
                break;
                case 'viewer':  $params['controller'] = 'FileView';
                break;
                case 'search':  $params['controller'] = 'SiteSearch';
                break;
                case 'showek':  $params['controller'] = 'ShowEk';
                break;
                case 'iletisim':  
                case 'contact': $params['controller'] = 'Iletisim';
                break;
                case 'etkinliktakvimi':  
                case 'eventcalendar': $params['controller'] = 'EtkTakvim';
                break;
                default:        $params['controller'] = 'Error';
                break;
            }
        }
        return $params;

        //return FALSE;
    })
    ->defaults(array(
        'action'     => 'index',
    ));

//-------------------------------------------------------------------------------------------------
/*
*  ANA SAYFA ROOTING
*/

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
        'controller' => 'Anasayfa',
        'action'     => 'index'
	));