<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class user
{
	/**
	 * Upload a file
	 */
	public static function avatar_set($_user_id = null)
	{

		if(!$_user_id)
		{
			$_user_id = \dash\user::id();
		}

		if(!$_user_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];


		$file_detail = \dash\upload\file::upload('avatar', $meta);

		if(!$file_detail)
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => $_user_id,
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'users_avatar',
			'related_id'  => $_user_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('users_avatar', $_user_id);

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


	public static function avatar_remove($_user_id = null)
	{
		if(!$_user_id)
		{
			$_user_id = \dash\user::id();
		}

		if(!$_user_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		\dash\db\fileusage::remove_usage('users_avatar', $_user_id);
	}



	public static function indenfity_set($_upload_name, $_user_id = null)
	{

		if(!$_user_id)
		{
			$_user_id = \dash\user::id();
		}

		if(!$_user_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::crm_file_size(),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];

		$file_detail = \dash\upload\file::upload($_upload_name, $meta);

		if(!$file_detail)
		{
			return false;
		}

		$key = 'users_identify_'. $_upload_name;

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => $_user_id,
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => $key,
			'related_id'  => $_user_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate($key, $_user_id);

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


	public static function identy_remove($_upload_name, $_user_id = null)
	{
		if(!$_user_id)
		{
			$_user_id = \dash\user::id();
		}

		if(!$_user_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		$key = 'users_identify_'. $_upload_name;

		\dash\db\fileusage::remove_usage($key, $_user_id);
	}
}
?>