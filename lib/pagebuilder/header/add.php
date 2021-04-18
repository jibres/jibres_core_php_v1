<?php
namespace lib\pagebuilder\header;


class add
{
	public static function list($_args = [])
	{
		$list = [];

		$list[] = \lib\pagebuilder\elements\image::detail();
		$list[] = \lib\pagebuilder\elements\news::detail();
		$list[] = \lib\pagebuilder\elements\products::detail();
		$list[] = \lib\pagebuilder\elements\text::detail();
		$list[] = \lib\pagebuilder\elements\quote::detail();
		$list[] = \lib\pagebuilder\elements\subscribe::detail();
		$list[] = \lib\pagebuilder\elements\socialnetwork::detail();
		$list[] = \lib\pagebuilder\elements\application::detail();

		return $list;
	}
}
?>