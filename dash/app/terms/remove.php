<?php
namespace dash\app\terms;


class remove
{


	public static function remove_action($_id, $_action)
	{
		$load = \dash\app\terms\get::get($_id);

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
				$load_new = \dash\app\terms\get::get($_action['new_tag_id']);

				if(!isset($load_new['id']))
				{
					\dash\notif::error(T_("Invalid tag id"));
					return false;
				}

				\dash\db\termusages\update::category_usage_cat_id(\dash\coding::decode($load['id']), \dash\coding::decode($load_new['id']));
			}
			else
			{
				\dash\notif::error(T_("Please select one tag"));
				return false;
			}
		}
		else
		{
			// remove this tag from all post
			\dash\db\termusages\delete::category_usage_cat_id(\dash\coding::decode($load['id']));
		}

		return self::remove($_id);

	}


	public static function remove($_id)
	{
		if(!\dash\permission::check('manageProductTag'))
		{
			return false;
		}


		$load = \dash\app\terms\get::get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			\dash\notif::error(T_("Some post save by this tag and you can not remove it"));
			return false;
		}


		\dash\db\terms\delete::record(\dash\coding::decode($_id));

		\dash\notif::ok(T_("Tag successfully removed"));

		return true;
	}


}
?>