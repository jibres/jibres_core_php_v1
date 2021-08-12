<?php
namespace content_sudo\log;

class view
{
	public static function config()
	{
		if(\dash\request::get('folder'))
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());

		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here());

		}

		if(\dash\request::get('folder') && \dash\request::get('file'))
		{
			$addr = YARD. 'jibres_log/'. \dash\request::get('folder'). '/'. \dash\request::get('file');
			$addr = \autoload::fix_os_path($addr);
			if(!is_file($addr))
			{
				\dash\header::status(404, "File not Found");
			}

			self::load_file($addr);

		}
		elseif(\dash\request::get('folder'))
		{
			$folder = '/'. trim(\dash\request::get('folder'),'/');

			$addr = YARD. 'jibres_log'. $folder. '/*';
			$addr = \autoload::fix_os_path($addr);

			$glob = glob($addr);
			$list = [];
			foreach ($glob as $key => $value)
			{
				$name = basename($value);
				$is_old = false;

				if(strtotime(substr($name, 0, 10)) !== false)
				{
					$is_old = true;
				}

				$pathinfo = pathinfo($value);

				$filesize = filesize($value);

				$auto_rename = false;
				if(preg_match("/(.*)_(\d{14})\./", $name))
				{
					if(strpos($name, 'archive_') === false)
					{
						$auto_rename = true;
					}
				}

				$auto_archive = false;
				if(preg_match("/archive_\d{14}\.zip/", $name))
				{
					$auto_archive = true;
				}

				$is_new = false;
				if(!$is_old && !$auto_rename && !$auto_archive)
				{
					$is_new = true;
				}


				$list[] =
				[
					'ext'          => a($pathinfo, 'extension'),
					'size_raw'     => $filesize,
					'name'         => $name,
					'mtime'        => filemtime($value),
					'size'         => round(($filesize / 1024) / 1024, 2),
					'is_old'       => $is_old,
					'auto_rename'  => $auto_rename,
					'auto_archive' => $auto_archive,
					'new'          => $is_new,
				];
			}

			$sort_column = array_column($list, 'mtime');

			array_multisort($list, SORT_DESC, SORT_NUMERIC, $sort_column);

			$list = array_reverse($list);
			\dash\data::logFileList($list);

		}
		else
		{
			$addr = YARD. 'jibres_log/*';
			$addr = \autoload::fix_os_path($addr);
			$glob = glob($addr);
			$list = [];
			foreach ($glob as $key => $value)
			{
				$name = str_replace(YARD. 'jibres_log/', '', $value);

				switch ($name)
				{
					case 'php':
						$icon = 'bug';
						break;

					case 'database':
						$icon = 'database';
						break;

					case 'header':
						$icon = 'flag-1';
						break;

					default:
						$icon = 'bug-2';
						break;
				}

				$list[] =
				[
					'icon' => $icon,
					'name' => $name,
				];
			}
			\dash\data::logList($list);
		}

	}

	private static function load_file($_filepath)
	{
		if(\dash\request::get('clear'))
		{
			$mbasename = basename($_filepath);
			$basename  = date("Y-m-d_H-i-s_"). $mbasename;
			$clearURL  = str_replace($mbasename, $basename, $_filepath);
			\dash\file::rename($_filepath, $clearURL);
			\dash\redirect::to(\dash\url::current(). '?folder='. \dash\request::get('folder'));
		}


		\dash\file::download($_filepath);
		\dash\code::boom();


		$output     = '<html>';
		$name       = \dash\request::get('file');
		$isClear    = \dash\request::get('clear');
		$isZip      = \dash\request::get('zip');
		$clearName  = '';
		$clearURL   = '';
		$page       = \dash\request::get('p') * 100000;

		if($page< 0)
		{
			$page = 0;
		}

		$lenght      = \dash\request::get('lenght');

		if($lenght< 100000)
		{
			$lenght = 100100;
		}

		$filepath   = $_filepath;

		if($isClear)
		{
			\dash\file::rename($filepath, $clearURL);
			\dash\redirect::to(\dash\url::this());
		}

		if($isZip)
		{
			$newZipAddr = YARD.'jibres_log/database/log/dl.zip';
			// create zip
			if(\dash\utility\zip::create($filepath, $newZipAddr) === true)
			{
				\dash\utility\zip::download_on_fly($newZipAddr, $clearName);
			}
		}

		if (\dash\request::get('download'))
		{
			\dash\file::download($filepath);
			return;
		}
		// read file data
		$fileData = @file_get_contents($filepath, FILE_USE_INCLUDE_PATH, null, $page, $lenght);
		$myURL    = \dash\url::cdn(). '/';
		$myCommon = \dash\url::cdn(). '/js/jibres.min.js?v=1';
		$myCode   = \dash\url::cdn(). '/';

		$output .= "<head>";
		$output .= ' <title>Log | '. $name. '</title>';
		$output .= ' <script src="'. $myCommon. '"></script>';
		$output .= ' <script async src="'. $myCode. 'js/highlight/highlight.min.js"></script>';
		$output .= ' <link rel="stylesheet" href="'. $myCode. 'css/lib/highlight-atom-one-dark.css">';
		$output .= ' <style>';
		$output .= 'body{margin:0;height:100%;} a{background:#333;} .backbtnsu {position:absolute;top:1em;right:2em;border:1px solid #fff;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none} .clear{position:absolute;top:4em;right:2em;border:1px solid #fff;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none} .zip{position:absolute;bottom:1.5em;right:2em;background-color:#000;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none}
		.downloaditnow{position:absolute;top:7em;right:2em;border:1px solid #fff;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none}
		.hljs{padding:0;max-height:100%;height:100%;}';
		$output .= ' </style>';


		$output .= "</head><body>";
		// $output .= '<a class="clear primary" href="'. \dash\url::this(). '?folder='.\dash\request::get('folder').'">Back!</a>';
		$output .= '<a class="backbtnsu" href="'. \dash\url::this(). '?folder='.\dash\request::get('folder').  '">Back</a>';
		$output .= '<a class="clear" href="'. \dash\url::this(). '?clear=1&folder='.\dash\request::get('folder').'&file='.\dash\request::get('file').'">Clear it!</a>';
		$output .= '<a class="downloaditnow" data-direct href="'. \dash\url::this(). '?download=1&folder='.\dash\request::get('folder').'&file='.\dash\request::get('file').'">Download it!</a>';
		$output .= '<a class="zip" href="?name='. $name. '&zip=true">ZIP it!</a>';
		$output .= "<pre class=''>";
		$output .= $fileData;
		$output .= "</pre>";

		$output .= "</body></html>";
		echo $output;
		\dash\code::boom();

	}
}
?>