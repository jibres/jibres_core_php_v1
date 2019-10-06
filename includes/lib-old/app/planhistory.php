<?php
namespace lib\app;


class planhistory
{
	public static function list()
	{
		$args             = [];
		$args['store_id'] = \lib\store::id();
		$list             = \lib\db\planhistory::search(null, $args);
		return $list;
	}
}
?>