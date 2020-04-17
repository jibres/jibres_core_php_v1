<?php
namespace lib\app\nic_domainbilling;


class ready
{
	public static function row($_data, $_transaction_detail)
	{
		$result = [];

		if(!is_array($_data))
		{
			$_data = [];
		}

		$price  = 0;
		$domain = null;
		$action = null;

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'domain_id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'transaction_id':

					$result['payed'] = null;

					if(isset($_transaction_detail[$value]['condition']))
					{
						if($_transaction_detail[$value]['condition'] === 'request')
						{
							$result['payed'] = false;
						}
					}

					if(isset($_transaction_detail[$value]['verify']))
					{
						if($_transaction_detail[$value]['verify'])
						{
							$result['payed'] = true;
						}
					}

					break;

				case 'period':
					$result[$key] = $value;
					$result['period_title'] = \dash\fit::number(round($value / 12)). ' '. T_("Year");
					break;

				case 'price':
					$price        = $value;
					$result[$key] = $value;
					break;

				case 'name':
					$domain           = $value;
					$result['domain'] = $value;
					break;

				case 'detail':
					$detail = [];
					if($value && is_string($value))
					{
						$detail = json_decode($value, true);
					}
					$result[$key] = $detail;
					break;

				case 'user_id':
					// not show user id to users
					break;

				case 'action':
					$result[$key] = $value;
					switch ($value)
					{
						case 'register':
							$result['taction'] = T_("Register domain");
							$result['class']   = '';
							$result['icon']    = '<i class="sf-cart-plus fc-green"></i>';
							break;

						case 'renew':
							$result['taction'] = T_("Renew Domain");
							$result['class']   = '';
							$result['icon']    = '<i class="sf-refresh fc-blue"></i>';
							break;

						case 'transfer':
							$result['taction'] = T_("Transfer Domain");
							$result['class']   = '';
							$result['icon']    = '<i class="sf-exchange fc-green"></i>';
							break;

						default:
							$result['taction'] = $value;
							break;
					}

					$action = $result['taction'];
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(array_key_exists('payed', $result) && $result['payed'] === false)
		{
			// nothing
		}
		else
		{
			unset($result['detail']['pay_link']);
		}

		if($action)
		{
			$result['title'] = T_("Pay :price toman fro :action domain :domain", ['price' => $price, 'action' => $action, 'domain' => $domain]);
		}


		return $result;
	}
}
?>