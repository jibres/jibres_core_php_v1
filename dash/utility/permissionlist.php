<?php
namespace dash\utility;


class permissionlist
{
	private static $count_use = 0;
	private static $count = 0;
	private static $position = [];

	private static function find($_path)
	{
		$permission_caller = [];
		$directory         = new \RecursiveDirectoryIterator($_path);
		$flattened         = new \RecursiveIteratorIterator($directory);
		$files             = new \RegexIterator($flattened, "/\\.(php)\$/i");

		foreach($files as $file)
		{

			$fileExt     = \dash\file::getExtension($file);
			$lines       = file($file);
			$find_access = "\\permission::access(";
			$find_check  = "\\permission::check(";


			foreach($lines as $num => $line)
			{
				if(strpos($line, $find_access) !== false)
				{
					preg_match("/permission\::access\((\'|\")([\w\d\:\_\-]+)(\'|\")\)/", $line, $split);
					if(isset($split[2]))
					{
						self::$count_use++;
						$permission_caller[] = $split[2];

						if(!isset(self::$position[$split[2]]))
						{
							self::$position[$split[2]] = [];
						}
						self::$position[$split[2]][] = substr($file, 0). ' : line '. $num;
					}
				}

				if(strpos($line, $find_check) !== false)
				{
					preg_match("/permission\::check\((\'|\")([\w\d\:\_\-]+)(\'|\")\)/", $line, $split);
					if(isset($split[2]))
					{
						self::$count_use++;
						$permission_caller[] = $split[2];

						if(!isset(self::$position[$split[2]]))
						{
							self::$position[$split[2]] = [];
						}
						self::$position[$split[2]][] = substr($file, 0). ' : line '. $num;
					}


				}


			}
		}

		$permission_caller = array_filter($permission_caller);
		$permission_caller = array_unique($permission_caller);
		$permission_caller = array_values($permission_caller);
		self::$count += count($permission_caller);
		return $permission_caller;
	}


	// Create a files in language folder has contain twig trans value
	public static function extract()
	{
		ob_start();

		$mypath            = realpath(root).DIRECTORY_SEPARATOR;

		$permission_caller = self::find($mypath);

		$list_raw_project = \dash\plan_list::public_show_master_contain();
		$list_raw_project = array_keys($list_raw_project);


		$new_project = [];
		foreach ($permission_caller as $key => $value)
		{
			if(!in_array($value, $list_raw_project))
			{
				$new_project[] = $value;
			}
		}

		echo '<a href="'. \dash\url::here(). '">Back</a>';
		echo '<h1>EXTRACT PERMISSION CALLERS ('.self::$count.' callers founded | used in: '.self::$count_use.' place)</h1><hr>';
		echo '<h3>New in project</h3>';
		\dash\code::dump($new_project, true);



		echo '<hr><h3>All project</h3>';
		\dash\code::dump($permission_caller, true);


		echo '<hr><h3>Position</h3>';
		\dash\code::dump(self::$position, true);
	}
}
