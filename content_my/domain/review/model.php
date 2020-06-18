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

			default:
				# code...
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
}
?>