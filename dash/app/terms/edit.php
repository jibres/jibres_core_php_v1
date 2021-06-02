<?php
namespace dash\app\terms;


class edit
{
	public static function edit($_args, $_id)
	{

		\dash\permission::access('cmsManageTag');

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit term"), 'term');
			return false;
		}

		// check args
		$args = \dash\app\terms\check::variable($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\db\terms\update::update($args, $id);

			if(isset($args['url']))
			{
				\lib\app\menu\update::hashtag($id, true);
			}

			\dash\utility\sitemap::hashtag($id);

			\dash\notif::ok(T_("Tag successfully updated"));
		}
		else
		{
			\dash\notif::info(T_("Tag save without changes"));
		}

		return true;
	}
}
?>