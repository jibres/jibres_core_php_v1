<?php
namespace content\campaign\nowruz1400;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Nowruz 1400 | Jibres Campaign'));
		\dash\face::desc(T_("We have a special gift for your. 1000 .ir domain for 1000 person."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/campaign/nowruz1400/Jibres-cover-campaign-nowruz1400.jpg');

	}
}
?>