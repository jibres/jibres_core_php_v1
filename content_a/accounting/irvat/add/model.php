<?php
namespace content_a\accounting\irvat\add;


class model
{
	public static function post()
	{

		$post =
		[
			'title'             => \dash\request::post('title'),
			'code'              => \dash\request::post('code'),
			'serialnumber'      => \dash\request::post('serialnumber'),
			'factordate'        => \dash\request::post('factordate'),
			'type'              => \dash\request::get('type'),
			'customer'          => \dash\request::post('customer'),
			'seller'            => \dash\request::post('seller'),
			'total'             => \dash\request::post('total'),
			'subtotalitembyvat' => \dash\request::post('subtotalitembyvat'),
			'sumvat'            => \dash\request::post('sumvat'),
			'items'             => \dash\request::post('items'),
			'itemsvat'          => \dash\request::post('itemsvat'),
			'official'          => \dash\request::post('official'),
			'vat'               => \dash\request::post('vat'),
			'desc'              => \dash\request::post('desc'),

			'mobile'      => \dash\request::post('memberTl'),
			'gender'      => \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null,
			'displayname' => \dash\request::post('memberN'),

		];

		$add = \lib\app\irvat\add::add($post);

		if(\dash\engine\process::status())
		{
			if(isset($add['id']))
			{
				\dash\redirect::to(\dash\url::that(). '/edit?id='. $add['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::that());
			}
		}

	}
}
?>