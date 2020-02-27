<?php
namespace dash\engine;
/**
 * Progressive Web Apps
 */
class pwa
{
	public static function manifest()
	{
		$siteTitle = \dash\option::config('site', 'title');
		// $siteTitle = mb_strtolower($siteTitle);

		$manifest  =
		[
			// 'name'             => T_($siteTitle). ' | '. T_(\dash\option::config('site', 'slogan')),
			'name'             => T_($siteTitle),
			'short_name'       => T_($siteTitle),
			'description'      => T_(\dash\option::config('site', 'desc')),
			'dir'              => \dash\language::dir(),
			'lang'             => str_replace('_', '-', \dash\language::currentAll('iso')),


			'display'          => 'standalone',
			// phone top nav color
			// get color from settings
			'theme_color'      => '#c80a5a',
			// background of splash
			// get color from settings
			'background_color' => '#fff',


			'scope'            => '/',
			'start_url'        => \dash\url::kingdom(). '/my?utm_source=pwa',
			'orientation'      => 'portrait',


			// 'related_applications' =>
			// [
			// 	[
			// 		'platform' => 'play',
			// 		'url'      => 'https://play.google.com/store/apps/details?id=com.ermile.jibres',
			// 		'id'       => 'com.ermile.jibres'
			// 	],
			// 	[
			// 		'platform' => 'itunes',
			// 		'url'      => 'https://itunes.apple.com/app/ermile-jibres/id123456789',
			// 	]
			// ],
		];


		// set icons if exist
		$iconsArr = [];

		// check icon32
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '32x32',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-32.min.png',
		];

		// check icon48
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '48x48',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-48.min.png',
		];

		// check icon64
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '64x64',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-64.min.png',
		];

		// check icon72
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '72x72',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-72.min.png',
		];

		// check icon96
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '96x96',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-96.min.png',
		];

		// check icon128
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '128x128',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-128.min.png',
		];

		// check icon144
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '144x144',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-144.min.png',
		];

		// check icon180
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '180x180',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-180.min.png',
		];

		// check icon192
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '192x192',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-192.min.png',
		];

		// check icon256
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '256x256',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-256.min.png',
		];

		// check icon384
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '384x384',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-384.min.png',
		];

		// check icon500
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '500x500',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-500.min.png',
		];

		// check icon512
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '512x512',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-512.min.png',
		];

		// check icon1024
		$iconsArr[] =
		[
			'type'  => 'image/png',
			'sizes' => '1024x1024',
			'src'   => \dash\url::cdn(). '/logo/min/Jibres-Logo-icon-zero-1024.min.png',
		];

		if($iconsArr)
		{
			$manifest['icons'] = $iconsArr;
		}

		\dash\code::jsonBoom($manifest, false, 'manifest');
	}


	public static function service_worker()
	{
		$worker = "";
		$worker .= "self.addEventListener('install', function() { console.log('Install SW!');});". "\n";
		$worker .= "self.addEventListener('activate', event => { console.log('Activate SW!'); });". "\n";
		// $worker .= "self.addEventListener('fetch', function(event) { console.log('Fetch!', event.request); });";

		@header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		@header("Cache-Control: post-check=0, pre-check=0", false);
		@header("Pragma: no-cache");

		\dash\code::jsonBoom($worker, true, 'js');
	}

	public static function offline()
	{
		$off = "You are offline!";


		\dash\code::jsonBoom($off, true, 'html');
	}
}
?>
