<?php
namespace content_my\business\ask;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Help Jibres work better"));

		$polls = \lib\app\store\polls::all();
		\dash\data::polls($polls);

		\dash\data::include_m2('wide');

		// if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\face::title(T_("Create a new business"));
			\dash\data::back_text(T_('Cancel'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>
