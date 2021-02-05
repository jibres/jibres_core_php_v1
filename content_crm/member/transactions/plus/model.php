<?php
namespace content_crm\member\transactions\plus;

class model
{

	public static function post()
	{
		if(!\dash\user::login())
		{
			\dash\notif::error(T_("You must login to add new transaction"));
			return false;
		}

		$args =
		[
			'title'   => \dash\request::post('title'),
			'amount'  => \dash\request::post('amount'),
			'user_id' => \dash\request::get('id'),
			'type'    => \dash\url::subchild(),
		];

		\dash\app\transaction\plus_minus::set($args);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}
	}
}
?>