<?php
namespace content_support\ticket\show;

class controller
{
	public static function routing()
	{
		\dash\utility\ip::check(true);

		\dash\csrf::set();

		self::loadTicketDetail();
	}


	private static function loadTicketDetail()
	{
		$id = \dash\validate::id(\dash\request::get('id'));
		if(!$id)
		{
			return false;
		}

		$main = \dash\app\ticket::get($id);
		if(!$main || !array_key_exists('user_id', $main))
		{
			\dash\header::status(403, T_("Ticket not found"));
		}



		\dash\data::loadTicketDetail($main);
		return $main;
	}
}
?>
