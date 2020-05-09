<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class website
{
	/**
	 * Upload a file
	 */
	public static function upload_image($_upload_name)
	{

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
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


}
?>