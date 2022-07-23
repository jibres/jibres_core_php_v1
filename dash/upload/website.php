<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class website
{
	private static $allow_image = ['jpeg','jpg','png', 'gif', 'webp'];
	private static $allow_video = ['ogv','webm','mpeg','mpg','mov','mp4'];



	public static function upload_by_file_id($_file_id, $_type = [])
	{
		$load_file = \dash\app\files\get::inline_get(\dash\coding::decode($_file_id));

		if(!isset($load_file['id']))
		{
			return false;
		}

		if(isset($load_file['type']) && in_array($load_file['type'], $_type))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Can not set this file"));
			return false;
		}


		$fileusage =
		[
			'file_id'     => $load_file['id'],
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'website_image',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		\dash\db\fileusage::insert($fileusage);

		return $load_file['path'];
	}


	public static function upload_by_file_addr($_file_addr, $_type = [])
	{
		$addr = strtok($_file_addr, '?');

		$detail = \lib\filepath::get_detail($addr);

		if(isset($detail['type']) && in_array($detail['type'], $_type))
		{
			// ok
			return $_file_addr;
		}
		else
		{
			\dash\notif::error(T_("Can not set this file"));

			return false;
		}

	}



	/**
	 * Upload a file
	 */
	public static function upload_everything($_upload_name)
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext'        => array_keys(extentions::get_all_allow_ext()),
		];

		return self::upload($_upload_name, $meta);
	}


	/**
	 * Upload a file
	 */
	public static function upload_image($_upload_name)
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext'        => self::$allow_image,
		];

		return self::upload($_upload_name, $meta);

	}


	public static function upload_image_or_video($_upload_name)
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext'        => array_merge(self::$allow_image, self::$allow_video),
		];

		return self::upload($_upload_name, $meta);
	}


	public static function upload($_upload_name, $_meta)
	{
		$file_detail = \dash\upload\file::upload($_upload_name, $_meta);

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
			'related'     => 'website_image',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		\dash\db\fileusage::insert($fileusage);

		return $file_detail['path'];
	}


	public static function upload_video($_upload_name)
	{

		$meta =
		[
			'allow_size' => \dash\upload\size::get(),
			'ext'        => self::$allow_video,
		];

		return self::upload($_upload_name, $meta);
	}


}
?>