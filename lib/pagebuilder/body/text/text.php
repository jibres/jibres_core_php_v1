<?php
namespace lib\pagebuilder\body\text;


class text
{
	public static function detail()
	{
		return
		[
			'key'         => 'text',
			'mode'        => 'body',
			'title'       => T_("Text box"),
			'description' => T_("Simple text!"),
			'btn_title'   => T_("Add Text box"),
		];
	}


	/**
	 * Text element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The text contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title'  => T_("Text box"),
				'btn_advance' => \dash\url::current(). '/advance'. \dash\request::full_get(),
				'btn_save'    => true,
				'allow_html'  => true,
			],
			'contain' =>
			[
				'advance' =>
				[
					'detail' =>
					[
						'page_title' => T_("Setting"),
						'btn_save'   => false,
					],

					'contain' =>
					[
						'title'   => true,
						'avand'   => true,
						'padding' => true,
						'margin'  => true,
						'remove'  => true,
					],
				],
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['html']    = 'real_html';
		return $_args;
	}


	public static function input_required()
	{
		return ['html'];
	}


	public static function input_meta()
	{
		return ['field_title' => ['html' => T_("Text")]];
	}



	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$text = [];

		if(array_key_exists('html', $_data))
		{
			$_data['text'] = \dash\request::post_html();
		}
		elseif(a($_saved_detail, 'text'))
		{
			$text['text'] = a($_saved_detail, 'text');
		}

		\lib\pagebuilder\tools\tools::input_exception('text');


		unset($_data['html']);

		return $_data;

	}
}
?>