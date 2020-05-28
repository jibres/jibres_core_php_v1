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



		$args = \lib\app\category\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		unset($args['properties']);

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