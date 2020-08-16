<?php
namespace lib\app\product;

class remove
{
	public static function product($_id)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$product_detail = \lib\app\product\get::inline_get($_id);
		if(!isset($product_detail['id']))
		{
			return false;
		}

		if(isset($product_detail['variant_child']) && $product_detail['variant_child'])
		{
			\dash\notif::error(T_("This product have some child and can not be remove!"));
			return false;
		}

		$parent_id = null;

		if(isset($product_detail['parent']) && $product_detail['parent'])
		{
			$parent_id = $product_detail['parent'];
		}

		\lib\db\products\update::status('deleted', $_id);

		if($parent_id)
		{
			// check other child of this product
			// if no product set as child of this product set variatn_child of this product as null to remove parent product at other time
			\lib\db\products\update::variant_child_calc($parent_id);
		}

		\dash\notif::ok(T_("Product removed"));
		return true;
	}


	public static function remove_variant_option($_optionname, $_optionvalue, $_id, $_i)
	{
		$_optionname  = \dash\validate::string_300($_optionname);
		$_optionvalue = \dash\validate::string_300($_optionvalue);
		$_id          = \dash\validate::id($_id);
		$_i          = \dash\validate::smallint($_i);
		$i = intval($_i);
		if($i === 1 || $i === 2 || $i === 3)
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid option index!"));
			return false;
		}

		if($_optionname && $_optionvalue && $_id)
		{
			\lib\db\products\update::set_status_deleted_variant_option($_optionname, $_optionvalue, $_id, $i);
			\lib\db\products\update::variant_child_calc($_id);
			\dash\notif::ok(T_("All product by :val :col removed", ['val' => $_optionname, 'col' => $_optionvalue]));
			return true;
		}
		else
		{
			\dash\notif::error(T_("No data to remove!"));
			return false;
		}
	}

}
?>