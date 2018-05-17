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

		$log_meta =
		[
			'data' => $_id,
			'meta' =>
			[],
		];

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\app::log('api:product:title:not:set', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Product title can not be null"), 'title');
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);
		$log_meta['meta']['deleted_rows'] = $result;

		if(!$result)
		{
			\dash\app::log('api:product:delete:access:denide', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Can not access to delete this product"), 'product');
			return false;
		}

		$check_foreign = \lib\db\factors::get(['product_id' => $id, 'limit' => 1]);
		if(isset($check_foreign['id']))
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
			\dash\app::log('api:product:deleted', \dash\user::id(), $log_meta);
			\dash\notif::ok(T_("Product was deleted"));
			return true;
		}
		else
		{
			$log_meta['meta']['mysql_error'] = \dash\db::error();
			\dash\app::log('api:product:can:not:deleted', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("We can not delete this product"));
			return false;
		}
	}
}
?>