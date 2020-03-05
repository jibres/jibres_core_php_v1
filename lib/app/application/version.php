<?php
namespace lib\app\application;


class version
{
	public static function version_list()
	{
		$version = [];
		$version[1] =
		[
			'version'   => 1,
			'relase'    => '2020-01-01',
			'expire'    => '2020-02-03',
			'title'     => 'store shop',
			'desc'      => 'Best application shoping',
			'changelog' =>
			[
				['title' => null, 'desc' => 'change design of splash', 'date' => null],
				['title' => null, 'desc' => 'add intro new theme', 'date' => null],
			]
		];
	}


	public static function get_last_version()
	{
		return 4;
	}


	public static function get_depricated_version()
	{
		return 3;
	}
}
?>