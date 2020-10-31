<?php
namespace lib\app\form\tag;


class edit
{


	public static function edit($_args, $_id, $_properties = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$args = \lib\app\form\tag\check::variable($_args, $_id, $_properties);

		if(!$args)
		{
			return false;
		}

		$get_tag = \lib\db\form_tag\get::one($_id);

		if(isset($get_tag['id']) && isset($get_tag['title']) && $get_tag['title'] == $args['title'])
		{
			if(floatval($get_tag['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate tag founded"), 'tag');
				return false;
			}
		}



		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			foreach ($get_tag as $field => $value)
			{
				if(array_key_exists($field, $args) && \dash\validate::is_equal($args[$field], $value))
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your answer tag"));
				return null;
			}
			else
			{
				$update = \lib\db\form_tag\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('formTagUpdated', ['old' => $get_tag, 'change' => $args]);
					\dash\notif::ok(T_("The tag successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('form_tagDbCannotUpdate');
					\dash\notif::error(T_("Can not update your answer tag"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::info(T_("Tag saved without chnage"));
			return false;
		}
	}


}
?>