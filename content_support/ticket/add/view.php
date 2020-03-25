<?php
namespace content_support\ticket\add;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Add new ticket"));
		\dash\data::page_desc(T_("Dot worry!"). ' '. T_("Ask your question."). ' '. T_("We are here to answer your questions."));

		\dash\data::action_text(T_('Back to tickets list'));
		\dash\data::action_link(\dash\url::this(). \dash\data::accessGet());

		\dash\session::set('ticket_load_page_time', time());

		// btn
		\dash\data::back_text(T_('Ticket'));
		\dash\data::back_link(\dash\url::support(). '/ticket');
	}
}
?>