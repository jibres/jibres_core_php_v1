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

		if(!\lib\user::id())
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

		$id = \lib\utility\shortURL::decode($_id);
		if(!$id)
		{
			\lib\app::log('api:product:title:not:set', \lib\user::id(), $log_meta);
			\lib\debug::error(T_("Product title can not be null"), 'title');
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);
		$log_meta['meta']['deleted_rows'] = $result;

		if(!$result)
		{
			\lib\app::log('api:product:delete:access:denide', \lib\user::id(), $log_meta);
			\lib\debug::error(T_("Can not access to delete this product"), 'product');
			return false;
		}


		$result = \lib\db\productprices::delete_where(['product_id' => $id]);
		if($result)
		{
			$result = \lib\db\products::delete($id);
		}

		if($result)
		{
			\lib\app::log('api:product:deleted', \lib\user::id(), $log_meta);
			\lib\debug::true(T_("Product was deleted"));
			return true;
		}
		else
		{
			$log_meta['meta']['mysql_error'] = \lib\db::error();
			\lib\app::log('api:product:can:not:deleted', \lib\user::id(), $log_meta);
			\lib\debug::error(T_("We can not delete this product"));
			return false;
		}
	}
}
?>