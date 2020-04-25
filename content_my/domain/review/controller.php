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

			default:
				self::have_error();
				break;
		}

		\dash\data::dataRowAction($load_last_activity);
		\dash\data::dataRow($detail);

		$period = null;

        if(\dash\data::dataRowAction_period() == '12')
        {
        	$period = '1year';
        }
        elseif(\dash\data::dataRowAction_period() == '60')
        {
        	$period = '5year';
        }

        \dash\data::myPeriod($period);

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


	private static function have_error()
	{
		\dash\redirect::to(\dash\url::this());
	}
}
?>