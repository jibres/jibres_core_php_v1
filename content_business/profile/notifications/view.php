<?php
namespace content_business\profile\notifications;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My notifications"));

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'desc';
		}

		$date_now = date("Y-m-d H:i:s");

		$args['to']     = \dash\user::id();

		$args['notif'] = true;
		if(\dash\url::child() !== 'archive')
		{
			$args['active_status'] = true;
		}

		$dataTable = \dash\app\log\search::list(null, $args);


		\dash\data::dataTable($dataTable);

		\dash\data::back_link(\dash\url::this());
	}
}
?>
