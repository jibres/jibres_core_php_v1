<?php
namespace content_site;


class update_record
{

	public static function patch_field($_section_id, $_field, $_value)
	{
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"));

			return false;
		}

		\dash\pdo\query_template::update('pagebuilder', [$_field => $_value], $_section_id);

		\dash\pdo::commit();

		return true;

	}
}
?>