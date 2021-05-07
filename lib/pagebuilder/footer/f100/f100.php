<?php
namespace lib\pagebuilder\footer\f100;


class f100
{
	public static function allow()
	{
		return true;
	}

	public static function detail()
	{
		// need to disable
		return
		[
			'key'          => 'f100',
			'mode'         => 'footer',
			'title'        => T_("Footer #100"),
			'description'  => T_("This footer contain copy write text and phone number"),
			'btn_title'    => T_("Choose this template"),
			'sample_image' => \dash\url::cdn(). '/img/template/footer/footer100.png',
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
			],
			'contain' =>
			[
				'change'         => true,
				'text'           => ['detail' => ['btn_save' => true, 'allow_html' => true, 'page_title' => T_("Set footer Main text")]],
				'generalsetting' => true,
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
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
		$f100 = [];

		$saved_detail = [];

		if(is_array($_saved_detail['detail']))
		{
			$saved_detail = $_saved_detail['detail'];
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$saved_detail = array_merge($saved_detail, $_data['detail'], $f100);

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