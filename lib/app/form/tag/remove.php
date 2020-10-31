<?php
namespace lib\app\form\tag;


class remove
{


	public static function remove_action($_id, $_action)
	{
		$load = \lib\app\form\tag\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			// ok
		}
		else
		{
			return self::remove($_id);
		}

		if(isset($_action['type']) && $_action['type'] === 'select_new_tag')
		{
			if(isset($_action['new_tag_id']))
			{
				$load_new = \lib\app\form\tag\get::inline_get($_action['new_tag_id']);

				if(!isset($load_new['id']))
				{
					\dash\notif::error(T_("Invalid tag id"));
					return false;
				}

				\lib\db\form_tagusage\update::tag_usage_tag_id($load['id'], $load_new['id']);
			}
			else
			{
				\dash\notif::error(T_("Please select one tag"));
				return false;
			}
		}
		else
		{
			// remove this tag from all answer
			\lib\db\form_tagusage\delete::tag_usage_tag_id($load['id']);
		}

		return self::remove($_id);

	}


	public static function remove($_id)
	{

		$load = \lib\app\form\tag\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			\dash\notif::error(T_("Some answer save by this tag and you can not remove it"));
			return false;
		}


		\lib\db\form_tag\delete::record($_id);

		\dash\notif::ok(T_("Tag successfully removed"));

		return true;
	}


}
?>