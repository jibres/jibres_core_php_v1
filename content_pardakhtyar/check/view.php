<?php
namespace content_pardakhtyar\check;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Check"));
		\dash\data::page_desc('Check request detail');
		\dash\data::page_pictogram('question');

		$args =
		[
			'sort'       => 'id',
			'order'      => 'desc',
			'request_id' => \dash\request::get('id'),
		];

		$list = \lib\pardakhtyar\app\check::list(null, $args);
		\dash\data::dataTable($list);


		// if(\dash\request::get('requestType'))
		// {
		// 	\dash\data::actionList_addCustomer(['id' => \dash\request::get('id'), 'table' => \dash\request::get('table'), 'requestType' => \dash\request::get('requestType')]);
		// }

		// if(\dash\request::get('fetch'))
		// {
		// 	\dash\data::actionList_Fetch(['id' => \dash\request::get('id'), 'table' => \dash\request::get('table'), 'fetch' => 1, 'trackingNumber' => \dash\request::get('trackingNumber')]);
		// }

	}
}
?>