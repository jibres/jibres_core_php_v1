<?php
namespace lib\pagebuilder\body\subscribe;


class subscribe
{

	public static function allow()
	{
		return true;
	}


	public static function detail()
	{
		return
		[
			'key'         => 'subscribe',
			'mode'        => 'body',
			'title'       => T_("Subscribe box"),
			'description' => T_("Form to receive the customer's mobile phone to communicate"),
			'btn_title'   => T_("Add subscribe box"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The subscribe contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'  => T_("Subscribe"),
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