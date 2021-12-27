<?php
namespace dash\db\posts;


class update
{

	public static function update_content($_content, $_id)
	{
		if(!is_null($_content))
		{
			if(\dash\str::strpos($_content, '\\') !== false)
			{
				// Un-quote string quoted with addcslashes()
				$_content = stripcslashes($_content);
			}
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
		return \dash\pdo\query_template::update('posts', $_args, $_id);
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
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE posts SET posts.gallery = '$_gallery' WHERE posts.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

	public static function gallery_set_null($_id)
	{
		$query  = "UPDATE posts SET posts.gallery = NULL WHERE posts.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}



	public static function status($_status, $_id)
	{
		$query  = "UPDATE posts SET posts.status = '$_status' WHERE posts.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


}
?>