<?php
namespace content_love\business\domain\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>
