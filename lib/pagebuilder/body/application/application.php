<?php
namespace lib\pagebuilder\body\application;


class application
{
	public static function detail()
	{
		return
		[
			'key'         => 'application',
			'mode'        => 'body',
			'title'       => T_("Application box"),
			'description' => T_("View information and application download links"),
			'btn_title'   => T_("Add application box"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The application contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'  => T_("Application"),
			],
			'contain' =>
			[
				'title'   => true,
				'avand'   => true,
				'padding' => true,
				'margin'  => true,
				'remove'  => true,
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		return $_data;
	}
}
?>