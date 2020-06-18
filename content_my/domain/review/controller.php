<?php
namespace content_my\domain\review;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();


		$id = \dash\validate::code(\dash\request::get('id'));
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\header::status(404, T_("Id not found"));
		}

		$detail = \lib\app\nic_domain\get::by_id($id);
		if(!$detail)
		{
			\dash\header::status(404, T_("Detail not found"));
		}



		$type = \dash\validate::enum(\dash\request::get('type'), true, ['enum' => ['register', 'renew', 'transfer']]);
		if(!$type)
		{
			self::have_error();
		}

		$load_last_activity = \lib\app\nic_domainaction\get::last_record_domain_id($id);

		if(isset($load_last_activity['detail']['dont_know_nic_bill']) && $load_last_activity['detail']['dont_know_nic_bill'])
		{
			\dash\data::nicMaybeError(true);
		}

		if(isset($load_last_activity['detail']['must_set_reseller']) && $load_last_activity['detail']['must_set_reseller'])
		{
			\dash\data::MustSetReseller(true);
		}

		switch (\dash\request::get('type'))
		{
			case 'register':
				if(isset($load_last_activity['action']) && $load_last_activity['action'] === 'domain_buy_ready')
				{
					// no problem
				}
				else
				{
					self::have_error();
				}
				break;

			case 'renew':
				if(isset($load_last_activity['action']) && $load_last_activity['action'] === 'domain_renew_ready')
				{
					// no problem
				}
				else
				{
					self::have_error();
				}

				break;

			case 'transfer':
				if(isset($load_last_activity['action']) && $load_last_activity['action'] === 'domain_transfer_ready')
				{
					// no problem
				}
				else
				{
					self::have_error();
				}

				break;

			default:
				self::have_error();
				break;
		}


		\dash\data::dataRow($detail);
		$domain = \dash\data::dataRow_name();

		if(\dash\validate::ir_domain($domain, false))
		{

			\dash\data::dataRowAction($load_last_activity);

			$period = null;

	        if(\dash\data::dataRowAction_period() == '12')
	        {
	        	$period = '1year';
	        	$periodTitle = T_("1 Year");
	        }
	        elseif(\dash\data::dataRowAction_period() == '60')
	        {
	        	$period = '5year';
	        	$periodTitle = T_("5 Year");
	        }

	        \dash\data::myPeriod($period);
	        \dash\data::myPeriodTitle($periodTitle);

	        $price = 0;

	        if(\dash\request::get('type') === 'register')
	        {
	        	$price = \lib\app\nic_domain\price::register(\dash\data::myPeriod());

	        }
	        elseif(\dash\request::get('type') === 'renew')
	        {
	        	$price = \lib\app\nic_domain\price::renew(\dash\data::myPeriod());
	        }

	        \dash\data::myPrice($price);

		}
		else
		{
			\dash\data::internationalDomain(true);
			if(isset($load_last_activity['period']) && is_numeric($load_last_activity['period']))
			{
				$myPeriodTitle = T_("Unknown");

				switch ($load_last_activity['period'])
				{
					case '1': $myPeriodTitle = T_("1 Year"); break;
					case '2': $myPeriodTitle = T_("2 Year"); break;
					case '3': $myPeriodTitle = T_("3 Year"); break;
					case '4': $myPeriodTitle = T_("4 Year"); break;
					case '5': $myPeriodTitle = T_("5 Year"); break;
					case '6': $myPeriodTitle = T_("6 Year"); break;
					case '7': $myPeriodTitle = T_("7 Year"); break;
					case '8': $myPeriodTitle = T_("8 Year"); break;
					case '9': $myPeriodTitle = T_("9 Year"); break;
					case '10': $myPeriodTitle = T_("10 Year"); break;
				}

				$load_last_activity['period_title'] = $myPeriodTitle;
				\dash\data::myPeriodTitle($myPeriodTitle);

				\dash\data::dataRowAction($load_last_activity);

				$myPrice = 0;

				$myPrice = \lib\app\onlinenic\price::get_price($domain, $load_last_activity['period'], \dash\request::get('type'));

				\dash\data::myPrice($myPrice);
				\dash\data::myPeriod($load_last_activity['period']);
			}
			else
			{
				$myPrice = \lib\app\onlinenic\price::get_price($domain, null, \dash\request::get('type'));

				\dash\data::myPrice($myPrice);
			}


		}






	}


	private static function have_error()
	{
		\dash\redirect::to(\dash\url::this());
	}
}
?>