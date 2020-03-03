<?php
namespace content_v2\ticket\detail;


class view
{

	public static function config()
	{
		$id = \dash\request::get('id');
		\content_support\ticket\show\view::load_tichet($id);
		$ticket_list                    = \dash\data::dataTable();
		\content_v2\tools::say($ticket_list);
	}
}
?>