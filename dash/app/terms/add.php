<?php
namespace dash\app\terms;


class add
{
	public static function multiple($_args)
	{
		$ids = [];
		foreach ($_args as $key => $value)
		{
			$id = self::add($value);

			if(!\dash\engine\process::status())
			{
				return false;
			}

			if(isset($id['id']))
			{
				$ids[] = \dash\coding::decode($id['id']);
			}

		}

		return $ids;
	}


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