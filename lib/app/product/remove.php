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


}
?>