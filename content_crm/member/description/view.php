<?php
namespace content_crm\member\description;


class view
{
	public static function config()
	{
		\content_crm\member\master::view();


		\dash\face::title(T_('User description'));

		$dataTable = \dash\app\user\description::list(\dash\request::get('id'));

		\dash\data::dataTable($dataTable);
	}
}
?>