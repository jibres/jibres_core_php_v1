<?php
namespace lib\sitebuilder;


class options
{

	/**
	 * Get option list
	 * return everything need
	 *
	 * @param      <type>  $_options  The options
	 * @param      array   $_args     The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_options, $_mode = null)
	{
		if(!$_mode)
		{
			return array_keys($_options);
		}

		if($_mode === 'full')
		{
			return $_options;
		}

		if($_mode === 'default')
		{
			$default = [];
			foreach ($_options as $key => $value)
			{
				if(!is_array($value))
				{
					$default[$key] = $value;
				}
				else
				{
					foreach ($value as $k => $v)
					{
						$default[$k] = $v;
					}
				}
			}

			return $default;
		}
	}



	public static function admin_html($_options, $_section_detail)
	{
		$html = '';

		foreach ($_options as $option)
		{
			$fn = ['\\lib\\sitebuilder\\options\\'. $option, 'admin_html'];

			$html .= call_user_func($fn, $_section_detail);
		}

		return $html;
	}


	public static function admin_save($_section_id, $_option, $_value)
	{
		if(!is_string($_option))
		{
			\dash\notif::error(T_("Invalid option"));
			return false;
		}

		$fn = ['\\lib\\sitebuilder\\options\\'. $_option, 'validator'];

		$value = call_user_func($fn, $_value);

		$load_section_lock = \lib\db\pagebuilder\get::by_id($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\notif::error(T_("Invalid section id"));

			return false;
		}

		$load_section_lock = \lib\sitebuilder\ready::section_list($load_section_lock);

		$preview           = $load_section_lock['preview'];

		// save multi option
		if(is_array($value))
		{
			foreach ($value as $index => $val)
			{
				$preview[$index] = $val;
			}
		}
		else
		{
			$preview[$_option] = $value;
		}

		$preview           = json_encode($preview);

		\lib\sitebuilder\section_tools::patch_field($_section_id, 'preview', $preview);

	}
}
?>