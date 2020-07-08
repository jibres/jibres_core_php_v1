<?php
namespace content_a\irvat\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit factor"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

	}
}
?>