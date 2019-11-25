<?php
namespace content_a\customer\identify;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();
		\content_a\customer\load::static_var();

		\dash\data::page_title(T_('Identification detail'));
		\dash\data::page_desc(T_('set personal and birth identification detail and some other id detail like passport and etc for your this employee.'));
		\dash\data::page_pictogram('user-5');

		\content_a\customer\load::fixTitle();
	}
}
?>
