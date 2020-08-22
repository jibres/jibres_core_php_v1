<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class form
{
	/**
	 * Upload a file
	 */
	public static function upload($_name, $_size = null, $_ext = null)
	{
		$size = 1;
		if($_size && is_numeric($_size))
		{
			$size = floatval($_size);
		}

		$ext = ['jpg', 'png'];
		if($_ext && is_array($_ext))
		{
			$ext = $_ext;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB($size),
			'ext'        => $ext,
		];

		$file_detail = \dash\upload\file::upload($_name, $meta);

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
			'related'     => 'contact_form',
			'related_id'  => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('contact_form', \lib\store::id());
		\dash\db\fileusage::insert($fileusage);

		return $file_detail['path'];
	}
}
?>