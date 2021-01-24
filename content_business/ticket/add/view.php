<?php
namespace content_business\ticket\add;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Add new ticket"));
		\dash\face::desc(T_("Dot worry!"). ' '. T_("Ask your question."). ' '. T_("We are here to answer your questions."));

		// btn
		\dash\data::back_text(T_('Tickets'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>