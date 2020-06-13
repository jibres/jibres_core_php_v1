<?php
namespace content_b1\ticket\fetch;


class view
{
	public static function config()
	{
		\content_support\ticket\home\view::load_ticket_list();
		$ticket_list = \dash\data::dataTable();
		\content_b1\tools::say($ticket_list);
	}



}
?>