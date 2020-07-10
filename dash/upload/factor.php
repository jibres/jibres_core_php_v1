<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class factor
{
	/**
	 * Upload a file
	 */
	public static function factor_action($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return null;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
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
			'related'     => 'factoraction',
			'related_id'  => $_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('factoraction', $_id);

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
