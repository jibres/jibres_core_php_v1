<?php
namespace content_site\options;


class conflict
{
	private static $p = [];

	public static function detect($_preview)
	{
		static::$p = $_preview;

		$fn_list = get_class_methods(get_called_class());

		foreach ($fn_list as $key => $fn)
		{
			if(substr($fn, 0, 1) === '_')
			{
				$new_preview = call_user_func(['static', $fn]);

				if($new_preview === false)
				{
					return $new_preview;
				}

				if(is_array($new_preview) && $new_preview)
				{
					return $new_preview;
				}
			}
		}


		return null;

	}


	private static function has()
	{
		$args = func_get_args();

		foreach ($args as $key => $index)
		{
			if(!array_key_exists($index, static::$p))
			{
				return false;
			}
		}

		return true;
	}


	private static function in($_array, $_index)
	{
		return in_array(static::p($_index), $_array);
	}


	private static function p($_index)
	{
		return a(static::$p, $_index);
	}

	private static function r($_replace)
	{
		return array_merge(static::$p, $_replace);
	}


	private static function _product_slider_size()
	{
		if(static::has('slider_effect', 'container'))
		{
			if(static::in(['flip', 'fade', 'cube'], 'slider_effect') && static::p('container') === 'fluid')
			{
				\dash\notif::warn(T_("The effect of your choice cannot be adjusted to 100% width. The width settings automatically return to the previous state"), ['alerty' => true]);

				\content_site\utility::need_redirect(true);

				return static::r(['container' => 'lg']);
			}
		}
	}
}
?>