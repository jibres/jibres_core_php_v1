<?php
namespace lib\pagebuilder\header\h300;


class h300
{
	public static function detail()
	{
		return
		[
			'key'         => 'h300',
			'mode'        => 'header',
			'title'       => T_("Header 300"),
			'description' => T_("Beautifull header"),
			'btn_title'   => T_("Choose this header"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The h300 contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'        => T_("Header setting"),
				// 'btn_preview'       => \lib\store::url(),

				// 'btn_advance' => \dash\url::that(). '/advance'. \dash\request::full_get(),
				// 'btn_save'    => true,
				// 'allow_html'  => true,
			],
			'contain' =>
			[
				'change'         => true,
				'announcement'   => true,

				'menu1'          => true,

				'generalsetting' => true,

			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['line']               = 'string_100';
		$_args['key']                = 'string_100';
		$_args['remove_header_logo'] = 'string_100';

		return $_args;
	}


	public static function input_required()
	{
		return ['line', 'key'];
	}


	public static function input_meta()
	{
		return [];
	}


	public static function ready($_data)
	{

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$h300 = [];

		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $h300);

		$_data['detail'] = json_encode($saved_detail, JSON_UNESCAPED_UNICODE);


		if(\lib\pagebuilder\tools\tools::in('announcement') || \lib\pagebuilder\tools\tools::in('change'))
		{
			// needless to redirect
		}
		else
		{
			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::that(). \dash\request::full_get());
		}

		\lib\pagebuilder\tools\tools::input_exception('detail');


		unset($_data['line']);
		unset($_data['key']);
		unset($_data['remove_header_logo']);

		return $_data;

	}
}
?>