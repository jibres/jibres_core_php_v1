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

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
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
				case 'discount':
					$value = \lib\price::down($value);
					$result[$key] = $value;
					break;

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

		return $result;
	}
}
?>