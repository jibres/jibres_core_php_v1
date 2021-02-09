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
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
				'gif',
			],
		];


		$file_detail = \dash\upload\file::upload('thumb', $meta);

		if(!$file_detail)
		{
			return false;
		}

		self::set_usage('post_thumb', $file_detail['id'], $_post_id);

		return $file_detail['path'];
	}



	public static function set_post_thumb_by_file_id($_post_id, $_file_id)
	{
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$load_file = \dash\app\files\get::get($_file_id);

		if(!isset($load_file['id']))
		{
			return false;
		}

		if(isset($load_file['type']) && $load_file['type'] === 'image')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not set this file as post featured image!"));
			return false;
		}


		self::set_usage('post_thumb', \dash\coding::decode($load_file['id']), $_post_id);

		return $load_file['path'];
	}



	private static function set_usage($_related, $_file_id, $_related_id)
	{
		if(!$_file_id || !$_related_id || !is_numeric($_file_id) || !is_numeric($_related_id))
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $_file_id,
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'post_thumb',
			'related_id'  => $_related_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('post_thumb', $_related_id);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $_file_id);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}
	}



	public static function set_post_cover($_post_id = null)
	{
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];


		$file_detail = \dash\upload\file::upload('cover', $meta);

		if(!$file_detail)
		{
			return false;
		}

		self::set_usage('post_cover', $file_detail['id'], $_post_id);

		return $file_detail['path'];
	}


	public static function set_post_cover_by_file_id($_post_id, $_file_id)
	{
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$load_file = \dash\app\files\get::get($_file_id);

		if(!isset($load_file['id']))
		{
			return false;
		}

		if(isset($load_file['type']) && $load_file['type'] === 'image')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not set this file as post cover!"));
			return false;
		}

		self::set_usage('post_cover', \dash\coding::decode($load_file['id']), $_post_id);

		return $load_file['path'];
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



	public static function set_post_gallery_by_file_id($_post_id, $_file_id, $_type)
	{
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$_file_id = \dash\coding::decode($_file_id);

		$load_file = \dash\app\files\get::inline_get($_file_id);

		if(!isset($load_file['id']))
		{
			return false;
		}

		switch ($_type)
		{
			case 'postsgalleryvideo':
				if(isset($load_file['type']) && $load_file['type'] === 'video')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not set this file as post video!"));
					return false;
				}
				break;

			case 'postsgalleryaudio':
				if(isset($load_file['type']) && $load_file['type'] === 'audio')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not set this file as post audio!"));
					return false;
				}
				break;

			case 'postsgallery':
			default:
				// no problem to set every file
				break;
		}


		self::set_usage('post_gallery', $load_file['id'], $_post_id);

		return $load_file;
	}



	public static function set_post_gallery($_post_id)
	{
		\dash\permission::access('cmsAttachmentAdd');

		if(!$_post_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext' =>
			[
				'mp3','wav','ogg','wma','m4a','aac', 	// audio
				'bmp','gif','jpeg','jpg','png',			// image
				'mpeg','mpg','mp4','mov','avi',			// video
				'pdf',									// doc
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



	public static function set_post_gallery_editor($_post_id)
	{
		\dash\permission::access('cmsAttachmentAdd');

		// if(!$_post_id)
		// {
		// 	\dash\notif::error(T_("Post not found"));
		// 	return false;
		// }

		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext' =>
			[
				'mp3','wav','ogg','wma','m4a','aac', 	// audio
				'bmp','gif','jpeg','jpg','png',			// image
				'mpeg','mpg','mp4','mov','avi',			// video
			],
		];


		$file_detail = \dash\upload\file::upload('upload', $meta);

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
			'related'     => 'post_gallery_editor',
			'related_id'  => $_post_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];


		$insert = \dash\db\fileusage::insert($fileusage);

		return $file_detail;
	}



}
?>