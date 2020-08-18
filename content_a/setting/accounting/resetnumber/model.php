<?php
namespace content_a\setting\accounting\resetnumber;


class model
{
	public static function post()
	{
		$post           = [];
		$post['year_id'] = \dash\request::post('year_id');

		\lib\app\tax\doc\edit::reset_number($post);

		\dash\redirect::pwd();
	}
}
?>