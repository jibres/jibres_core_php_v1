<?php
namespace content_su\tempfile;

class view
{
	public static function config()
	{
		$dir = \dash\url::directory();
		$dir = str_replace('tempfile', '', $dir);

		if($dir)
		{
			$split_dir = explode('/', $dir);
			array_pop($split_dir);

			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here(). '/tempfile'. implode('/', $split_dir));

			$addr = YARD. 'jibres_temp/'. $dir;
			$addr = \autoload::fix_os_path($addr);
			if(is_dir($addr))
			{
				$glob = glob($addr. '/*');

				$list = [];
				foreach ($glob as $key => $value)
				{
					$name = basename($value);

					$list[] =
					[
						'name'  => $name,
						'mtime' => filemtime($value),
						'size'  => round((filesize($value) / 1024) / 1024, 2),

					];
				}

				$list = array_reverse($list);
				\dash\data::logFileList($list);
			}
			elseif(is_file($addr))
			{
				self::load_file($addr);
			}

		}
		else
		{
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::here());

			$addr = YARD. 'jibres_temp/*';
			$addr = \autoload::fix_os_path($addr);
			$glob = glob($addr);
			$list = [];
			foreach ($glob as $key => $value)
			{
				$name = str_replace(YARD. 'jibres_temp/', '', $value);

				switch ($name)
				{
					case 'cache':
						$icon = 'trash-can';
						break;

					case 'detail':
						$icon = 'align-left-1';
						break;

					case 'setting':
						$icon = 'cogs';
						break;

					case 'subdomain':
						$icon = 'radar-2';
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
			\dash\file::delete($_filepath);
			\dash\redirect::to(\dash\url::current(). '?folder='. \dash\request::get('folder'));
		}


		$output     = '<html>';
		$name       = \dash\request::get('file');

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

		// if (\dash\request::get('download'))
		{
			\dash\file::download($filepath);
			return;
		}
		// read file data
		$fileData = @file_get_contents($filepath, FILE_USE_INCLUDE_PATH, null, $page, $lenght);
		$myURL    = \dash\url::cdn(). '/';
		$myCommon = \dash\url::cdn(). '/js/siftal.min.js';
		$myCode   = \dash\url::cdn(). '/';

		$output .= "<head>";
		$output .= ' <title>Log | '. $name. '</title>';
		$output .= ' <script src="'. $myCommon. '"></script>';
		$output .= ' <script src="'. $myCode. 'js/highlight/highlight.min.js"></script>';
		$output .= ' <link rel="stylesheet" href="'. $myCode. 'css/lib/highlight-atom-one-dark.css">';
		$output .= ' <style>';
		$output .= 'body{margin:0;height:100%;} .backbtnsu {position:absolute;top:1em;right:2em;border:1px solid #fff;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none} .clear{position:absolute;top:4em;right:2em;border:1px solid #fff;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none} .zip{position:absolute;bottom:1.5em;right:2em;background-color:#000;color:#fff;border-radius:3px;padding:0.5em 1em;text-decoration:none}
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