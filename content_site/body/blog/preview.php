<?php
namespace content_site\body\blog;


class preview
{

	public static function p1()
	{
		return
		[
			'preview_title'  => T_("Card"),
			'version'        => 1,
			'type'           => 'b1',
			'master_preview' => true,
		];
	}


	public static function p122()
	{
		return
		[
			'preview_title'  => T_("Card 2"),
			'version'        => 1,
			'type'           => 'b1',
			'master_preview' => true,
		];
	}


	public static function p2()
	{
		return
		[
			'version'        => 2,
			'type'           => 'b2',
			'master_preview' => true,
		];
	}



	public static function p3()
	{
		return
		[
			'version'        => null, // default version is 1
			'type'           => 'b3',
			'master_preview' => true,
		];
	}


	public static function p4()
	{
		return
		[
			'type'           => 'b4',
			'master_preview' => true,
		];
	}



	public static function p5()
	{
		return
		[
			'type'           => 'b5',
			'master_preview' => true,
		];
	}


	public static function p6()
	{
		return
		[
			'type'           => 'b6',
			'master_preview' => true,
		];
	}



}
?>