<?php
namespace lib\app\pagebuilder\header;


class add
{
	public static function list($_args = [])
	{
		$list = [];

		$list[] = \lib\app\pagebuilder\elements\image::detail();
		$list[] = \lib\app\pagebuilder\elements\news::detail();
		$list[] = \lib\app\pagebuilder\elements\products::detail();
		$list[] = \lib\app\pagebuilder\elements\text::detail();
		$list[] = \lib\app\pagebuilder\elements\quote::detail();
		$list[] = \lib\app\pagebuilder\elements\subscribe::detail();
		$list[] = \lib\app\pagebuilder\elements\socialnetwork::detail();
		$list[] = \lib\app\pagebuilder\elements\application::detail();

		return $list;
	}
}
?>