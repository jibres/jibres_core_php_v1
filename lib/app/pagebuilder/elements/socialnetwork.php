<?php
namespace lib\app\pagebuilder\elements;


class socialnetwork
{
	public static function detail()
	{
		return
		[
			'key'         => 'socialnetwork',
			'mode'        => 'body',
			'title'       => T_("Social network box"),
			'description' => T_("Get Customer mobile to contact to him"),
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

		// $socialnetwork = [];

		// if(array_key_exists('html', $_data))
		// {
		// 	$_data['socialnetwork'] = \dash\request::post_html();
		// }
		// elseif(a($_saved_detail, 'socialnetwork'))
		// {
		// 	$socialnetwork['socialnetwork'] = a($_saved_detail, 'socialnetwork');
		// }

		// \lib\app\pagebuilder\line\tools::input_exception('socialnetwork');


		// unset($_data['html']);

		return $_data;

	}
}
?>