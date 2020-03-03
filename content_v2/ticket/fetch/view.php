<?php
namespace content_v2\ticket\fetch;


class view
{
	public static function config()
	{
		\content_support\ticket\home\view::load_ticket_list();
		$ticket_list = \dash\data::dataTable();
		\content_v2\tools::say($ticket_list);
	}



}
?>