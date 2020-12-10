<?php
namespace content_my\domain\review;


class model
{
	public static function post()
	{

		switch (\dash\request::get('type'))
		{
			case 'register':
				self::register();
				break;

			case 'renew':
				self::renew();
				break;

			case 'transfer':
				self::transfer();
				break;

			default:
				\dash\notif::error(T_("Invalid request type"));
				break;
		}


	}

	private static function renew()
	{

		$post =
		[
			'domain'       => \dash\data::dataRow_name(),
			'period'       => \dash\data::myPeriod(),
			'register_now' => true,
			'agree'        => true,
			'gift'         => \dash\request::get('gift'),
			'usebudget'    => \dash\request::post('usebudget'),
		];

		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$result  = $get_api->domain_renew($post);
		}
		else
		{
			$result = \lib\app\domains\renew::renew($post);
		}

		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_code_url'))
			{
				\dash\redirect::to(\dash\url::this(). '/?resultid='. \dash\temp::get('domain_code_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}


	private static function register()
	{

		$post =
		[
			'domain'       => \dash\data::dataRow_name(),
			'nic_id'       => null,
			'period'       => \dash\data::myPeriod(),
			'irnic_new'    => \dash\data::dataRow_holder(),
			'irnic_admin'  => \dash\data::dataRow_admin(),
			'irnic_tech'   => \dash\data::dataRow_tech(),
			'irnic_bill'   => \dash\data::dataRow_bill(),
			'ns1'          => \dash\data::dataRow_ns1(),
			'ns2'          => \dash\data::dataRow_ns2(),
			'ns3'          => \dash\data::dataRow_ns3(),
			'ns4'          => \dash\data::dataRow_ns4(),
			'register_now' => true,
			'agree'        => true,
			'gift'         => \dash\request::get('gift'),
			'usebudget'    => \dash\request::post('usebudget'),

				// .com request
			'fullname'     => a(\dash\data::dataRowAction(), 'detail', 'fullname'),
			'org'          => a(\dash\data::dataRowAction(), 'detail', 'org'),
			'nationalcode' => a(\dash\data::dataRowAction(), 'detail', 'nationalcode'),
			'country'      => a(\dash\data::dataRowAction(), 'detail', 'country'),
			'province'     => a(\dash\data::dataRowAction(), 'detail', 'province'),
			'city'         => a(\dash\data::dataRowAction(), 'detail', 'city'),
			'address'      => a(\dash\data::dataRowAction(), 'detail', 'address'),
			'postcode'     => a(\dash\data::dataRowAction(), 'detail', 'postcode'),

			'phonecc'      => a(\dash\data::dataRowAction(), 'detail', 'phonecc'),
			'phone'        => a(\dash\data::dataRowAction(), 'detail', 'phone'),
			'faxcc'        => a(\dash\data::dataRowAction(), 'detail', 'faxcc'),
			'fax'          => a(\dash\data::dataRowAction(), 'detail', 'fax'),

			'email'        => a(\dash\data::dataRowAction(), 'detail', 'email'),
		];


		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$result  = $get_api->domain_buy($post);
		}
		else
		{
			$result = \lib\app\domains\create::new_domain($post);
		}

		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_code_url'))
			{
				\dash\redirect::to(\dash\url::this(). '/?resultid='. \dash\temp::get('domain_code_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}


	private static function transfer()
	{
		$post =
		[
			'domain'    => a(\dash\data::dataRowAction(), 'detail', 'domain'),
			'nic_id'    => a(\dash\data::dataRowAction(), 'detail', 'irnicid'),
			'irnic_new' => a(\dash\data::dataRowAction(), 'detail', 'irnic_new'),
			'pin'       => a(\dash\data::dataRowAction(), 'detail', 'pin'),


			'agree'     => true,
			'register_now' => true,
			'gift'         => \dash\request::get('gift'),
			'usebudget'    => \dash\request::post('usebudget'),

			// .com request
			'fullname'     => a(\dash\data::dataRowAction(), 'detail', 'fullname'),
			'org'          => a(\dash\data::dataRowAction(), 'detail', 'org'),
			'nationalcode' => a(\dash\data::dataRowAction(), 'detail', 'nationalcode'),
			'country'      => a(\dash\data::dataRowAction(), 'detail', 'country'),
			'province'     => a(\dash\data::dataRowAction(), 'detail', 'province'),
			'city'         => a(\dash\data::dataRowAction(), 'detail', 'city'),
			'address'      => a(\dash\data::dataRowAction(), 'detail', 'address'),
			'postcode'     => a(\dash\data::dataRowAction(), 'detail', 'postcode'),

			'phonecc'      => a(\dash\data::dataRowAction(), 'detail', 'phonecc'),
			'phone'        => a(\dash\data::dataRowAction(), 'detail', 'phone'),
			'faxcc'        => a(\dash\data::dataRowAction(), 'detail', 'faxcc'),
			'fax'          => a(\dash\data::dataRowAction(), 'detail', 'fax'),

			'email'        => a(\dash\data::dataRowAction(), 'detail', 'email'),
			// 'whoistype'    => a(\dash\data::dataRowAction(), 'detail', 'whoistype'),


		];



		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$result  = $get_api->domain_transfer($post);
		}
		else
		{
			$result = \lib\app\domains\transfer::transfer($post);
		}

		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_code_url'))
			{
				\dash\redirect::to(\dash\url::this(). '/?resultid='. \dash\temp::get('domain_code_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}



		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>