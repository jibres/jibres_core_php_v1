<?php
namespace content\team;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Team'));
		\dash\face::desc(T_("We are here to build something different. Something new from scratch, that's really cool."));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-team-1.jpg');

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		// btn
		// \dash\data::action_text(T_('Join us'));
		// \dash\data::action_link(\dash\url::kingdom(). '/careers');
	}
}
?>