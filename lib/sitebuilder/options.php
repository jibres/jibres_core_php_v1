<?php
namespace lib\sitebuilder;


class options
{
	public static function admin_html($_options, $_section_detail)
	{
		$html = '';

		foreach ($_options as $option)
		{
			$fn = ['\\lib\\sitebuilder\\options\\'. $option, 'admin_html'];

			if(is_callable($fn))
			{
				$html .= call_user_func($fn, $_section_detail);
			}
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

		$value = $_value;

		if(is_callable($fn))
		{
			$value = call_user_func($fn, $_value);
		}
		else
		{
			$value = \dash\validate::string_100($_value);
		}

		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Invalid section id"));

			return false;
		}

		$load_section_lock = \lib\sitebuilder\ready::section_list($load_section_lock);

		$preview           = $load_section_lock['preview'];
		$preview[$_option] = $_value;

		$preview           = json_encode($preview);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $_section_id);

		\dash\pdo::commit();

	}
}
?>