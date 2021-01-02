<?php
namespace dash\app\terms;


class add
{
	public static function multiple($_args)
	{
		$ids = [];
		foreach ($_args as $key => $value)
		{

			$value['multiple_insert'] = true;

			$id = self::add($value, true);

			if($id && !\dash\engine\process::status())
			{
				$ids[] = $id;
				\dash\notif::clean();
				\dash\engine\process::continue();
			}
			elseif(!\dash\engine\process::status())
			{
				return false;
			}

			if(isset($id['id']))
			{
				$ids[] = \dash\coding::decode($id['id']);
			}

		}

		if(min($ids) == max($ids))
		{
			\dash\utility\sitemap::tags(max($ids));
		}
		else
		{
			\dash\utility\sitemap::tags(min($ids));
			\dash\utility\sitemap::tags(max($ids));
		}

		return $ids;
	}


	public static function add($_args, $_multiple = false)
	{

		\dash\permission::access('cmsManagePost');
		// check args
		$args = \dash\app\terms\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return $args;
		}

		$return  = [];

		$term_id = \dash\db\terms\insert::new_record($args);

		if(!$term_id)
		{
			\dash\log::set('noWayToAddTerm');
			\dash\notif::error(T_("No way to insert term"));
			return false;
		}

		$return['id'] = \dash\coding::encode($term_id);


		if(!$_multiple)
		{
			\dash\utility\sitemap::tags($term_id);
		}

		return $return;
	}
}
?>