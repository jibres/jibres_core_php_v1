<?php
namespace lib\pagebuilder\footer\f100;


class f100
{
	public static function detail()
	{
		return
		[
			'key'         => 'f100',
			'mode'        => 'footer',
			'title'       => T_("Footer 100"),
			'description' => T_("Beautifull footer"),
			'btn_title'   => T_("Choose this footer"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The f100 contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'        => T_("Footer setting"),
				'btn_preview'       => \lib\store::url(),

				// 'btn_advance' => \dash\url::that(). '/advance'. \dash\request::full_get(),
				// 'btn_save'    => true,
				// 'allow_html'  => true,
			],
			'contain' =>
			[
				'change'         => true,


				'menu1'          => true,


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

		return $_data;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$f100 = [];

		if(array_key_exists('key', $_data))
		{
			$f100['footer_key'] = $_data['key'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_key'))
		{
			$f100['footer_key'] = a($_saved_detail, 'detail', 'footer_key');
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

		$f100['logo'] = $image_path;


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $f100);

		unset($saved_detail['logourl']);

		$_data['detail'] = json_encode($saved_detail, JSON_UNESCAPED_UNICODE);

		if(\lib\pagebuilder\tools\tools::in('announcement'))
		{
			// needless to redirect
		}
		else
		{
			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::that(). \dash\request::full_get());
		}


		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['remove_footer_logo']);

		return $_data;

	}
}
?>