<?php
namespace dash\app\terms;


class add
{
	public static function add($_args)
	{

		\dash\permission::access('cmsAddNewCategory');
		// check args
		$args = \dash\app\terms\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		$term_id = \dash\db\terms::insert($args);

		if(!$term_id)
		{
			\dash\log::set('noWayToAddTerm');
			\dash\notif::error(T_("No way to insert term"));
			return false;
		}

		$return['id'] = \dash\coding::encode($term_id);

		return $return;
	}
}
?>