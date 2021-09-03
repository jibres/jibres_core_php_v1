<?php
namespace lib\pagebuilder\footer\f201;


class f201
{
	public static function allow()
	{
		return true;
	}

	public static function detail()
	{
		return
		[
			'key'          => 'f201',
			'mode'         => 'footer',
			'title'        => T_("Footer #201"),
			'description'  => T_("This footer contain 4 menu and  your store title and description"),
			'btn_title'    => T_("Choose this template"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer201.jpg',
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The f201 contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'        => T_("Footer setting"),
			],
			'contain' =>
			[
				'change'         => true,
				'text'           => ['detail' => ['btn_save' => true, 'allow_html' => true]],
				'generalsetting' => true,
				'menu1'          => true,
				'menu2'          => true,
				'menu3'          => true,
				'menu4'          => true,
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
		if(
			(isset($_data['detail']['footer_menu_1']) && $_data['detail']['footer_menu_1']) ||
			(isset($_data['detail']['footer_menu_2']) && $_data['detail']['footer_menu_2']) ||
			(isset($_data['detail']['footer_menu_3']) && $_data['detail']['footer_menu_3']) ||
			(isset($_data['detail']['footer_menu_4']) && $_data['detail']['footer_menu_4'])
		  )
		{
			$_data['detail']['have_footer_menu'] = true;
		}

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$f201 = [];

		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $f201);

		unset($saved_detail['have_footer_menu']);

		$_data['detail'] = json_encode($saved_detail, JSON_UNESCAPED_UNICODE);

		if(\lib\pagebuilder\tools\tools::in('change') || \lib\pagebuilder\tools\tools::in('text'))
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