<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class cms
{
	/**
	 * Upload a file
	 */
	public static function set_post_thumb($_post_id = null)
	{
		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$file_detail = \dash\upload\file::upload('thumb');

		if(!$file_detail)
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'post_thumb',
			'related_id'  => $_post_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('post_thumb', $_post_id);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

		return $file_detail['path'];
	}



	/**
	 * Removes a post gallery.
	 * Nedd to fix
	 * @param      <type>   $_post_id  The post identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_post_gallery($_post_id = null)
	{
		return false;

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(!$_path)
		{
			return false;
		}

		\dash\db\fileusage::remove_usage_path('post_gallery', $_post_id, $_path);
	}


	public static function set_post_gallery($_post_id = null)
	{
		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$file_detail = \dash\upload\file::upload('gallery');

		if(!$file_detail)
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'post_gallery',
			'related_id'  => $_post_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('post_gallery', $_post_id);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

		return $file_detail['path'];
	}



}
?>