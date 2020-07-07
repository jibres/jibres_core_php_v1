<?php
namespace content_a\irvat\edit;


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
			'type'              => \dash\request::post('type'),
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

		];

		$edit = \lib\app\irvat\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>