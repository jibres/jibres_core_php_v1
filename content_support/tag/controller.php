<?php
namespace content_support\tag;

class controller
{

	public static function routing()
	{
		$child = \dash\url::child();
		$child = \dash\validate::slug($child);
		$child = urldecode($child);
		if(!$child)
		{
			\dash\redirect::to(\dash\url::here());
		}

		$check = null; // \dash\db\terms::get(['url' => $child, 'type' => 'help_tag', 'limit' => 1]);
		if(!$check)
		{
			\dash\header::status(404, T_("Invalid tag"));
		}

		\dash\data::categoryDetail($check);

		\dash\open::get();
	}
}
?>