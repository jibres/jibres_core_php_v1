<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class avatar
{
	/**
	 * Upload a file
	 */
	public static function set()
	{
		$file_detail = \dash\upload\file::upload('avatar');

		if(!$file_detail)
		{
			return false;
		}

		$user_id = \dash\user::id();

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => $user_id,
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'users_profile',
			'related_id'  => $user_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('users_profile', $user_id);
		if(isset($check_duplicate_usage['id']))
		{
			$update_usage =
			[
				'file_id'     => $file_detail['id'],
			];

			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

		return $file_detail['path'];
	}


	public static function remove()
	{
		\dash\db\fileusage::remove_usage('users_profile', \dash\user::id());
	}
}
?>