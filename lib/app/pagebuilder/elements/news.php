<?php
namespace lib\app\pagebuilder\elements;


class news
{
	public static function detail()
	{
		return
		[
			'key'         => 'news',
			'mode'        => 'body',
			'title'       => T_("News box"),
			'description' => T_("New Description sample box"),
			'btn_title'   => T_("Add new news box"),
		];
	}


	public static function contain()
	{
		return
		[
			'platform',
			'title',
			'titlesetting',
			'background',
			'avand',
			'margin',
			'padding',
			'radius',
			'ifloginshow',
			'ifpermissionshow',
			'puzzle',
			'infoposition',
		];
	}



	public static function input_condition($_args = [])
	{
		$_args['set_title']         = 'string_100';
		$_args['set_title']         = 'string_100';
		$_args['show_title']        = 'string_100';
		$_args['more_link']         = 'string_100';
		$_args['more_link_caption'] = 'string_100';

		return $_args;
	}
}
?>
