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

		$meta =
		[
			'size' => \dash\upload\size::cms_file_size(),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];


		$file_detail = \dash\upload\file::upload('thumb', $meta);

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
	 * @param      <type>   $_post_id  The post identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_post_gallery($_post_id, $_file_id)
	{
		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(!$_file_id)
		{
			return false;
		}

		\dash\db\fileusage::remove_usage_file_id('post_gallery', $_post_id, $_file_id);
	}


	public static function set_post_gallery($_post_id)
	{
		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$meta =
		[
			'size' => \dash\upload\size::cms_file_size(),
			'ext' =>
			[
				'mp3','wav','ogg','wma','m4a','aac', 	// audio
				'bmp','gif','jpeg','jpg','png',			// image
				'mpeg','mpg','mp4','mov','avi',			// video
			],
		];


		$file_detail = \dash\upload\file::upload('gallery', $meta);

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

		$check_duplicate_usage = \dash\db\fileusage::duplicate_whit_file_id('post_gallery', $_post_id, $file_detail['id']);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

		return $file_detail;
	}



}
?>