<?php
namespace content_m\store;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Stores"));
		\dash\data::page_desc(T_("View list of stores and add new one easily just in seconds."));

		$args = [];

		// $dataTable = \lib\app\store\::list(\dash\request::get('q'), $args);
		// \dash\data::dataTable($dataTable);


	}
}
?>
