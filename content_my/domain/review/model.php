<?php
namespace content_my\domain\review;


class model
{
	public static function post()
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
			$result = \lib\app\nic_domain\create::new_domain($post);
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