<?php
namespace dash\upload;

class extentions
{
	private static function mime()
	{
		$mimes =
		[
			// archive
			'gtar'     => [ 'allow' => false,	'type' => 'archive',    'mime' => 'application/x-gtar'],
			'tar'      => [ 'allow' => false,	'type' => 'archive',    'mime' => 'application/x-tar'],
			'tgz'      => [ 'allow' => false,	'type' => 'archive',    'mime' => 'application/x-tar'],
			'zip'      => [ 'allow' => true,	'type' => 'archive',    'mime' => 'application/zip'],
			'7z'       => [ 'allow' => false,	'type' => 'archive',    'mime' => 'application/x-7z-compressed'],
			'rar'      => [ 'allow' => true,	'type' => 'archive',    'mime' => 'application/x-rar-compressed'],
			// audio
			'mp3'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/mpeg'],
			'wav'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/x-wav'],
			'ogg'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/ogg'],


			'wma'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/x-ms-wma'],
			'm4a'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/x-m4a'],
			'aac'      => [ 'allow' => true,	'type' => 'audio',      'mime' => 'audio/aac'],
			// image
			'bmp'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/bmp'],
			'webp'     => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/webp'],
			'gif'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/gif'],
			'jpeg'     => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/jpeg'],
			'jpg'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/jpeg'],
			'png'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/png'],
			'tif'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/tiff'],
			'svg'      => [ 'allow' => true,	'type' => 'image',      'mime' => 'image/svg+xml'],
			// pdf
			'pdf'      => [ 'allow' => true,	'type' => 'pdf',        'mime' => 'application/pdf'],
			// video

			'ogv'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'audio/ogg'],
			'webm'     => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/webm'],
			'mpeg'     => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/mpeg'],
			'mpg'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/mpeg'],
			'mp4'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/mp4'],
			'mov'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/quicktime'],
			'avi'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'video/x-msvideo'],
			'dvi'      => [ 'allow' => true,	'type' => 'video',      'mime' => 'application/x-dvi'],
			// word
			'doc'      => [ 'allow' => true,	'type' => 'word',       'mime' => 'application/msword'],
			'docx'     => [ 'allow' => true,	'type' => 'word',       'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
			// excel
			'xls'      => [ 'allow' => true,	'type' => 'excel',      'mime' => 'application/vnd.ms-excel'],
			'xlsx'     => [ 'allow' => true,	'type' => 'excel',      'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
			// powerpoint
			'ppt'      => [ 'allow' => true,	'type' => 'powerpoint', 'mime' => 'application/vnd.ms-powerpoint'],
			'pptx'     => [ 'allow' => true,	'type' => 'powerpoint', 'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
			'ppsx'     => [ 'allow' => true,	'type' => 'powerpoint', 'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow'],
			// code
			'js'       => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/x-javascript'],
			'dll'      => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/octet-stream'],
			// diallow file list
			'php'      => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/x-httpd-php'],
			'php5'     => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/x-httpd-php'],
			'exe'      => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/octet-stream'],
			'bat'      => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/x-bat'],
			'bin'      => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/macbinary'],
			'htaccess' => [ 'allow' => false,	'type' => 'code',       'mime' => 'application/x-jar'],
			// text
			'rtx'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/richtext'],
			'rtf'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/rtf'],
			'log'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/plain'],
			'text'     => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/plain'],
			'txt'      => [ 'allow' => true,	'type' => 'text',       'mime' => 'text/plain'],
			'xml'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/xml'],
			'xsl'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/xml'],
			'css'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/css'],
			'htm'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/html'],
			'html'     => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/html'],
			'shtml'    => [ 'allow' => false,	'type' => 'text',       'mime' => 'text/html'],
			'xht'      => [ 'allow' => false,	'type' => 'text',       'mime' => 'application/xhtml+xml'],
			'xhtml'    => [ 'allow' => false,	'type' => 'text',       'mime' => 'application/xhtml+xml'],
			// file
			'psd'      => [ 'allow' => false,	'type' => 'file',       'mime' => 'application/octet-stream'],
			'eps'      => [ 'allow' => false,	'type' => 'file',       'mime' => 'application/postscript'],
			'apk'      => [ 'allow' => false,	'type' => 'file',       'mime' => 'application/vnd.android.package-archive'],
			'chm'      => [ 'allow' => false,	'type' => 'file',       'mime' => 'application/vnd.ms-htmlhelp'],
			'jar'      => [ 'allow' => false,	'type' => 'file',       'mime' => 'application/x-jar'],
			// csv file
			'csv'      => [ 'allow' => true,	'type' => 'file',       'mime' => 'text/csv'],

		];

		return $mimes;
	}
	/**
	 * Get the MIME and type of file extension.
	 * @param string $_ext File extension
	 * @access public
	 * @return string MIME type of file.
	 * @static
	 */
	public static function check($_file_addr, $_ext = null, $_meta = [])
	{
		$mimes = self::mime();


		// only accept valid files
		$myResult = ['allow' => false];

		// if exist in list return it
		if(array_key_exists(mb_strtolower($_ext), $mimes))
		{
			$myResult = $mimes[mb_strtolower($_ext)];
		}
		else
		{
			$myResult = [ 'allow' => false, 'type' => 'file', 'mime' => 'application/octet-stream'];
		}

		// force check some other format
		if(in_array($_ext, ['php', 'php5', 'html', 'htaccess', 'exe', 'bat', 'bin']))
		{
			$myResult['allow'] = false;
		}

		if(isset($_meta['ext']) && is_string($_meta['ext']))
		{
			if($_ext !== $_meta['ext'])
			{
				$myResult['allow'] = false;
			}
		}

		// @example:  $_meta['ext'] = ['jpg', 'png']
		if(isset($_meta['ext']) && is_array($_meta['ext']))
		{
			$myResult['allow'] = in_array($_ext, $_meta['ext']);
		}

		// allow to upload
		if($myResult['allow'])
		{
			if(!function_exists('mime_content_type'))
			{
				$mime_content_type = self::_mime_content_type($_file_addr);
			}
			else
			{
				$mime_content_type = mime_content_type($_file_addr);
			}

			// force changed the extentio of file
			if(isset($myResult['mime']) && $myResult['mime'] !== $mime_content_type)
			{
				if($_ext === 'csv' && $mime_content_type === 'text/plain')
				{
					// mime of csv file is 'text/csv', 'text/plain'
					// https://github.com/PHPOffice/PhpSpreadsheet/issues/429
				}
				else
				{
					\dash\notif::error(T_("Content type of this file is different by extension of file"));

					$myResult['allow'] = false;
				}
			}
		}

		if($_ext === 'svg')
		{
			// script can not in file content. For example in svg user can send script!
			if(strpos(@file_get_contents($_file_addr), 'script') !== false)
			{
				\dash\notif::error(T_("Can not upload this file. Some keywords of this file is wrong!"));
				$myResult['allow'] = false;
			}
		}



		// else return the
		return $myResult;
	}


	public static function get_ext_from_mime($_mime)
	{
		$mime = self::mime();
		foreach ($mime as $key => $value)
		{
			if(isset($value['mime']) && $value['mime'] === $_mime)
			{
				return $key;
			}
		}
		return null;
	}


	public static function _mime_content_type($_addr)
	{
		if(!function_exists('finfo_open'))
		{
			return null;
		}
		$finfo  = \finfo_open(FILEINFO_MIME_TYPE);
		$result = \finfo_file($finfo, $_addr);
		\finfo_close($finfo);
		return $result;

	}


	public static function get_mime_ext($_ext)
	{
		$mime = self::mime();
		if(isset($mime[$_ext]))
		{
			return $mime[$_ext];
		}
		return false;
	}


	public static function is_ext($_ext)
	{
		$list = self::mime();

		if(isset($list[$_ext]))
		{
			return true;
		}

		return false;
	}


	public static function get_all_allow_ext()
	{
		$list = self::mime();
		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['allow']) && $value['allow'])
			{
				$new_list[$key] = $value;
			}
		}

		return $new_list;
	}
}
?>