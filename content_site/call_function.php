<?php
namespace content_site;


class call_function
{

	/**
	 * Detect folder
	 *
	 * header : h1, h2, h[\d+]
	 * footer : f1, f2, f[\d+]
	 * body : other
	 *
	 * @param      <type>  $_section_key  The section key
	 *
	 * @return     string  The folder.
	 */
	public static function get_folder($_section_key)
	{
		if($_section_key === 'header')
		{
			$folder = 'header';
		}
		elseif($_section_key === 'footer')
		{
			$folder = 'footer';
		}
		else
		{
			$folder = 'body';
		}

		return $folder;
	}


	/**
	 * Check is trust folder
	 *
	 * @param      <type>  $_folder  The folder
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function trust_folder($_folder)
	{
		if(is_string($_folder) && in_array($_folder, ['header', 'body', 'footer']))
		{
			return true;
		}
		else
		{
			\dash\header::status(404, T_("Invalid folder"));
		}
	}


	/**
	 * Gets the namespace.
	 *
	 * @param      string  $_section_key  The section key
	 *
	 * @return     string  The namespace.
	 */
	private static function get_namespace($_section_key)
	{
		$folder = self::get_folder($_section_key);

		if($folder === 'header' || $folder === 'footer')
		{
			return '\\content_site\\'. $folder .'\\%s';
		}
		else
		{
			return '\\content_site\\'. $folder .'\\'. $_section_key. '\\%s';
		}

	}


	/**
	 * Get option namespace
	 *
	 * @param      string  $_section_key  The child
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function option_namespace($_option = null)
	{
		$namespace = '\\content_site\\options\\';
		if(strpos($_option, '_') !== false)
		{
			$namespace .= strtok($_option, '_'). '\\';
		}
		else
		{
			$namespace .= $_option. '\\';
		}

		$namespace .= $_option;

		return $namespace;
	}



	/**
	 * Call function
	 *
	 * @param      <model>  $_fn    The function
	 * @param      array   $_args  The arguments
	 *
	 * @return     <model>  ( description_of_the_return_value )
	 */
	private static function _call($_fn, $_args = [], $_args2 = [], $_args3 = [])
	{
		if(is_callable($_fn))
		{
			if($_args2)
			{
				return call_user_func_array($_fn, [$_args, $_args2, $_args3]);
			}
			else
			{
				return call_user_func($_fn, $_args);
			}
		}
		else
		{
			if(\dash\url::isLocal())
			{
				// var_dump(func_get_args());exit;
			}
			return null;
		}
	}


	/**
	 * Check is trust section by check dir exist
	 *
	 * @param      string  $_folder   The folder
	 * @param      <type>  $_section  The section
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function trust_section($_folder, $_section)
	{
		if(self::trust_folder($_folder) && ($section = \dash\validate::string_100($_section)))
		{
			if($_folder === 'header' || $_folder === 'footer')
			{
				$dir = root . '/content_site/'. $section;
			}
			else
			{
				$dir = root . '/content_site/'. $_folder. '/'. $section;
			}

			$dir = \autoload::fix_os_path($dir);

			if(is_dir($dir))
			{
				return true;
			}

		}
		\dash\header::status(404, T_("Invalid section"));
	}


	/**
	 * Call every function you need
	 * @example \content_site\call_function::option();
	 * @example \content_site\call_function::layout();
	 *
	 * @param      <model>  $_fn    The function
	 * @param      <model>  $_args  The arguments
	 *
	 * @return     <model>  ( description_of_the_return_value )
	 */
	public static function __callStatic($_fn, $_args)
	{
		// call option_admin_html
		// call option_validator
		if(substr($_fn, 0, 7) === 'option_')
		{
			$function = substr($_fn, 7);

			$option = null;

			if(isset($_args[0]))
			{
				$option = $_args[0];
			}

			unset($_args[0]);

  			return self::_call([self::option_namespace($option), $function], ...$_args);
		}
		else
		{
			$section_key = a($_args, 0);
			$args        = a($_args, 1);
			$args2       = a($_args, 2);
			$args3       = a($_args, 3);


			$namespace = self::get_namespace($section_key);


			if($_fn === 'layout')
			{
				$namespace = sprintf($namespace, 'layout');

				return self::_call([$namespace, 'layout'], $args);
			}
			elseif($_fn === 'preview')
			{
				$namespace = sprintf($namespace, $args);

				if(self::_call([$namespace, 'is_private']) === true)
				{
					return false;
				}

				$load_preview = self::_call([$namespace, $args2]);

				return $load_preview;
			}
			else
			{
				$namespace = sprintf($namespace, 'option');
				return self::_call([$namespace, $_fn], $args, $args2, $args3);
			}
		}

	}


	/**
	 * Generate all options admin html
	 *
	 * @param      <type>  $_option_key  The option key
	 * @param      <type>  $_data        The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function option_admin_html($_option_key, $_data = [])
	{
		$html = '';

		$namespace = self::option_namespace($_option_key);

		if(utility::ul_li_started())
		{
			$is_ul_li = self::_call([$namespace, 'is_ul_li']);

			if($is_ul_li === null)
			{
				$html .= utility::ul_li_close();
			}
		}

		$html .= self::_call([$namespace, 'admin_html'], $_data);

		return $html;
	}


	/**
	 * Get default option of one section in special model
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function default($_section_key, $_model)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		$model_detail = self::_call([$namespace, 'option']);


		if(isset($model_detail['default']))
		{
			return $model_detail['default'];
		}

		return null;
	}



	/**
	 * Get force option of one section in special model
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function force($_section_key, $_model)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		$model_detail = self::_call([$namespace, 'option']);

		if(isset($model_detail['force']))
		{
			return $model_detail['force'];
		}

		return null;
	}


	/**
	 * Call final html drawer
	 *
	 * @param      string  $_namespace  The namespace
	 * @param      string  $_model      The model
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function final_html($_namespace, $_model)
	{
		$namespace = $_namespace. '\\'. $_model. '_html';

		if(is_callable([$namespace, 'html']))
		{
			$args = func_get_args();
			unset($args[0]);
			unset($args[1]);

			return call_user_func_array([$namespace, 'html'], $args);
		}

		return null;
	}



	/**
	 * Call model previe function
	 *
	 * @param      <type>  $_section_key  The section key
	 * @param      <type>  $_model        The model
	 * @param      <type>  $_preview_key  The preview key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function section_model_preview($_section_key, $_model, $_preview_key)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		return self::_call([$namespace, $_preview_key]);
	}



	/**
	 * Call model previe function
	 *
	 * @param      <type>  $_section_key  The section key
	 * @param      <type>  $_model        The model
	 * @param      <type>  $_preview_key  The preview key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function section_model_premium($_section_key, $_model)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		return self::_call([$namespace, 'premium']);
	}




	/**
	 * Get current option by check model
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function section_options($_section_key, $_model, $_merge_array = false)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		$options = self::_call([$namespace, 'option']);

		if(!$_merge_array)
		{
			return $options;
		}

		if(isset($options['options']) && is_array($options['options']))
		{
			$options = self::merge_array_keys($options['options']);
		}

		return $options;
	}

	private static function merge_array_keys($_array)
	{
		$array = [];

		foreach ($_array as $key => $value)
		{

			if(is_array($value))
			{
				$array[] = $key;
				$array = array_merge($array, self::merge_array_keys($value));
			}
			else
			{
				$array[] = $value;
			}
		}

		return $array;
	}



	/**
	 * Get current option by check model
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_section_key, $_model)
	{
		$namespace   = self::get_namespace($_section_key);

		$namespace   = sprintf($namespace, $_model);

		$model_detail = self::_call([$namespace, 'option']);

		if(isset($model_detail['options']))
		{
			return $model_detail['options'];
		}

		return null;
	}


	/**
	 * Get model list
	 *
	 * @param      <type>  $_section_key  The section key
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function ready_model_list($_section_key)
	{
		$namespace = self::get_namespace($_section_key);

		$model_list = self::model_list($_section_key);


		if(!is_array($model_list))
		{
			$model_list = [];
		}

		$list = [];

		foreach ($model_list as $value)
		{
			$namespace_model = sprintf($namespace, $value);

			if(self::_call([$namespace_model, 'is_private']) === true)
			{
				continue;
			}

			$temp_load_model_option = self::_call([$namespace_model, 'option']);

			$temp_load_model_option['model'] = $value;

			$list[]                = $temp_load_model_option;

		}

		return $list;

	}


	/**
	 * Generate preview layout list
	 *
	 * @param      string  $_section_key      The section key
	 * @param      string  $_filter_category  The filter category
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function preview_list($_section_key, $_filter_category = null)
	{
		$namespace = self::get_namespace($_section_key);

		$preview_functions_string = [];

		$section_detail = self::detail($_section_key);


		$popular = [];
		$popular = self::popular($_section_key);

		if(!is_array($popular))
		{
			$popular = [];
		}


		$model_list = self::model_list($_section_key);

		if(!is_array($model_list))
		{
			$model_list = [];
		}

		foreach ($model_list as $value)
		{
			if($_filter_category && $_filter_category !== 'popular' && $value !== $_filter_category)
			{
				continue;
			}

			$namespace_model = sprintf($namespace, $value);

			$temp_load_model_option = self::_call([$namespace_model, 'option']);

			if(isset($temp_load_model_option['preview_list']) && is_array($temp_load_model_option['preview_list']))
			{
				foreach ($temp_load_model_option['preview_list'] as $temp_preview_list)
				{
					$myPreviewFunc = "$value:$temp_preview_list";
					// if(!in_array($myPreviewFunc, $popular))
					{
						$preview_functions_string[] = $myPreviewFunc;
					}
				}
			}
		}

		if(!$preview_functions_string)
		{
			$preview_functions_string = $popular;
		}

		$list = [];

		foreach ($preview_functions_string as $key => $preview_key)
		{
			$model    = null;
			$preview = null;
			if(strpos($preview_key, ':') !== false)
			{
				$split   = explode(':', $preview_key);

				$model    = $split[0];
				$preview = $split[1];
			}
			else
			{
				$model    = $preview_key;
				$preview = null;
			}

			$namespace_model = sprintf($namespace, $model);

			$load_model_option = self::_call([$namespace_model, 'option']);

			$need_load_preview = [];

			if($preview)
			{
				$need_load_preview[] = $preview;
			}
			else
			{
				if(isset($load_model_option['preview_list']) && is_array($load_model_option['preview_list']))
				{
					$need_load_preview = $load_model_option['preview_list'];
				}
			}

			$demo_url = 'https://demo.jibres.store';

			if(\dash\url::isLocal())
			{
				$demo_url = \dash\url::protocol(). '://demo.myjibres.local';
			}

			foreach ($need_load_preview as $preview_function)
			{
				if(self::_call([$namespace_model, 'is_private']) === true)
				{
					continue;
				}

				$load_preview = self::_call([$namespace_model, $preview_function]);

				if(is_array($load_preview) && $load_preview)
				{
					if(a($load_preview, 'preview_title'))
					{
						$preview_title = $load_preview['preview_title'];
					}
					else
					{
						$preview_title = self::get_preview_title($_section_key, $model, $preview_function);
					}

					$premium = self::_call([$namespace_model, 'premium']);

					$price = 0;

					if($premium === true)
					{
						$folder = self::get_folder($_section_key);

						$feature_key = implode('_', ['site', $folder, $_section_key, $model]);

						// $price = \lib\features\get::price($feature_key);
					}

					$version = (a($load_preview, 'version') ? $load_preview['version'] : 1);

					$list[] =
					[
						'section'       => $_section_key, // new
						'model_title'   => a($load_model_option, 'title'),
						'preview_title' => $preview_title,
						'preview_image' => a($load_preview, 'preview_image'),
						'preview_key'   => $preview_function,
						'version'       => $version,
						'opt_model'     => $model,
						'price'         => $price,
						'premium'       => $premium,
						'demo_url'      => $demo_url  .'/preview/'. $_section_key. '/'. $model. '/'. $preview_function,
						'preview_image' => \dash\url::cdn(). sprintf('/img/sitebuilder/%s/%s/%s.jpg?v=%s', $_section_key, $model, $model. '-'. $preview_function, $version),
					];
				}
			}
		}

		return $list;
	}


	public static function get_preview_title($_section_key, $_model, $_preview_key = null)
	{
		$namespace         = self::get_namespace($_section_key);
		$section_detail    = self::detail($_section_key);
		$namespace_model   = sprintf($namespace, $_model);
		$load_model_option = self::_call([$namespace_model, 'option']);

		$preview_title = '<span class="font-bold text-blue-800">';
		$preview_title .=  a($section_detail, 'title');
		$preview_title .= '</span>';
		$preview_title .= ' ';

		// $preview_title .= ' - ';
		$preview_title .= a($load_model_option, 'title');

		if($_preview_key)
		{
			$int_function = preg_replace("/[^\d]/", '', $_preview_key);
			$preview_title .= ' - ' . T_("Sample :val", ['val' => \dash\fit::number($int_function)]);
		}

		return $preview_title;
	}


	/**
	 * Render a preview html on the fly
	 *
	 * @param      <type>      $_section  The section
	 * @param      <type>      $_model    The model
	 * @param      <type>      $_preview  The preview
	 *
	 * @return     array|bool  ( description_of_the_return_value )
	 */
	public static function generate_preview($_section, $_model, $_preview)
	{
		$namespace = self::get_namespace($_section);

		$default = self::default($_section, $_model);

		if(!is_array($default))
		{
			$default = [];
		}

		$namespace_preview = sprintf($namespace, $_model);

		if(!is_callable([$namespace_preview, $_preview]))
		{
			return false;
		}

		$namespace_layout  = sprintf($namespace, 'layout');


		\content_site\utility::fill_by_default_data(true);

		$preview_default = self::_call([$namespace_preview, $_preview]);

		$preview_default_option = [];

		if(isset($preview_default['options']) && is_array($preview_default['options']))
		{
			$preview_default_option = $preview_default['options'];
		}

		$force_preview_setting =
		[
			'model'       => $_model,
			'height'      => 'fullscreen',
			'preview_key' => $_preview,
		];

		$preview_default = array_merge($default, $preview_default_option, $force_preview_setting);

		$preview_default = self::replace_paw_value($preview_default);

		$preview_default = \content_site\assemble\fire::me($preview_default);

		$preview_html    = self::_call([$namespace_layout, 'layout'], $preview_default);

		$result =
		[
			'preview_key'     => $_preview,
			'preview_default' => $preview_default,
			'preview_html'    => $preview_html,
		];

		\content_site\utility::fill_by_default_data(false);

		return $result;

	}


	/**
	 * Replace pwa value
	 *
	 * @param      <type>  $_data  The data
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function replace_paw_value($_data)
	{
		$is_pwa = \dash\request::is_pwa();

		foreach ($_data as $key => $value)
		{
			if(substr($key, 0, 4) === 'pwa:' && $is_pwa)
			{
				$_data[substr($key, 4)] = $value;
			}
		}

		return $_data;
	}


}
?>