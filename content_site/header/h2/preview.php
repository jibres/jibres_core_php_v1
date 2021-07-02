<?php
namespace content_site\header\h2;


class preview
{

	public static function preview_1()
	{
		return
		[
			'heading'     => \lib\store::title(),
			'description' => \lib\store::desc(),
			'style'       => 'style_1',
		];
	}

}
?>