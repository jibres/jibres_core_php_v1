<?php
namespace content_love\gift\edit;


class model
{
	public static function post()
	{

		$post =
		[
			'code'         => \dash\request::post('code'),
			'usagetotal'   => \dash\request::post('usagetotal'),
			'usageperuser' => \dash\request::post('usageperuser'),
			'desc'         => \dash\request::post('desc'),
			'msgsuccess'   => \dash\request::post('msgsuccess'),
			'giftpercent'  => \dash\request::post('giftpercent'),
			'giftmax'      => \dash\request::post('giftmax'),
			'giftamount'   => \dash\request::post('giftamount'),
			'pricefloor'   => \dash\request::post('pricefloor'),
			'dateexpire'   => \dash\request::post('dateexpire'),
			'physical'     => \dash\request::post('physical'),
			'chap'         => \dash\request::post('chap'),
			'status'       => \dash\request::post('status'),
			'forusein'     => \dash\request::post('forusein'),
			'dedicated'   => \dash\request::post('dedicated'),

		];

		$edit = \lib\app\gift\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>