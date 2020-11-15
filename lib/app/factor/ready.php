<?php
namespace lib\app\factor;



class ready
{


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function row($_data)
	{
		$product_ready = [];

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'product_id':
					$result[$key] = $value;
					$product_ready['id'] = $value;
					break;

				case 'thumb':
					$result[$key] = $value;
					$product_ready['thumb'] = $value;
					break;

				case 'customer':
					if($value)
					{
						$value = \dash\coding::encode($value);
					}
					$result[$key] = $value;
					break;

				case 'id' :
					$result[$key] = $value;
					$result['id_code'] = 'JF'. $value;
					break;

				case 'qty':
				case 'count':
					$value = \lib\number::down($value);
					$result[$key] = $value;
					break;


				case 'price':
				case 'shipping':
				case 'finalprice':
				case 'vat':
					$value = \lib\price::down($value);
					$result[$key] = $value;
					break;

				case 'discount':
				case 'subvat':
				case 'subdiscount':
				case 'subprice':
				case 'subtotal':
				case 'total':
				case 'sum':
					$value = \lib\price::down($value);
					$value = \lib\number::down($value);
					$result[$key] = $value;
					break;

				case 'type':
					$result[$key] = $value;
					switch ($value)
					{
						case 'sale': 		$t_type = T_("Sale");				break;
						case 'buy': 		$t_type = T_("Buy");				break;
						case 'presell': 	$t_type = T_("Presell");			break;
						case 'lending': 	$t_type = T_("Lending");			break;
						case 'backbuy': 	$t_type = T_("Back buy");			break;
						case 'backsell': 	$t_type = T_("Back sell");			break;
						case 'waste': 		$t_type = T_("Waste");				break;
						case 'saleorder': 	$t_type = T_("Sale order");			break;
						default:			$t_type = T_("Unknown");			break;
					}
					$result['t_type'] = $t_type;
					break;

				case 'status':
					$result[$key] = $value;
					switch ($value)
					{
						case 'enable': 				$t_status = T_("Enable");				break;
						case 'disable': 			$t_status = T_("Disable");				break;
						case 'draft': 				$t_status = T_("Draft");				break;
						case 'order': 				$t_status = T_("Order");				break;
						case 'expire': 				$t_status = T_("Expire");				break;
						case 'cancel': 				$t_status = T_("Cancel");				break;
						case 'pending_pay': 		$t_status = T_("Pending pay");			break;
						case 'pending_verify': 		$t_status = T_("Pending verify");		break;
						case 'pending_prepare': 	$t_status = T_("Pending prepare");		break;
						case 'pending_send': 		$t_status = T_("Pending send");			break;
						case 'sending': 			$t_status = T_("Sending");				break;
						case 'deliver': 			$t_status = T_("Deliver");				break;
						case 'reject': 				$t_status = T_("Reject");				break;
						case 'spam': 				$t_status = T_("Spam");					break;
						case 'deleted': 			$t_status = T_("Deleted");				break;
						default:					$t_status = T_("Unknown");				break;
					}
					$result['t_status'] = $t_status;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(!empty($product_ready))
		{
			$product_ready           = \lib\app\product\ready::row($product_ready, ['check_allow_shop' => false, 'check_cart_limit' => false]);
			$result['edit_url']      = \dash\get::index($product_ready, 'edit_url');
			$result['thumb']         = \dash\get::index($product_ready, 'thumb');
			$result['thumb_default'] = \dash\get::index($product_ready, 'thumb_default');
		}

		return $result;
	}


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function detail($_data)
	{
		$product_ready = [];

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'product_id':
					$result[$key] = $value;
					$product_ready['id'] = $value;
					break;

				case 'thumb':
					$result[$key] = $value;
					$product_ready['thumb'] = $value;
					break;



				case 'qty':
				case 'count':
					$value = \lib\number::down($value);
					$result[$key] = $value;
					break;


				case 'price':
				case 'discount':
				case 'finalprice':
				case 'vat':
					$value = \lib\price::down($value);
					$result[$key] = $value;
					break;


				case 'sum':
					$value = \lib\price::down($value);
					$value = \lib\number::down($value);
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(!empty($product_ready))
		{
			$product_ready           = \lib\app\product\ready::row($product_ready, ['check_allow_shop' => false, 'check_cart_limit' => false]);
			$result['edit_url']      = \dash\get::index($product_ready, 'edit_url');
			$result['thumb']         = \dash\get::index($product_ready, 'thumb');
			$result['thumb_default'] = \dash\get::index($product_ready, 'thumb_default');
		}

		return $result;
	}
}
?>