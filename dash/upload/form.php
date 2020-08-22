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
	public static function upload($_form_id, $_name, $_size = null, $_ext = null)
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
			'related'     => 'contact_form_answer',
			'related_id'  => $_form_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('contact_form_answer', $_form_id);
		\dash\db\fileusage::insert($fileusage);

		return $file_detail['path'];
	}



	public static function form($_form_id)
	{
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
			'related'     => 'contact_form',
			'related_id'  => $_form_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('contact_form', $_form_id);

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