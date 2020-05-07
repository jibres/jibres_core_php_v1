<?php
namespace content\careers;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Come join us.'));
		\dash\face::desc(T_("The best thing about Jibres is our people. We want to empower and inspire our team members to do their best work every day."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>