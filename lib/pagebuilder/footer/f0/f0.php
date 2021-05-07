<?php
namespace lib\pagebuilder\footer\f0;


class f0
{
	public static function allow()
	{
		return true;
	}

	public static function detail()
	{
		return
		[
			'key'          => 'f0',
			'mode'         => 'footer',
			'title'        => T_("Without footer"),
			'btn_title'    => T_("Choose this template"),
			'description'  => T_("Without footer"),
			// 'sample_image' => \dash\url::cdn(). '/img/template/footer/footer300.png',
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The f0 contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'        => T_("Footer setting"),
				// 'btn_preview'       => \lib\store::url(),

				// 'btn_advance' => \dash\url::that(). '/advance'. \dash\request::full_get(),
				// 'btn_save'    => true,
				// 'allow_html'  => true,
			],
			'contain' =>
			[
				'change'         => true,
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['line']               = 'string_100';
		$_args['key']                = 'string_100';


		return $_args;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$f0 = [];

		if(array_key_exists('key', $_data))
		{
			$f0['footer_key'] = $_data['key'];
		}
		elseif(a($_saved_detail, 'detail', 'footer_key'))
		{
			$f0['footer_key'] = a($_saved_detail, 'detail', 'footer_key');
		}


		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $f0);


		$_data['detail'] = json_encode($saved_detail, JSON_UNESCAPED_UNICODE);

		if(\lib\pagebuilder\tools\tools::in('change') || \lib\pagebuilder\tools\tools::in('text'))
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