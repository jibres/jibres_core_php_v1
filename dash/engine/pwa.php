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
		$siteTitle = mb_strtolower($siteTitle);

		$manifest  =
		[
			'name'             => T_($siteTitle). ' | '. T_(\dash\option::config('site', 'slogan')),
			'short_name'       => T_($siteTitle),
			'description'      => T_(\dash\option::config('site', 'desc')),
			'dir'              => \dash\language::current('direction'),
			'lang'             => str_replace('_', '-', \dash\language::current('iso')),


			'display'          => 'standalone',
			// phone top nav color
			// get color from settings
			'theme_color'      => '#ffffff',
			// background of splash
			// get color from settings
			'background_color' => '#1a2733',


			'scope'            => '/',
			'start_url'        => \dash\url::kingdom(). '?utm_source=pwa',
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

		// check icon128
		$icon128 = '/logo/icon/png/Jibres-Logo-icon-128.png';
		if(file_exists(root. 'public_html/static'. $icon128))
		{
			$icon128 = \dash\url::static(). $icon128;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'sizes' => '128x128',
				'src' => $icon128,
			];
		}

		// check icon144
		$icon144 = '/logo/icon/png/Jibres-Logo-icon-144.png';
		if(file_exists(root. 'public_html/static'. $icon144))
		{
			$icon144 = \dash\url::static(). $icon144;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'sizes' => '144x144',
				'src' => $icon144,
			];
		}

		// check icon192
		$icon192 = '/logo/icon/png/Jibres-Logo-icon-192.png';
		if(file_exists(root. 'public_html/static'. $icon192))
		{
			$icon192 = \dash\url::static(). $icon192;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'sizes' => '192x192',
				'src' => $icon192,
			];
		}

		// check icon256
		$icon256 = '/logo/icon/png/Jibres-Logo-icon-256.png';
		if(file_exists(root. 'public_html/static'. $icon256))
		{
			$icon256 = \dash\url::static(). $icon256;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'sizes' => '256x256',
				'src' => $icon256,
			];
		}

		// check icon512
		$icon512 = '/logo/icon/png/Jibres-Logo-icon-512.png';
		if(file_exists(root. 'public_html/static'. $icon512))
		{
			$icon512 = \dash\url::static(). $icon512;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'sizes' => '512x512',
				'src' => $icon512,
			];
		}

		// check default logo
		$iconDefault = '/logo/icon/png/Jibres-Logo-icon-256.png';
		if(file_exists(root. 'public_html/static'. $iconDefault))
		{
			$iconDefault = \dash\url::static(). $iconDefault;
			$iconsArr[] =
			[
				'type' => 'image/png',
				'src' => $iconDefault,
			];
		}

		if($iconsArr)
		{
			$manifest['icons'] = $iconsArr;
		}



		\dash\code::jsonBoom($manifest, true, 'manifest');
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
