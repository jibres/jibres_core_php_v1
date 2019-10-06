<?php
namespace lib\app\product;

trait barcode
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function check_unique_barcode($_barcode, $_id, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		$check_exist  = \lib\db\products::get_barcode($_barcode, \lib\store::id());
		$log_meta['meta']['barcode'] = $check_exist;

		if(!$check_exist)
		{
			return true;
		}
		else
		{
			if(count($check_exist) === 1)
			{
				if(isset($check_exist[0]['id']))
				{
					if($_id && intval($_id) === intval($check_exist[0]['id']))
					{
						// update product by old barcode
						return true;
					}
					else
					{


						$product_title = '';
						if(isset($check_exist[0]['title']))
						{
							$product_title = $check_exist[0]['title'];
						}

						if(isset($check_exist[0]['barcode']) && $_barcode === $check_exist[0]['barcode'])
						{
							$msg = T_("This barcode used as barcode2 :title", ['title' => $product_title]);
						}

						if(isset($check_exist[0]['barcode2']) && $_barcode === $check_exist[0]['barcode2'])
						{
							$msg = T_("This barcode used as barcode2 :title", ['title' => $product_title]);
						}

						$product_id = null;
						if(isset($check_exist[0]['id']))
						{
							$product_id = \dash\coding::encode($check_exist[0]['id']);
						}

						if($product_id)
						{
							$link = \dash\url::this(). '/general?id='. $product_id;
							$msg = "<a href='$link'>". $msg. '</a>';
						}

						\dash\app::log('app:product:barcode:is:duplicate:', \dash\user::id(), $log_meta);
						\dash\notif::error($msg);
						return false;
					}
				}
				else
				{
					\dash\app::log('app:product:barcode:1:record:havenot:id:error:', \dash\user::id(), $log_meta);
					\dash\notif::error(T_("Undefined error was happend"));
					return false;
				}
			}
			else
			{
				\dash\app::log('more:than:2:product:save:by:one:barcode', \dash\user::id(), $log_meta);
				\dash\notif::error(T_("More than 2 products saved by this barcode"));
				return false;
			}
		}

	}
}
?>
