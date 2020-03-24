<?php
namespace content\certificates;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Certificates'). ' | '. T_("Jibres"));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

	}
}
?>