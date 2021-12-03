<?php
namespace content_my\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'    => \dash\request::post('domain'),
			'nic_id'    => \dash\request::post('irnicid'),
			'irnic_new' => \dash\request::post('irnicid-new'),
			'pin'       => \dash\request::post('pin'),
			'agree'     => \dash\request::post('agree'),



			// .com request
			'fullname'     => \dash\request::post('fullname'),
			'email'        => \dash\request::post('email'),

			// 'org'          => \dash\request::post('org'),
			// 'nationalcode' => \dash\request::post('nationalcode'),
			// 'country'      => \dash\request::post('country'),
			// 'province'     => \dash\request::post('province'),
			// 'city'         => \dash\request::post('city'),
			// 'address'      => \dash\request::post('address'),
			// 'postcode'     => \dash\request::post('postcode'),

			// 'phonecc'      => \dash\request::post('phonecc'),
			// 'phone'        => \dash\request::post('phone'),
			// 'faxcc'        => \dash\request::post('faxcc'),
			// 'fax'          => \dash\request::post('fax'),

			// 'whoistype'    => \dash\request::post('whoistype'),

		];

		$post = array_merge(\content_my\domain\whoisdetail\model::whoisdetail_person(), $post);

		$result = \lib\app\domains\transfer::transfer($post);

		if(\dash\engine\process::status() && isset($result['domain_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/review?type=transfer&id='. $result['domain_id']);
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>