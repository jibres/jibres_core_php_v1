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
	public static function switcher($_value, $_return = false)
	{
		$args =
		[
			'type'  => 'hidden',
			'name'  => model::get_switcher_name(),
			'value' => $_value,
		];

		if(!$_return)
		{
			return $args;
		}

		if($_return === 'array')
		{
			return [$args['name'] => $args['value']];
		}

		return \dash\layout\elements\input::hidden($args);
	}



}
?>