<?php
namespace content_a\products\add;


class model extends \content_a\products\edit\model
{
	public static function post()
	{
		self::add();
	}
}
?>