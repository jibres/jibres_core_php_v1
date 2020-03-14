<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class category
{
	/**
	 * Upload a file
	 */
	public static function set($_category_id = null)
	{
		if(!$_category_id)
		{
			\dash\notif::error(T_("Category id not set"));
			return false;
		}

		$meta =
		[
			'size' => \dash\upload\size::MB(0.5),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
			],
		];


		$file_detail = \dash\upload\file::upload('file', $meta);

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
			'related'     => 'category',
			'related_id'  => $_category_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('category', $_category_id);

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


	public static function remove($_category_id = null)
	{
		if(!$_category_id)
		{
			\dash\notif::error(T_("User not found"));
			return false;
		}

		\dash\db\fileusage::remove_usage('category', $_category_id);
	}
}
?>