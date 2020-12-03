<?php
namespace content_account\notification;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Notifications"));

		if(\dash\detect\device::detectPWA())
		{
			// // back
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::kingdom(). '/my');
		}
		else
		{
			// back
			\dash\data::back_text(T_('Account'));
			\dash\data::back_link(\dash\url::here());
		}

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

		if(\dash\url::child() === 'archive')
		{
			$args['logs.notif'] = 1;
		}
		else
		{
			$args['logs.status'] = ['IN', "('notif', 'notifread')"];
		}


		$search_string   = \dash\request::get('q');

		$dataTable = \dash\app\log::list($search_string, $args);
		// select  and then update
		\dash\app\log::set_readdate($dataTable, true);

		\dash\data::dataTable($dataTable);

		$check_empty_datatable = $args;
		unset($check_empty_datatable['sort']);
		unset($check_empty_datatable['order']);
		unset($check_empty_datatable['notif']);
		unset($check_empty_datatable['to']);
		unset($check_empty_datatable['logs.notif']);
		unset($check_empty_datatable['logs.status']);


		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $check_empty_datatable);
		\dash\data::dataFilter($dataFilter);
	}
}
?>