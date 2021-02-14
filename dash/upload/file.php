<?php
namespace dash\upload;


class file
{
	private static $MY_FILES = [];
	private static $upload_name = null;


	/**
	 * Uploads an other server by scp.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_other_server_scp()
	{
		return true;
	}


	private static function config_my_files($_upload_name, $_meta)
	{
		self::$upload_name = $_upload_name;
		if(isset($_meta['upload_from_path']) && isset($_meta['upload_name']))
		{
			self::$upload_name = $_meta['upload_name'];
			$my_temp_file = $_meta['upload_from_path'];
			if(is_file($my_temp_file))
			{
				$mime = \dash\upload\extentions::_mime_content_type($my_temp_file);

				if(isset($_meta['special_file_name']) && $_meta['special_file_name'])
				{
					$file_name = $_meta['special_file_name'];
				}
				else
				{
					$file_name = basename($my_temp_file);
				}

				if(isset($_meta['special_file_ext']) && $_meta['special_file_ext'])
				{
					$file_name .= '.'. $_meta['special_file_ext'];
				}
				else
				{
					$ext = \dash\upload\extentions::get_ext_from_mime($mime);
					if($ext)
					{
						$file_name .= '.'. $ext;
					}
				}

				self::$MY_FILES[$_meta['upload_name']] =
				[
					'name'     => $file_name,
					'type'     => $mime,
					'tmp_name' => $my_temp_file,
					'error'    => 0,
					'size'     => filesize($my_temp_file),
				];
			}
		}
	}

	public static function my_files($_name = null, $_key = null)
	{
		if(!self::$MY_FILES)
		{
			self::$MY_FILES = $_FILES;
		}

		if($_name)
		{
			if(isset(self::$MY_FILES[$_name]) && (isset(self::$MY_FILES[$_name]['error']) && self::$MY_FILES[$_name]['error'] != 4))
			{
				if($_key)
				{
					if(isset(self::$MY_FILES[$_name][$_key]))
					{
						return self::$MY_FILES[$_name][$_key];
					}
					else
					{
						return null;
					}
				}
				else
				{
					return self::$MY_FILES[$_name];
				}

			}
			else
			{
				return null;
			}
		}
		return self::$MY_FILES;
	}

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
			'allow_size'        => null,
			'upload_from_path'  => null,
			'special_path_name' => null,
			'special_file_name' => null,
			'special_file_ext'  => null,
			'upload_name'       => null,
			'ext'               => null,
		];

		if(!is_array($_meta))
		{
			$_meta = [];
		}

		$_meta = array_merge($default_meta, $_meta);

		self::config_my_files($_upload_name, $_meta);

		$upload_name = self::$upload_name;

		if(!\dash\upload\file::my_files($upload_name))
		{
			return null;
		}

		// 1. we have an error in $_FILE[$upload_name]
		$myFile = \dash\upload\validation_file::ok($upload_name, $_meta);

		if(!$myFile || !isset($myFile['ext']) || !isset($myFile['md5']) || !isset($myFile['tmp_name']) || !isset($myFile['size']))
		{
			\dash\log::to_supervisor('invalid my file');
			\dash\log::to_supervisor(json_encode($myFile, JSON_UNESCAPED_UNICODE));
			return false;
		}

		// 3. check file exist or no
		$check_md5 = \dash\db\files::duplicate($myFile['md5']);
		if($check_md5)
		{
			\dash\log::to_supervisor('duplicate file md5');
			return $check_md5;
		}

		// 4. check file size
		$check_size = \dash\upload\size::ok($myFile['size'], $_meta);
		if(!$check_size)
		{
			\dash\log::to_supervisor('Not allow size');
			\dash\notif::error(T_("File size is greater than allowed"));
			return false;
		}

		if(!\dash\upload\storage::have_space($myFile['size']))
		{
			\dash\log::to_supervisor('Not have space');
			\dash\notif::error(T_("Your storage space is full. Please contact support"));
			return false;
		}

		if(in_array($myFile['ext'], ['jpg','jpeg','png','gif', 'webp']))
		{
			if(isset($_meta['square']) && $_meta['square'])
			{
				$square = \dash\utility\image::check_square($myFile['tmp_name']);
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

		if(isset($_meta['special_file_name']) && $_meta['special_file_name'])
		{
			$myfilename = $_meta['special_file_name'];
		}
		else
		{
			$myfilename = md5($myFile['filename']);
		}

		$filename = $myfilename. '.'. $myFile['ext'];

		// 5. find best directory to put the file there
		$directory = \dash\upload\directory::get($filename, self::upload_other_server_scp(), $_meta);

		if(!$directory)
		{
			\dash\log::to_supervisor('Have not directory');
			\dash\log::to_supervisor(json_encode([$filename, self::upload_other_server_scp(), $_meta], JSON_UNESCAPED_UNICODE));
			\dash\notif::error(T_("Directory for upload not found"));
			return false;
		}

		$upload_in_s3           = false;
		$directory['real_path'] = $directory['path'];
		$real_addr              = $myFile['tmp_name'];


		if(\dash\utility\s3aws\s3::active())
		{
			$url = \dash\utility\s3aws\s3::upload($myFile['tmp_name'], $directory['path']);
			// make error in s3
			if(!\dash\engine\process::status() || !$url)
			{
				\dash\log::to_supervisor('Can not upload in s3');
				return false;
			}

			$upload_in_s3        = true;
			$directory['path']   = $url;
			$directory['folder'] = \dash\utility\s3aws\s3::get_sample_folder_name();
		}
		elseif(self::upload_other_server_scp())
		{
			if(\dash\scp::uploader_connection())
			{
				$directory['real_path'] = $directory['full'];

				if(\dash\scp::send($myFile['tmp_name'], $directory['full']))
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not send your file in remote directory"));
					return false;
				}
			}
			else
			{
				\dash\notif::error(T_("Can not upload your file in storage"));
				return false;
			}
		}
		else
		{
			if(\dash\file::rename($myFile['tmp_name'], $directory['full']))
			{
				$real_addr = $directory['full'];
				@chmod($directory['full'], 0644);
			}
			else
			{
				\dash\notif::error(T_("Can not upload file"));
				return false;
			}
		}


		$height = null;
		$width  = null;
		$ratio  = null;

		$totalsize = $myFile['size'];
		// 7. save file in some quality if need. for example pictures need to crop and save all need size
		if(in_array($myFile['ext'], ['jpg','jpeg','png','gif', 'webp']))
		{

			$ratio_detail = \dash\utility\image::get_ratio($directory['full'], true);

			if(isset($ratio_detail['height']))
			{
				$height = $ratio_detail['height'];
			}

			if(isset($ratio_detail['width']))
			{
				$width = $ratio_detail['width'];
			}

			if(isset($ratio_detail['ratio']))
			{
				$ratio = $ratio_detail['ratio'];
			}

			$width_list = \dash\utility\image::responsive_image_size();

			foreach ($width_list as $width)
			{
				$extlen     = mb_strlen($myFile['ext']);

				$file_without_ext = substr($real_addr, 0, -$extlen-1);
				$path_without_ext = substr($directory['real_path'], 0, -$extlen-1);
				$full_without_ext = substr($directory['full'], 0, -$extlen-1);

				$new_path = $file_without_ext . '-w'. $width. '.webp';

				if(\dash\utility\image::make_webp_image($real_addr, $new_path, $width, true))
				{
					$totalsize += filesize($new_path);

					if($upload_in_s3)
					{
						$new_path_s3 = $path_without_ext . '-w'. $width. '.webp';
						\dash\utility\s3aws\s3::upload($new_path, $new_path_s3);
						\dash\file::delete($new_path);
					}
					elseif(self::upload_other_server_scp())
					{
						$new_path_scp = $full_without_ext . '-w'. $width. '.webp';
						\dash\scp::send($new_path, $new_path_scp);
						\dash\file::delete($new_path);
					}
					else
					{
						// nothing. Upload in local directory of server
					}
				}
			}
		}

		// if the file uploaded in s3 or scp remove from local
		if($upload_in_s3 || self::upload_other_server_scp())
		{
			\dash\file::delete($real_addr);
		}


		$insert_file_record =
		[
			'md5'         => $myFile['md5'],
			'filename'    => $myFile['filename'],
			'type'        => $myFile['type'],
			'mime'        => $myFile['mime'],
			'ext'         => $myFile['ext'],
			'size'        => $myFile['size'],
			'totalsize'   => $totalsize,

			'height'      => $height,
			'width'       => $width,
			'ratio'       => $ratio,

			'folder'      => $directory['folder'],
			'path'        => $directory['path'],

			'ip'          => \dash\server::ip(true),
			'domain'      => \dash\url::host(),
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