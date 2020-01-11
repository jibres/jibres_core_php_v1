<?php
namespace lib\app\category;


class add
{

	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productCategoryListAdd'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\category\check::variable();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'enable';
		$args['language']    = \dash\language::current();

		$id = \lib\db\productcategory\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productCategoryDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Category successfully added"));


		$result       = [];
		$result['id'] = $id;
		return $result;
	}



}
?>