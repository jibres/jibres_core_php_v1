<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class support
{
	/**
	 * Upload a file
	 */
	public static function ticket()
	{
		$meta =
		[
			'allow_size' => \dash\upload\size::support_file_size(),
			'ext' =>
			[
				'zip','rar',
				'mp3','wav','ogg','wma','m4a','aac',
				'bmp','gif','jpeg','jpg','png','tif','svg','pdf',
				'mpeg','mpg','mp4','mov','avi','dvi',
				'doc','docx','xls','xlsx','ppt','pptx','ppsx',
				'txt','csv',
			],
		];


		$file_detail = \dash\upload\file::upload('file', $meta);

		if(!$file_detail)
		{
			return false;
		}

		return $file_detail;
	}


	public static function ticket_usage($_file, $_ticket_id)
	{

		if(!isset($_file['id']))
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $_file['id'],
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'ticket',
			'related_id'  => $_ticket_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate('ticket', $_ticket_id);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

	}


}
?>