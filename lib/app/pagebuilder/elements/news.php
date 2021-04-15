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


	/**
	 * News element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The news contain
	 */
	public static function contain($_args = [])
	{
		$_args[] = 'effect';
		$_args[] = 'design';
		$_args[] = 'puzzle';
		$_args[] = 'infoposition';

		return $_args;
	}


	public static function design_map()
	{
		$map =
		[
			'title'  => true,
			'design' =>
			[
				'avand'  => true,
				'radius' => true,
				'effect' => true,
				'padding' => true,
				'infoposition' => true,
			],
			'puzzle' => true,
			'remove' => true,
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['set_title']         = 'bit';
		$_args['show_title']        = 'string_100';
		$_args['more_link']         = 'string_100';
		$_args['more_link_caption'] = 'string_100';

		return $_args;
	}
}
?>
