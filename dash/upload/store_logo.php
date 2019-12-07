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

		$file_detail = \dash\upload\file::upload('logo');

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
}
?>