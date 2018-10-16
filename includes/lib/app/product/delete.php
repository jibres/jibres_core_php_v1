<?php
namespace lib\app\product;

trait delete
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function delete($_id, $_option = [])
	{

		if(!\dash\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid product"), 'title');
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			\dash\notif::error(T_("Product not found"), 'product');
			return false;
		}

		$check_foreign = \lib\db\factordetails::get(['product_id' => $id, 'limit' => 1]);

		if($check_foreign)
		{
			\dash\notif::error(T_("This product is exist in your factors list, can not remove it!"), 'product');
			return false;
		}

		$result = \lib\db\productprices::delete_where(['product_id' => $id]);
		if($result)
		{
			$result = \lib\db\products::delete($id);
		}

		if($result)
		{
			\dash\log::set('productDeleted');
			\dash\notif::ok(T_("Product was deleted"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("We can not delete this product"));
			return false;
		}
	}
}
?>