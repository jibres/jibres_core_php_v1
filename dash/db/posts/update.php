<?php
namespace dash\db\posts;


class update
{

	public static function bind_content($_content, $_id)
	{
		if($_content)
		{
			$_content = stripslashes($_content);
		}

		$query = "UPDATE posts SET posts.content = :content WHERE posts.id = :id LIMIT 1 ";
		$param =
		[
			':content' => $_content,
			':id'   => $_id,
		];

		$result = \dash\pdo::query($query, $param);

		return $result;
	}



	public static function record($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `posts` SET $set WHERE posts.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}



	public static function thumb($_thumb, $_id)
	{
		if($_thumb)
		{
			$query  = "UPDATE posts SET posts.thumb = '$_thumb' WHERE posts.id = $_id LIMIT 1";
		}
		else

		{
			$query  = "UPDATE posts SET posts.thumb = NULL WHERE posts.id = $_id LIMIT 1";
		}
		$result = \dash\db::query($query);
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE posts SET posts.gallery = '$_gallery' WHERE posts.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function gallery_set_null($_id)
	{
		$query  = "UPDATE posts SET posts.gallery = NULL WHERE posts.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function status($_status, $_id)
	{
		$query  = "UPDATE posts SET posts.status = '$_status' WHERE posts.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>