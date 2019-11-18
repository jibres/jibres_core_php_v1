<?php
namespace lib\app\product;

class remove
{
	public static function product($_id)
	{
		$product_detail = \lib\app\product\get::inline_get($_id);
		if(!isset($product_detail['id']))
		{
			return false;
		}
		// check have factor ?
		$use_in_factor = false;
		if($use_in_factor)
		{
			\lib\db\products\db::update_status('deleted', $_id);
		}
		else
		{
			// remove tag
			// remove fileusage
			// remove product price
			\lib\db\productprices\db::delete_by_product_id($_id);
			// remove product
			\lib\db\products\db::delete($_id);
		}
		\dash\notif::ok(T_("Product removed"));
		return true;
	}

}
?>