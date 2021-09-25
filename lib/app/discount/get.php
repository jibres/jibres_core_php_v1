<?php
namespace lib\app\discount;


class get
{


	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\discount\get::by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \lib\app\discount\ready::row($result);
		return $result;
	}



	public static function by_code($_code)
	{
		$code = \dash\validate::discount_code($_code, false);

		if(!$code)
		{
			return false;
		}

		$result = \lib\db\discount\get::by_code($code);

		if(!$result)
		{
			return false;
		}

		$result = \lib\app\discount\ready::row($result);

		return $result;
	}


	public static function summary($_id, $_detail)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			return false;
		}

		$result           = [];
		$result['used']   = \lib\db\factors\get::discount_usage_total_count($id);
		$result['lookup'] = \lib\db\discount_lookup\get::count_by_discount_id($id);

		$summary = [];

		if($_detail['type'] === 'percentage')
		{
			if($_detail['percentage'])
			{
				$summary[1] = T_(":val % off", ['val' => \dash\fit::number($_detail['percentage'])]);
			}
		}
		elseif($_detail['type'] === 'fixed_amount')
		{
			if($_detail['fixedamount'])
			{
				$summary[1] = T_(":val :currency off", ['val' => \dash\fit::number($_detail['fixedamount']), 'currency' => \lib\store::currency()]);
			}
		}
		elseif($_detail['type'] === 'free_shipping')
		{
			$summary[1] = T_("Free shipping");
		}


		if($_detail['applyto'] === 'all_products')
		{
			$summary[1] = a($summary, 1). ' '. T_("all prodcut");
		}
		elseif($_detail['applyto'] === 'special_category')
		{
			$summary[1] = a($summary, 1). ' '. T_("special category of products");

		}
		elseif($_detail['applyto'] === 'special_products')
		{
			$summary[1] = a($summary, 1). ' '. T_("special products");

		}


		if($_detail['minrequirements'] === 'amount')
		{
			if($_detail['minpurchase'])
			{
				$summary[] = T_("Minimum purchase :val :currency", ['val' => \dash\fit::number($_detail['minpurchase']), 'currency' => \lib\store::currency()]);
			}
		}
		elseif($_detail['minrequirements'] === 'quantity')
		{
			if($_detail['minquantity'])
			{
				$summary[] = T_("Minimum purchase of :val items", ['val' => \dash\fit::number($_detail['minquantity'])]);
			}
		}

		if($_detail['customer'] === 'everyone')
		{
			$summary[] = T_("Everyone");

		}
		elseif($_detail['customer'] === 'special_customer_group')
		{
			$summary[] = T_("For special customer group");
		}
		elseif($_detail['customer'] === 'special_customer')
		{
			$summary[] = T_("For special customer");
		}


		if($_detail['usagetotal'])
		{
			$summary[3] = T_("Limit of :val uses", ['val' => \dash\fit::number($_detail['usagetotal'])]);
		}

		if($_detail['usageperuser'])
		{
			if(a($summary, 3))
			{
				$summary[3] =  $summary[3]. T_(","). ' ' . T_("one per customer");
			}
			else
			{
				$summary[3] = T_("one per customer");
			}
		}

		if($_detail['status'] === 'enable')
		{
			// check date time
			if($_detail['startdate'])
			{
				if(time() < strtotime($_detail['startdate']))
				{
					$summary[] = T_("Active from :val", ['val' => \dash\fit::date_time($_detail['startdate'])]);
				}
				else
				{
					if($_detail['enddate'])
					{
						if(time() < strtotime($_detail['enddate']))
						{
							$summary[] = T_("Active until :val", ['val' => \dash\fit::date_time($_detail['enddate'])]);
						}
						else
						{
							$summary[] = T_("Was expire at :val", ['val' => \dash\fit::date_time($_detail['enddate'])]);
						}

					}
					else
					{
						$summary[] = T_("Active now");
					}
				}
			}

		}
		else
		{
			$summary[] = T_("Disabled");
		}

		if($result['lookup'])
		{
			$summary[] = T_(":val lookup", ['val' => \dash\fit::number($result['lookup'])]);
		}

		if($result['used'])
		{
			$summary[] = T_(":val used", ['val' => \dash\fit::number($result['used'])]);
		}

		$result['summary'] = $summary;



		return $result;
	}

}
?>