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
			'dblm'    => \dash\request::post('dblm'),
			'date'    => \dash\request::post('date'),
			'time'    => \dash\request::post('time'),
			'user_id' => \dash\request::get('id'),
		];

		if(\dash\url::subchild() === 'minus')
		{
			\dash\app\transaction\budget::minus($args);
		}
		elseif(\dash\url::subchild() === 'plus')
		{
			\dash\app\transaction\budget::plus($args);
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}
	}
}
?>