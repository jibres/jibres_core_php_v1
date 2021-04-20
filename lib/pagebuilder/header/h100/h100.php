<?php
namespace lib\pagebuilder\header\h100;


class h100
{
	public static function detail()
	{
		return
		[
			'key'         => 'h100',
			'mode'        => 'header',
			'title'       => T_("Header 100"),
			'description' => T_("Beautifull header"),
			'btn_title'   => T_("Choose this header"),
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
				'page_title'        => T_("Header setting"),
				'btn_preview'       => \lib\store::url(),
				'allow_upload_file' => true,
				// 'btn_advance' => \dash\url::that(). '/advance'. \dash\request::full_get(),
				// 'btn_save'    => true,
				// 'allow_html'  => true,
			],
			'contain' =>
			[
				'change'                   => true,
				'announcement'             => true,
				'logo'                     => true,
				'menu1'                    => true,
				'menu2'                    => true,
				'business_general_setting' => true,

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

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$h100 = [];

		if(array_key_exists('key', $_data))
		{
			$h100['header_key'] = $_data['key'];
		}
		elseif(a($_saved_detail, 'detail', 'header_key'))
		{
			$h100['header_key'] = a($_saved_detail, 'detail', 'header_key');
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

		$h100['logo'] = $image_path;

		unset($_data['detail']['logourl']);

		if(!empty($h100))
		{
			if(!is_array(a($_data, 'detail')))
			{
				$_data['detail'] = [];
			}

			$_data['detail'] = array_merge($_data['detail'], $h100);

			$_data['detail'] = json_encode($_data['detail'], JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		if(\lib\pagebuilder\tools\tools::in('announcement'))
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