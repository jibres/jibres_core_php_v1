<?php
namespace content_a\accounting\report;


class view
{
	public static function config()
	{
		\dash\redirect::to(\dash\url::that(). '/group');

		\dash\data::userToggleSidebar(false);

	}

}
?>
