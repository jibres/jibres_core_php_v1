<?php
namespace lib\app\pagebuilder\elements;


class subscribe
{
	public static function detail()
	{
		return
		[
			'key'         => 'subscribe',
			'mode'        => 'body',
			'title'       => T_("Subscribe box"),
			'description' => T_("Get Customer mobile to contact to him"),
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
		// $_args['html']    = 'real_html';

		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{

		// $subscribe = [];

		// if(array_key_exists('html', $_data))
		// {
		// 	$_data['subscribe'] = \dash\request::post_html();
		// }
		// elseif(a($_saved_detail, 'subscribe'))
		// {
		// 	$subscribe['subscribe'] = a($_saved_detail, 'subscribe');
		// }

		// \lib\app\pagebuilder\line\tools::input_exception('subscribe');


		// unset($_data['html']);

		return $_data;

	}
}
?>