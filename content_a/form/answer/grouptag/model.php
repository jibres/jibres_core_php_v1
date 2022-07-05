<?php
namespace content_a\form\answer\grouptag;


class model
{
	public static function post()
	{
		\dash\data::getFilterArgsInModel(true);

		$args = \content_a\form\answer\view::config();
		$q    = \dash\validate::search_string();

		\lib\app\form\tag\add::group_answer_add($q, \dash\request::post('tag'), \dash\request::get('id'), $args);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Tag saved"));
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
