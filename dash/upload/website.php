<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class website
{
	private static $allow_image = ['jpeg','jpg','png', 'gif', 'webp'];
	private static $allow_video = ['ogv','webm','mpeg','mpg','mov','mp4'];

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