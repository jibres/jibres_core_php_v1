<?php
namespace lib\pagebuilder\body\socialnetwork;


class socialnetwork
{

	public static function allow()
	{
		return false;
	}


	public static function detail()
	{
		return
		[
			'key'         => 'socialnetwork',
			'mode'        => 'body',
			'title'       => T_("Social network box"),
			'description' => T_("Share your social network ID with customers"),
			'btn_title'   => T_("Add socialnetwork box"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The socialnetwork contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'  => T_("Social network"),
			],
			'contain' =>
			[
				'title'   => true,
				'device'  => true,
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