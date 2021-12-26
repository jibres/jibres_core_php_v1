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


		$args['to']     = \dash\user::id();

		$args['notif'] = true;

		if(\dash\url::child() !== 'archive')
		{
			$args['active_status'] = true;
		}

		$search_string   = \dash\validate::search_string();

		$dataTable = \dash\app\log\search::list($search_string, $args);

		// var_dump($dataTable);exit;
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