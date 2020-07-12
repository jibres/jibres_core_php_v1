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

						// btn
		\dash\data::action_text(T_('Add new factor'));
		\dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

		\dash\data::titleList(\lib\app\irvat\get::title_list());

	}
}
?>