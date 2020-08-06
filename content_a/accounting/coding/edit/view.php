<?php
namespace content_a\accounting\coding\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit accounting coding'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::parentList(\lib\app\tax\coding\get::parent_list());
		\dash\data::editMode(true);

	}
}
?>
