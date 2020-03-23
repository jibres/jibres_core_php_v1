<?php
namespace dash\upload;


class file
{
	/**
	 * File Uploading
	 * setp by step file upload
	 *
	 * 0. send file to server and save in temp directory (this step automatic run by nginx!
	 * 1. check is ok $_FILE and have not any error
	 * 2. check the extention of file. Can upload this extentions?
	 * 3. check duplicate file by md5
	 * 4. check size of file and allow size uploading
	 * 5. find best directory to put the file there
	 * 6. move file to the new directory
	 * 7. save file in some quality if need. for example pictures need to crop and save all need size
	 *
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function upload($_upload_name, $_meta = [])
	{

		$default_meta =
		[
			'allow_size' => null,
			'ext'        => null,
		];

		if(!is_array($_meta))
		{
			$_meta = [];
		}

		$_meta = array_merge($default_meta, $_meta);

		if(!\dash\request::files($_upload_name))
		{
			return null;
		}

		// 1. we have an error in $_FILE[$_upload_name]
		$myFile = \dash\upload\validation_file::ok($_upload_name, $_meta);

		if(!$myFile || !isset($myFile['ext']) || !isset($myFile['md5']) || !isset($myFile['tmp_name']) || !isset($myFile['size']))
		{
			return false;
		}

		// 3. check file exist or no
		$check_md5 = \dash\db\files::duplicate($myFile['md5']);
		if($check_md5)
		{
			return $check_md5;
		}

		// 4. check file size
		$check_size = \dash\upload\size::ok($myFile['size'], $_meta);
		if(!$check_size)
		{
			\dash\notif::error(T_("File size is greater than allowed"));
			return false;
		}

		if(in_array($myFile['ext'], ['jpg','jpeg','png','gif']))
		{
			if(isset($_meta['square']) && $_meta['square'])
			{
				$square = \dash\upload\crop::check_square($myFile['tmp_name']);
				if(!$square)
				{
					if(isset($_meta['notif_msg_square']))
					{
						\dash\notif::error($_meta['notif_msg_square']);
					}
					else
					{
						\dash\notif::error(T_("Please use from a square image file"));
					}
					return false;
				}
			}
		}

		$filename = md5($myFile['filename']). '.'. $myFile['ext'];

		// 5. find best directory to put the file there
		$directory = \dash\upload\directory::get($filename);

		if(!$directory)
		{
			\dash\notif::error(T_("Directory for upload not found"));
			return false;
		}

		if(\dash\file::rename($myFile['tmp_name'], $directory['full']))
		{
			@chmod($directory['full'], 0644);
		}
		else
		{
			\dash\notif::error(T_("Can not upload file"));
			return false;
		}

		// // 6. move file to the new directory
		// if(move_uploaded_file($myFile['tmp_name'], $directory['path']))
		// {
		// 	@chmod($directory['full'], 0644);
		// }
		// else
		// {
		// 	\dash\notif::error(T_("Can not upload file"));
		// 	return false;
		// }

		// 7. save file in some quality if need. for example pictures need to crop and save all need size
		if(in_array($myFile['ext'], ['jpg','jpeg','png','gif']))
		{
			\dash\upload\crop::pic($directory['full'], $myFile['ext']);
		}


		$insert_file_record =
		[
			'md5'         => $myFile['md5'],
			'filename'    => $myFile['filename'],
			'type'        => $myFile['type'],
			'mime'        => $myFile['mime'],
			'ext'         => $myFile['ext'],
			'size'        => $myFile['size'],

			'folder'      => $directory['folder'],
			'path'        => $directory['path'],

			'creator'     => \dash\user::id(),
			'status'      => 'publish',
			'datecreated' => date("Y-m-d H:i:s"),
		];


		$file_id = \dash\db\files::insert($insert_file_record);
		$insert_file_record['id'] = $file_id;

		return $insert_file_record;
	}
}
?>