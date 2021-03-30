<?php
namespace content\campaign\nowruz1400;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Campaigns'));
		\dash\face::desc(T_("We do a lot of marketing campaigns for you."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		// \dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-campaign-1.jpg');

	}
}
?>