<?php
namespace content_v2\android;


class view
{
	public static function config()
	{
		$load_app_detail = \lib\app\application\detail::get_android();

		$subdomain       = \lib\store::detail('subdomain');
		$homepage        = \lib\store::url();

		$queue = \lib\app\application\queue::detail();

		$packagename   = isset($queue['packagename']) ? $queue['packagename'] : 'com.jibres.'. \dash\store_coding::encode_raw();
		$versiontitle  = isset($queue['versiontitle']) ? $queue['versiontitle'] : \lib\app\application\version::get_last_version();
		$versionnumber = isset($queue['versionnumber']) ? intval($queue['versionnumber']) : \lib\app\application\version::get_last_version();
		$keystore      = isset($queue['keystore']) ? $queue['keystore'] : 'jibres';



		$result =
		[
			'namespace' => $packagename,
			'title'     => isset($load_app_detail['title']) ? $load_app_detail['title'] : T_('Jibres'),
			'desc'      => isset($load_app_detail['desc']) ? $load_app_detail['desc'] : \dash\face::intro(),
			'slogan'    => isset($load_app_detail['slogan']) ? $load_app_detail['slogan'] : \dash\face::slogan(),
			'logo'      =>
			[
				'standard' => \dash\url::logo(),
				'vertical' => \dash\url::logo(),
				'icon'     => isset($load_app_detail['logo']) ? $load_app_detail['logo'] : \dash\url::icon(),
			],
			'version'   =>
			[
				'last'       => $versionnumber,
				'depricated' => \lib\app\application\version::get_depricated_version(),
				'update'     => \content_v2\get::endpoint('android'). '/update',
			],
			'url'      =>
			[
				'update'   => \content_v2\get::endpoint('android'). '/update',
				'language' => \content_v2\get::endpoint('android'). '/language',
				'splash'   => \content_v2\get::endpoint('android'). '/splash',
				'intro'    => \content_v2\get::endpoint('android'). '/intro',
				'homepage' => $homepage,
				'menu'     => \content_v2\get::endpoint('android'). '/menu',
				'ad'       => \content_v2\get::endpoint('android'). '/ad',
			]
		];

		\content_v2\tools::say($result);
	}
}
?>