<?php
namespace lib\pagebuilder\header\h0;


class h0
{
	public static function allow()
	{
		return true;
	}

	public static function detail()
	{
		return
		[
			'key'          => 'h0',
			'mode'         => 'header',
			'title'        => T_("Without header"),
			'description'  => T_("Without header"),
			'btn_title'    => T_("Choose this template"),

		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The h0 contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'        => T_("Customize Your Website Header"),
				'allow_upload_file' => true,
			],
			'contain' =>
			[
				'change'         => ['detail' => ['page_title' => T_("Choose header")]],
				'announcement'   => ['detail' => ['page_title' => T_("Announcement")]],
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		return $_args;
	}


	public static function ready($_data)
	{
		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$h0 = [];


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $h0);

		$_data['detail'] = json_encode($saved_detail, JSON_UNESCAPED_UNICODE);

		if(\lib\pagebuilder\tools\tools::in('announcement') || \lib\pagebuilder\tools\tools::in('change'))
		{
			// needless to redirect
		}
		else
		{
			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::current(). \dash\request::full_get());
		}

		\lib\pagebuilder\tools\tools::input_exception('detail');

		return $_data;

	}
}
?>