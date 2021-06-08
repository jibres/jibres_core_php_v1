<?php
namespace content_site;


class call_function
{
	private static function _namespace($_child = null)
	{
		if(!$_child)
		{
			$_child = \dash\url::child();
		}

		return '\\content_site\\ganje\\'. $_child. '\\%s';
	}




	public static function default($_child = null)
	{
		$namespace = self::_namespace($_child);

		$namespace = sprintf($namespace, 'option');

		$full_option_list = call_user_func([$namespace, 'option'], 'full');

		if(isset($full_option_list['default']) && is_array($full_option_list['default']))
		{
			return $full_option_list['default'];
		}

		return [];
	}



	public static function __callStatic($_fn, $_args)
	{
		if(isset($_args[0]) && is_string($_args[0]))
		{
			$namespace = self::_namespace($_args[0]);
		}
		else
		{
			$namespace = self::_namespace();
		}

		$namespace = sprintf($namespace, 'option');

		if(is_callable([$namespace, $_fn]))
		{
			return call_user_func([$namespace, $_fn], ...$_args);
		}
		else
		{
			var_dump(func_get_args(), $namespace);exit;
		}
	}


	public static function layout($_child = null, $_args = [])
	{
		$namespace = self::_namespace($_child);

		$namespace = sprintf($namespace, 'layout');

		if(is_callable([$namespace, 'layout']))
		{
			return call_user_func([$namespace, 'layout'], $_args);
		}

		return null;
	}






	public static function option_admin_html($_option, $_args)
	{
		$fn = ['\\content_site\\options\\'. $_option, 'admin_html'];

  		return call_user_func($fn, $_args);
	}


	public static function option_specialsave($_option, $_args)
	{
		$fn = ['\\content_site\\options\\'. $_option, 'specialsave'];

		if(is_callable($fn))
		{
			return call_user_func($fn);
		}
		else
		{
			\dash\notif::error(T_("Can not save this special option"));
			return false;
		}

	}

	public static function option_validator($_option, $_args)
	{
		$fn = ['\\content_site\\options\\'. $_option, 'validator'];

  		return call_user_func($fn, $_args);
	}




}
?>