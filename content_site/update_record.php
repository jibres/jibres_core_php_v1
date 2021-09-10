<?php
namespace content_site;


class update_record
{
	private static $need_update_record_field = [];

	/**
	 * Save some field to update
	 *
	 * @param      <type>  $_set   The set
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function need_update_record_field($_set = null)
	{
		if($_set && is_array($_set))
		{
			self::$need_update_record_field = $_set;
		}
		else
		{
			return self::$need_update_record_field;
		}
	}


	public static function patch_field($_section_id, $_field, $_value)
	{
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\sitebuilder\get::by_id_lock($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"));

			return false;
		}

		\lib\db\sitebuilder\update::record([$_field => $_value], $_section_id);

		\dash\pdo::commit();

		return true;

	}
}
?>