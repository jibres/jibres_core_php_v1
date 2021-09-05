<?php
namespace lib\pagebuilder\header\rafiei;


class rafiei
{
	public static function allow()
	{
		if(\lib\store::enterprise() === 'rafiei')
		{
			return true;
		}

		return false;
	}

	public static function detail()
	{
		return
		[
			'key'          => 'rafiei',
			'mode'         => 'header',
			'title'        => T_("Rafiei"),
			'title'        => T_("Header #Rafiei"),
			'description'         => T_("An enterprise theme for rafiei"),

			'btn_title'    => T_("Choose this template"),
			// 'sample_image' => \dash\url::cdn(). '/img/template/header/header100.jpg',
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The rafiei contain
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
				'logo'           => true,
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
		if(isset($_data['detail']['logo']) && $_data['detail']['logo'])
		{
			$_data['detail']['logourl'] = \lib\filepath::fix($_data['detail']['logo']);
		}

		if((isset($_data['detail']['header_menu_1']) && $_data['detail']['header_menu_1']) || (isset($_data['detail']['header_menu_2']) && $_data['detail']['header_menu_2']))
		{
			$_data['detail']['have_header_menu'] = true;
		}

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$rafiei = [];

		if(array_key_exists('key', $_data))
		{
			$rafiei['header_key'] = $_data['key'];
		}
		elseif(a($_saved_detail, 'detail', 'header_key'))
		{
			$rafiei['header_key'] = a($_saved_detail, 'detail', 'header_key');
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

		if($_data['remove_header_logo'] === 'logo')
		{
			$image_path = null;
		}

		$rafiei['logo'] = $image_path;


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $rafiei);

		unset($saved_detail['logourl']);
		unset($saved_detail['have_header_menu']);

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

		unset($_data['remove_header_logo']);

		return $_data;

	}
}
?>