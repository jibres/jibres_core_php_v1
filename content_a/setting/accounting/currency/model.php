<?php
namespace content_a\setting\accounting\currency;


class model
{
	public static function post()
	{
		$post           = [];
		$post['currency'] = \dash\request::post('currency');

		\lib\app\setting\set::accounting_setting($post);

		\dash\redirect::pwd();
	}
}
?>