<?php
namespace content_support\ticket\report;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Ticket report"));
		\dash\face::desc(' ');


		\dash\data::action_text(T_('Back to tickets list'));

		// btn
		\dash\data::back_text(T_('Ticket'));
		\dash\data::back_link(\dash\url::support(). '/ticket');

	}
}
?>