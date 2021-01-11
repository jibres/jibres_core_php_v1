<?php
namespace lib\app\menu;


class edit
{
	public static function edit($_args, $_id)
	{
		\dash\permission::access('_group_setting');

		$load = \lib\app\menu\get::get($_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\menu\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$exception = [];
		if(isset($_args['parent']))
		{
			$exception[] = 'parent1';
			$exception[] = 'parent2';
			$exception[] = 'parent3';
			$exception[] = 'parent4';
			$exception[] = 'parent5';
		}

		if(isset($args['product_id']) || isset($args['post_id']) || isset($args['tag_id']) || isset($args['hashtag_id']))
		{
			$exception[] = 'related_id';
		}

		if(isset($args['socialnetwork']))
		{
			$exception[] = 'url';
		}


		$args = \dash\cleanse::patch_mode($_args, $args, $exception);

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\menu\update::update($args, $_id);

		\dash\notif::ok(T_("Menu updated"));

		return true;
	}
}
?>