<?php
namespace dash\upload;


class file
{

	/**
	 *
		CREATE TABLE IF NOT EXISTS `files` (
		`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		`creator` int(10) UNSIGNED DEFAULT NULL,
		`md5` char(32) DEFAULT NULL,
		`filename` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
		`type` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
		`mime` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
		`ext` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
		`folder` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
		`path` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
		`size` int(10) UNSIGNED DEFAULT NULL,
		`status` enum('awaiting','publish','block','filter','removed', 'spam') DEFAULT NULL,
		`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		`datemodified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`),
		CONSTRAINT `files_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
		KEY `files_md5_search` (`md5`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



		CREATE TABLE IF NOT EXISTS `fileusage` (
		`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		`file_id` int(10) UNSIGNED DEFAULT NULL,
		`user_id` int(10) UNSIGNED DEFAULT NULL,
		`title` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
		`alt` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
		`desc` text CHARACTER SET utf8mb4,
		`related` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
		`related_id` int(10) UNSIGNED DEFAULT NULL,
		`datecreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`),
		KEY `fileuseage_related_search` (`related`),
		KEY `fileuseage_related_id_search` (`related_id`),
		CONSTRAINT `fileusage_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
		CONSTRAINT `fileusage_file_id` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON UPDATE CASCADE
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	 */
	/**
	 * Run Uploader system
	 * 1. call self::upload function
	 * 2. save file record
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function run($_upload_name, $_meta = [])
	{
		$default_meta =
		[
			'allow_size' => null,
		];

		if(!is_array($_meta))
		{
			$_meta = [];
		}

		$_meta = array_merge($default_meta, $_meta);

		$upload_engine = self::upload($_upload_name, $_meta);

		if(!$upload_engine)
		{
			return false;
		}

		$insert_file_record =
		[
			'md5'         => $upload_engine['md5'],
			'filename'    => $upload_engine['filename'],
			'type'        => $upload_engine['type'],
			'mime'        => $upload_engine['mime'],
			'ext'         => $upload_engine['ext'],
			'folder'      => $upload_engine['folder'],
			'path'        => $upload_engine['path'],
			'size'        => $upload_engine['size'],

			'creator'     => \dash\user::id(),
			'status'      => 'publish',
			'datecreated' => date("Y-m-d H:i:s"),

		];

		$file_id = \dash\db\file\insert::record($insert_file_record);

		return $file_id;

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
	private static function upload($_upload_name, $_meta)
	{
		// 1. we have an error in $_FILE[$_upload_name]
		$check_FILE = \dash\upload\validation_file::ok($_upload_name);
		if(!$check_FILE || !isset($check_FILE['ext']) || !isset($check_FILE['md5']))
		{
			\dash\notif::error(T_("Invalid file"));
			return false;
		}

		// 2. check the extention of file
		$check_extention = \dash\upload\extentions::ok($check_FILE['ext']);
		if(!$check_extention)
		{
			\dash\notif::error(T_("Invalid file ext"));
			return false;
		}

		// 3. check file exist or no
		$check_md5 = \dash\db\file\db::check_md5($check_FILE['md5']);
		if($check_md5)
		{
			return $check_md5;
		}

		// 4. check file size
		$check_size = \dash\upload\size::ok($check_FILE['size'], $_meta);
		if(!$check_size)
		{
			\dash\notif::error(T_("Invalid file size"));
			return false;
		}

		// 5. find best directory to put the file there
		$directory = \dash\upload\directory::get();


		// 6. move file to the new directory
		$move = \dash\upload\move::file($directory, $check_FILE['tmp_name']);

		// 7. save file in some quality if need. for example pictures need to crop and save all need size
		$save_file = self::pictures_quality();

		$result =
		[
			'md5'      => null,
			'filename' => null,
			'type'     => null,
			'mime'     => null,
			'ext'      => null,
			'folder'   => null,
			'path'     => null,
			'size'     => null,
		];

		return $result;



	}
}
?>