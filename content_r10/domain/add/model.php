<?php
namespace content_r10\domain\add;


class model
{
	public static function post()
	{

		$domain = \dash\request::input_body('domain');

		$result = \lib\app\domains\add::add($domain);

		\content_r10\tools::say($result);
	}
}
?>