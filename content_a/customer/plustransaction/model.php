<?php
namespace content_a\customer\plustransaction;


class model
{
	public static function post()
	{
		$post =
		[
			'title'   => \dash\request::post('title'),
			'type'    => \dash\request::post('type'),
			'bank'    => \dash\request::post('bank'),
			'user_id' => \dash\request::get('id'),
			'plus'    => \dash\request::post('price'),
			'desc'    => \dash\request::post('desc'),
			'trackid' => \dash\request::post('trackid'),
		];

		\lib\app\storetransaction\account::charge($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Transaction saved"));
			\dash\redirect::to(\dash\url::this(). '/billing?id='. \dash\request::get('id'));
		}
	}
}
?>
