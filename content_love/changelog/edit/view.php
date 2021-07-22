<?php
namespace content_love\changelog\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit new changelog"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
