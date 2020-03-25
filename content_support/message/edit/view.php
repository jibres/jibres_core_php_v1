<?php
namespace content_support\message\edit;

class view
{

	public static function config()
	{
		\dash\permission::check('supportEditMessage');

		\dash\face::title(T_("Edit message"));
		\dash\data::page_desc(T_("Edit your message or delete it."));



		\dash\data::action_text(T_('Back to tickets list'));
		\dash\data::action_link(\dash\url::this());

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$parent = \dash\request::get('id');
		if(!$parent || !is_numeric($parent))
		{
			\dash\header::status(404, T_("Invalid id"));
		}

		$main = \dash\app\ticket::get(\dash\request::get('id'));
		if(!$main || !isset($main['user_id']))
		{
			\dash\header::status(403, T_("Ticket not found"));
		}

		\dash\data::masterTicketDetail($main);

		$ticket_user_id = $main['user_id'];

		\dash\data::masterTicketUser($ticket_user_id);

		$ticket_user_id = \dash\coding::decode($ticket_user_id);
		if(!$ticket_user_id)
		{
			\dash\header::status(403, T_("Ticket not found"));
		}

		if(intval($ticket_user_id) === intval(\dash\user::id()) || \dash\permission::supervisor())
		{
			// no problem
		}
		else
		{
			\dash\header::status(403, T_("This is not your ticket!"));
		}


	}
}
?>