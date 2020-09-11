<?php
namespace content_love\business\domain\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new domain"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
