<?php
namespace lib\app\category;


class edit
{


	public static function edit($_args, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productCategoryListEdit'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$args = \lib\app\category\check::variable($_id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category = \lib\db\productcategory\get::one($_id);

		if(isset($get_category['id']) && isset($get_category['title']) && $get_category['title'] == $args['title'])
		{
			if(intval($get_category['id']) === intval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate category founded"), 'category');
				return false;
			}
		}


		if(!\dash\app::isset_request('parent'))
		{
			unset($args['parent1']);
			unset($args['parent2']);
			unset($args['parent3']);
			unset($args['parent4']);
		}

		if(!\dash\app::isset_request('title')) 		unset($args['title']);
		if(!\dash\app::isset_request('slug')) 		unset($args['slug']);
		if(!\dash\app::isset_request('desc')) 		unset($args['desc']);
		if(!\dash\app::isset_request('file')) 		unset($args['file']);
		if(!\dash\app::isset_request('seodesc')) 	unset($args['seodesc']);
		if(!\dash\app::isset_request('seotitle')) 	unset($args['seotitle']);


		if(!empty($args))
		{
			foreach ($get_category as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product category"));
				return null;
			}
			else
			{
				$update = \lib\db\productcategory\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('productCategoryUpdated', ['old' => $get_category, 'change' => $args]);
					\dash\notif::ok(T_("The category successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productcategoryDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product category"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::error(T_("No data received!"));
			return false;
		}
	}


}
?>