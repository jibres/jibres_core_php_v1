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
	public static function check_unique_barcode($_barcode, $_option = [])
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
				'input' => \lib\app::request(),
			]
		];

		$check_exist  = \lib\db\products::get_barcode($_barcode);
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
					$product_id = \lib\app::request('id');
					$product_id = \lib\utility\shortURL::decode($product_id);
					if($product_id && intval($product_id) === intval($check_exist[0]['id']))
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
							$product_id = \lib\utility\shortURL::encode($check_exist[0]['id']);
						}

						if($product_id)
						{
							$link = Protocol. '://'. SubDomain. '.'. Domain. '.'. Tld. '/a/product/edit/general?id='. $product_id;
							$msg = "<a href='$link'>". $msg. '</a>';
						}

						\lib\app::log('app:product:barcode:is:duplicate:', \lib\user::id(), $log_meta);
						\lib\debug::error($msg);
						return false;
					}
				}
				else
				{
					\lib\app::log('app:product:barcode:1:record:havenot:id:error:', \lib\user::id(), $log_meta);
					\lib\debug::error(T_("Undefined error was happend"));
					return false;
				}
			}
			else
			{
				\lib\app::log('more:than:2:product:save:by:one:barcode', \lib\user::id(), $log_meta);
				\lib\debug::error(T_("More than 2 products saved by this barcode"));
				return false;
			}
		}

	}
}
?>
