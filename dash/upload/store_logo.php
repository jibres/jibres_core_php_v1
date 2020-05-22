<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class store_logo
{
	/**
	 * Upload a file
	 */
	public static function set()
	{

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];

		$file_detail = \dash\upload\file::upload('logo', $meta);

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
			'related'     => 'store_logo',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('store_logo', \lib\store::id());

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



	public static function app_intro_logo($_page_number)
	{

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];

		$file_detail = \dash\upload\file::upload('file'. $_page_number, $meta);

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
			'related'     => 'app_intro_logo'. $_page_number,
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('app_intro_logo'. $_page_number, \lib\store::id());

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



	public static function app_android_logo_set()
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'png', 'jpg', 'jpeg',
			],
			'force_png'        => true,
			'square'           => true,
			'notif_msg_ext'    => T_("You must upload only png file format for application logo"),
			'notif_msg_square' => T_("Please use from a png image at square format for application logo"),
		];

		$file_detail = \dash\upload\file::upload('logo', $meta);

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
			'related'     => 'store_application_android_logo',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('store_application_android_logo', \lib\store::id());

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


	public static function website_logo()
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'png', 'jpg'
			],
			'notif_msg_ext'    => T_("You must upload only png or jpg file format for website logo"),
		];

		$file_detail = \dash\upload\file::upload('logo', $meta);

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
			'related'     => 'file_site_header_logo',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('file_site_header_logo', \lib\store::id());

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