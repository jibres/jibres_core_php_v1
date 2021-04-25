<?php
namespace lib\db\pagebuilder;


class delete
{

	public static function by_id(int $_id)
	{
		$query  = "DELETE FROM pagebuilder WHERE pagebuilder.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function page_compelet($_post_id)
	{
		$query  = "DELETE FROM pagebuilder WHERE pagebuilder.related_id = $_post_id ";
		$result = \dash\db::query($query);

		$query  = "DELETE FROM posts WHERE posts.id = $_post_id LIMIT 1 ";
		$result = \dash\db::query($query);

		return $result;

	}
}
?>
