<?php
namespace lib\app\nic_domainaction;


class ready
{
	public static function row($_data, $_transaction_detail = [])
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
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'transaction_id':

					$result['payed'] = null;

					if(isset($_transaction_detail[$value]['condition']))
					{
						if($_transaction_detail[$value]['condition'] === 'request')
						{
							$result['payed'] = false;
							if(isset($_transaction_detail[$value]['datecreated']))
							{
								if(time() - strtotime($_transaction_detail[$value]['datecreated']) > (60*60*24*3))
								{
									$result['payed'] = null;
								}
							}
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
							$result['title'] = T_("Register domain");
							$result['icon']    = '<i class="sf-credit-card fs12-plus fc-green"></i>';
							break;

						case 'renew':
							$result['title'] = T_("Renew Domain");
							$result['icon']    = '<i class="sf-refresh fc-blue"></i>';
							break;

						case 'transfer':
							$result['title'] = T_("Transfer Domain");
							$result['icon']    = '<i class="sf-exchange fc-green"></i>';
							break;


						case 'domain_unlock':
							$result['title'] = T_("Unlock domain");
							$result['icon']    = '<i class="sf-unlock fc-red"></i>';
							break;

						case 'domain_lock':
							$result['title'] = T_("Lock domain");
							$result['icon']    = '<i class="sf-lock fc-green"></i>';
							break;


						case 'changedns':
							$result['title'] = T_("Change domain dns");
							$result['icon']    = '<i class="sf-cogs fc-red"></i>';
							break;

						case 'updateholder':
							$result['title'] = T_("Update domain holder");
							$result['icon']    = '<i class="sf-cogs fc-blue"></i>';
							break;

						case 'domain_buy_ready':
							$result['title'] = T_("Ready to buy domain");
							$result['icon']    = '<i class="sf-credit-card fs12-plus fc-green"></i>';
							break;

						case 'domain_buy_pay_link':
							$result['title'] = T_("Domain register pay link created");
							$result['icon']    = '<i class="sf-credit-card fs12 fc-green"></i>';
							break;

						case 'register_failed':
							$result['title'] = T_("Register domain failed");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-red"></i>';
							break;

						case 'domain_enable_autorenew':
							$result['title'] = T_("Enable domain auto renew");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-green"></i>';
							break;

						case 'domain_disable_autorenew':
							$result['title'] = T_("Disable domain auto renew");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-red"></i>';
							break;

						case 'domain_tranfer_pay_link':
							$result['title'] = T_("Domain transfer pay link created");
							$result['icon']    = '<i class="sf-credit-card fs12 fc-green"></i>';
							break;

						case 'domain_renew_ready':
							$result['title'] = T_("Ready to renew domain");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-green"></i>';
							break;

						case 'domain_renew_pay_link':
							$result['title'] = T_("Domain renew pay link created");
							$result['icon']    = '<i class="sf-credit-card fs12 fc-green"></i>';
							break;

						case 'renew_failed':
						case 'renew_faled':
							$result['title'] = T_("Renew domain failed");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-red"></i>';
							break;

						case 'domain_transfer_ready':
							$result['title'] = T_("Ready transfer domain");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-green"></i>';
							break;

						case 'domain_imported':
							$result['title'] = T_("Import manually domains successful");
							$result['icon']    = '<i class="sf-list fs12 fc-green"></i>';
							break;

						case 'transfer_failed':
							$result['title'] = T_("Transfer domain failed");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-red"></i>';
							break;

						case 'nic_contact_default_set':
							$result['title'] = T_("Change default IRNIC handle");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-blue"></i>';
							break;

						case 'dns_default_set':
							$result['title'] = T_("Change default DNS");
							$result['icon']    = '<i class="sf-info-circle fs12 fc-blue"></i>';
							break;


						case 'delete':
						case 'expire':
						default:
							$result['title'] = $value;
							break;
					}

					$action = $result['title'];
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

		return $result;
	}
}
?>
