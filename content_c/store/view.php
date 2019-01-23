<?php
namespace content_c\store;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Stores"));
		\dash\data::page_desc(T_("View list of stores and add new one easily just in seconds."));

		$args = [];

		if(\dash\permission::supervisor() && \dash\request::get('all'))
		{
			if(\dash\request::get('creator'))
			{
				$args['creator'] = \dash\request::get('creator');
			}
			$args['limit'] = 12;
			// no thing
		}
		else
		{
			$args['creator'] = \dash\user::id();
		}
		$dataTable = \lib\app\store::list(\dash\request::get('q'), $args);
		\dash\data::stores($dataTable);
	}
}
?>
