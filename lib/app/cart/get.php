<?php
namespace lib\app\cart;


class get
{
	public static function detect_hide_address($_data)
	{
		$unique_type = array_values(array_filter(array_unique(array_column($_data, 'type'))));

		if($unique_type === ['file'] || $unique_type === ['service'] || $unique_type === ['file', 'service'] || $unique_type === ['service', 'file'])
		{
			return true;
		}

		return false;
	}


	public static function my_cart_count()
	{
		$guest = \dash\user::get_user_guest();
		if(!\dash\user::id())
		{
			if(!$guest)
			{
				// user not login and not have guest id
				return 0;
			}
		}

		if(\dash\user::id())
		{
			$user_cart_count = \lib\db\cart\get::user_cart_count(\dash\user::id());
		}
		elseif($guest)
		{
			$user_cart_count = \lib\db\cart\get::user_cart_count_guest($guest);
		}
		else
		{
			return 0;
		}


		$user_cart_count = intval($user_cart_count);

		return $user_cart_count;
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