<?php
namespace lib\app\pagebuilder\elements;


class application
{
	public static function detail()
	{
		return
		[
			'key'         => 'application',
			'mode'        => 'body',
			'title'       => T_("Application box"),
			'description' => T_("Get Customer mobile to contact to him"),
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
		// $_args['html']    = 'real_html';

		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{

		// $application = [];

		// if(array_key_exists('html', $_data))
		// {
		// 	$_data['application'] = \dash\request::post_html();
		// }
		// elseif(a($_saved_detail, 'application'))
		// {
		// 	$application['application'] = a($_saved_detail, 'application');
		// }

		// \lib\app\pagebuilder\line\tools::input_exception('application');


		// unset($_data['html']);

		return $_data;

	}
}
?>