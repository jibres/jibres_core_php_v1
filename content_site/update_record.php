<?php
namespace content_site;


class update_record
{

	public static function patch_preview_field(int $_section_id, array $_value)
	{
		$load_section_lock = \lib\db\pagebuilder\get::by_id($_section_id);

		$preview           = json_decode($load_section_lock['preview'], true);

		foreach ($_value as $index => $val)
		{
			$preview[$index] = $val;
		}

		$preview           = json_encode($preview);

		self::patch_field($_section_id, 'preview', $preview);
	}


	public static function patch_field($_section_id, $_field, $_value)
	{
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Invalid section id"));

			return false;
		}

		\dash\pdo\query_template::update('pagebuilder', [$_field => $_value], $_section_id);

		\dash\pdo::commit();

		return true;

	}
}
?>