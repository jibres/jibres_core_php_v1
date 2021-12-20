<?php
namespace lib\app\order;



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
				case 'seller':
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
					$value = floatval($value);
					$result[$key] = $value;
					break;


				case 'price':
				case 'shipping':
				case 'finalprice':
				case 'vat':
					$value = floatval($value);
					$result[$key] = $value;
					break;

				case 'discount':
				case 'subvat':
				case 'subdiscount':
				case 'subprice':
				case 'subtotal':
				case 'total':
				case 'sum':
					$value = floatval($value);
					$value = floatval($value);
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

				case 'paystatus':
					$result[$key] = $value;
					switch ($value)
					{
						case 'awaiting_payment':			$t_paystatus = T_('Awaiting payment'); 			break;
						case 'awaiting_verify_payment':		$t_paystatus = T_('Awaiting Verify payment'); 	break;
						case 'unsuccessful_payment':		$t_paystatus = T_('Unsuccessful payment'); 		break;
						case 'payment_unverified':			$t_paystatus = T_('Payment unverified'); 		break;
						case 'successful_payment':			$t_paystatus = T_('Successful payment'); 		break;
						case 'unpaid':			$t_paystatus = T_('Unpaid'); 		break;
						default:							$t_paystatus = '-';					break;
					}
					$result['t_paystatus'] = $t_paystatus;
					break;


				case 'status':
					$result[$key] = $value;
					switch ($value)
					{
						case 'draft':			$t_status = T_('Draft'); 		break;
						case 'registered':		$t_status = T_('Registered'); 	break;
						case 'awaiting':		$t_status = T_('Awaiting'); 	break;
						case 'confirmed':		$t_status = T_('Confirmed'); 	break;
						case 'cancel':			$t_status = T_('Cancel'); 		break;
						case 'expire':			$t_status = T_('Expire'); 		break;
						case 'preparing':		$t_status = T_('Preparing'); 	break;
						case 'sending':			$t_status = T_('Sending'); 		break;
						case 'delivered':		$t_status = T_('Delivered'); 	break;
						case 'revert':			$t_status = T_('Revert'); 		break;
						case 'success':			$t_status = T_('Success'); 		break;
						case 'archive':			$t_status = T_('Archive'); 		break;
						case 'deleted':			$t_status = T_('Deleted'); 		break;
						case 'spam':			$t_status = T_('Spam'); 		break;
						default:				$t_status = T_("Unknown");		break;
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
			$result['edit_url']      = a($product_ready, 'edit_url');
			$result['thumb']         = a($product_ready, 'thumb');
			$result['thumb_default'] = a($product_ready, 'thumb_default');
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


				case 'title':
				case 'optionname1':
				case 'optionvalue1':
				case 'optionname2':
				case 'optionvalue2':
				case 'optionname3':
				case 'optionvalue3':
					$result[$key] = $value;
					$product_ready[$key] = $value;
					break;


				case 'thumb':
					$result[$key] = $value;
					$product_ready['thumb'] = $value;
					break;



				case 'qty':
				case 'count':
					$value = floatval($value);
					$result[$key] = $value;
					break;


				case 'price':
				case 'discount':
				case 'finalprice':
				case 'vat':
					$value = floatval($value);
					$result[$key] = $value;
					break;


				case 'sum':
					$value = floatval($value);
					$value = floatval($value);
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
			$result['title']      = a($product_ready, 'title');
			$result['edit_url']      = a($product_ready, 'edit_url');
			$result['thumb']         = a($product_ready, 'thumb');
			$result['thumb_default'] = a($product_ready, 'thumb_default');
		}

		return $result;
	}
}
?>