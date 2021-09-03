<?php
namespace lib\pagebuilder\header\h100;


class h100
{
	public static function allow()
	{
		return true;
	}

	public static function detail()
	{
		return
		[
			'key'          => 'h100',
			'mode'         => 'header',
			'title'        => T_("Header #100"),
			'description'  => T_("A modern and beautiful header"),
			'btn_title'    => T_("Choose this template"),
			'sample_image' => \dash\url::cdn(). '/img/template/header/header100.jpg',
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The h100 contain
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
				'color'          => true,
				'announcement'   => ['detail' => ['page_title' => T_("Announcement")]],
				'logo'           => true,
				'menu1'          => true,
				'menu2'          => true,
				'generalsetting' => true,

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
		if((isset($_data['detail']['header_menu_1']) && $_data['detail']['header_menu_1']) || (isset($_data['detail']['header_menu_2']) && $_data['detail']['header_menu_2']))
		{
			$_data['detail']['have_header_menu'] = true;
		}

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$h100 = [];

		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $h100);

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