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
		$_args['line']               = 'string_100';
		$_args['key']                = 'string_100';
		$_args['remove_footer_logo'] = 'string_100';

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
		if(isset($_data['detail']['logo']) && $_data['detail']['logo'])
		{
			$_data['detail']['logourl'] = \lib\filepath::fix($_data['detail']['logo']);
		}

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

		if(array_key_exists('key', $_data))
		{
			$f201['footer_key'] = $_data['key'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_key'))
		{
			$f201['footer_key'] = a($_saved_detail, 'detail', 'footer_key');
		}

		$image_path = null;

		if(\dash\request::files('logo'))
		{
			$image_path = \dash\upload\website::upload_image('logo');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}
		else
		{
			if(isset($_saved_detail['detail']['logo']))
			{
				$image_path = $_saved_detail['detail']['logo'];
			}
		}

		if($_data['remove_footer_logo'] === 'logo')
		{
			$image_path = null;
		}

		$f201['logo'] = $image_path;


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $f201);

		unset($saved_detail['logourl']);
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

		unset($_data['remove_footer_logo']);

		return $_data;

	}
}
?>