<?php
namespace content_a\setting3\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'));

		// remove sidebar
		\dash\data::include_m2('wide');

		// set back link
		self::set_back_btn();


	}


	/**
	 * Detect url and set back link
	 */
	private static function set_back_btn()
	{
		if(\dash\url::subchild())
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::that());
		}
		elseif(\dash\url::child())
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}
		else
		{
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::here());
		}
	}


	/**
	 * Input hidden for switch in model
	 *
	 * @param      <type>  $_value  The value
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function switcher($_value, $_html = false)
	{
		$args =
		[
			'type'  => 'hidden',
			'name'  => model::get_switcher_name(),
			'value' => $_value,
		];

		if(!$_html)
		{
			return $args;
		}

		return \dash\layout\elements\input::hidden($args);
	}



	public static function general()
	{
		$list = [];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Business title"),
			'desc'        => T_("This title use in your business"),
			'input'       =>
			[
				self::switcher('set_title'),

				[
					'type'        => 'text',
					'name'        => 'title',
					'value'       => \lib\store::title(),
					// 'placeholder' => 'Title',
				],
			],
		];


		$list[] =
		[
			'option_mode' => 'input',
			'title'       => T_("Business industry"),
			'desc'        => T_("About your industry"),
			'input'       =>
			[
				self::switcher('set_industry'),
				[
					'type'  => 'select',
					'name'  => 'industry',
					'value' => \lib\store::detail('industry'),
					'list'  => \lib\app\store\check::industry_list(),
				],
			],
		];

		$list['address'] =
		[
			'option_mode'  => 'btn',
			'special_html' => 'address',
			'title'        => T_("Busienss address"),
			'desc'         => T_("This address will appear on your invoices."),
			'btn_link'     => \dash\url::that(). '/address',
			'btn_title'    => T_("Edit address"),

		];

		return $list;

	}


}
?>