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

		\dash\data::myType(\dash\data::dataRow_type());
		\dash\data::editMode(true);

		\content_a\accounting\coding\add\view::static_var();

	}
}
?>
