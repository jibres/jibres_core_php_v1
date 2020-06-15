<?php
namespace content_b1\product\comment\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$detail = \lib\app\product\comment::get($id);

		if(!$detail)
		{
			\content_b1\tools::stop(T_("Id not found"))		;
		}

		\content_b1\tools::say($detail);
	}

}
?>