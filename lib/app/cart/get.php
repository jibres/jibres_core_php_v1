<?php
namespace lib\app\cart;


class get
{
	public static function my_cart_count()
	{
		if(!\dash\user::id())
		{
			if(!\dash\user::get_user_guest())
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		if(\dash\user::id())
		{
			$user_cart_count = \lib\db\cart\get::user_cart_count(\dash\user::id());
		}
		else
		{
			$user_cart_count = \lib\db\cart\get::user_cart_count_guest(\dash\user::get_user_guest());
		}


		$user_cart_count = intval($user_cart_count);

		return $user_cart_count;
	}


	public static function my_cart_list()
	{
		if(!\dash\user::id())
		{
			if(!\dash\user::get_user_guest())
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		if(\dash\user::id())
		{
			$user_cart = \lib\db\cart\get::user_cart(\dash\user::id());
		}
		else
		{
			$user_cart = \lib\db\cart\get::user_cart_guest(\dash\user::get_user_guest());
		}


		if(!$user_cart)
		{
			\dash\notif::info(T_("Your cart is empty!"));
			return null;
		}

		$product_ids = array_column($user_cart, 'product_id');
		$product_ids = array_filter($product_ids);
		$product_ids = array_unique($product_ids);

		if(!$product_ids)
		{
			\dash\notif::info(T_("No product founded in your cart!"));
			return null;
		}

		$some_field =
		[
			"products.id",
            "products.title",
            "products.finalprice",
            "products.discountpercent",
            "products.discount",
            "products.price",
            "products.gallery",
        ];

        $some_field = implode(',', $some_field);

		$load_product_detail = \lib\db\products\get::some_field_by_multi_id(implode(',', $product_ids), $some_field);

		$load_product_detail = array_map(['self', 'for_api'], $load_product_detail);

		$load_product_detail = array_combine(array_column($load_product_detail, 'id'), $load_product_detail);

		foreach ($user_cart as $key => $value)
		{
			if(isset($load_product_detail[$value['product_id']]))
			{
				$user_cart[$key]['product_detail'] = $load_product_detail[$value['product_id']];
			}
			unset($user_cart[$key]['user_id']);
		}
		return $user_cart;
	}


	/**
	 * ready record for export
	 */
	private static function for_api($_data, $_option = [])
	{
		$_data = \lib\app\product\ready::row($_data);

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case "vatprice":
				case "buyprice":
				case "seodesc":
				case "desc":
				case "barcode":
				case "barcode2":
				case "cat_id":
				case "unit_id":
				case "company_id":
				case "sku":
				case "salestep":
				case "minstock":
				case "maxstock":
				case "minsale":
				case "maxsale":
				case "scalecode":
				case "fileaddress":
				case "status":
				case "vat":
				case "trackquantity":
				case "oversale":
				case "variant_child":
				case "parent":

				case 'datecreated':
				case 'datemodified':
				case 'creator':
				// case 'gallery_array':
				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
				case 'saleonline':
				case 'carton':
				case 'variants':
				// case 'thumb':

					// skipp show this fields
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>