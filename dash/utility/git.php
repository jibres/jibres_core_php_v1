<?php
namespace dash\utility;

/** Git management **/
class git
{
	private static $baseLocation = null;




	/**
	 * @return dash commit count from Git
	 */
	public static function getCommitCount($_dash = true)
	{
		$commitCount = null;
		try
		{
			if($_dash)
			{
				chdir(core);
			}
			else
			{
				chdir(root);
			}
			if(self::command_exists('git'))
			{
				$commitCount = exec('git rev-list --all --count');
			}
		}
		catch (Exception $e)
		{
			$commitCount = 0;
		}

		return $commitCount;
	}



	/**
	 * @return last Update of dash
	 */
	public static function getLastUpdate($_dash = true)
	{
		$commitDate = null;
		try
		{
			if($_dash)
			{
				chdir(core);
			}
			else
			{
				chdir(root);
			}
			// var_dump(core);
			// var_dump(root);
			if(self::command_exists('git'))
			{
				$commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
				$commitDate = $commitDate->format('Y-m-d H:i:s');
			}
		}
		catch (\Exception $e)
		{
			$commitDate = date();
		}

		return $commitDate;
	}

	public static function command_exists($_command)
	{
		// on windows use where other use which
		$whereIsCommand = (PHP_OS == 'WINNT') ? 'where' : 'which';
		// execute command
		$returnVal      = shell_exec("$whereIsCommand $_command");
		// return command exist or not
		return (empty($returnVal) ? false : true);
	}

	/**
	 * clone git repository from specefic location
	 * @param  [type] $_location [description]
	 * @return [type]            [description]
	 */
	public static function pull($_location, $_boolResult = false, $_password = null)
	{
		if(!self::$baseLocation)
		{
			// if have not baseLocation get the value of this
			self::$baseLocation = getcwd();
		}
		else
		{
			// else change folder to baseLocation
			chdir(self::$baseLocation);
		}
		$result     = [];
		$resultBool = null;
		$output     = null;
		// if folder of location exist prepare commands
		if(\dash\file::exists($_location))
		{
			// change location to address of requested
			chdir($_location);
			// $command  = 'git pull '.$rep.' 2>&1';
			if($_password)
			{
				$command  = "sshpass -p '$_password' git pull origin master 2>&1";
			}
			else
			{
				$command  = 'git pull origin master 2>&1';
			}


			// Print the exec
			exec($command, $result);
			if(!$result)
			{
				$output     = T_('Not Work!');
				$resultBool = false;
			}
			else
			{
				$resultBool = true;
			}
			foreach ($result as $line)
			{
				$output .= $line . "\n";
			}
		}
		else
		{
			$output = T_('This location is not exist!');

		}

		if($_boolResult)
		{
			return $resultBool;
		}
		else
		{
			// start show result
			$html = "<pre>";
			$html .= 'Repository address <b>'. getcwd(). '</b><br/>';
			$html .= 'Remote address     <b>'. $_location. '</b><hr/>';
			$html .= $output;
			$html .= "</pre>";

			return $html;
		}
	}


	public static function gitdiscard($_location)
	{
		if(!self::$baseLocation)
		{
			// if have not baseLocation get the value of this
			self::$baseLocation = getcwd();
		}
		else
		{
			// else change folder to baseLocation
			chdir(self::$baseLocation);
		}

		$result     = [];

		$output     = null;
		// if folder of location exist prepare commands
		if(\dash\file::exists($_location))
		{
			// change location to address of requested
			chdir($_location);

			$command  = ' git checkout . & git clean -fd ';

			exec($command, $result);
			if(!$result || !is_array($result))
			{
				$output     = T_('NO change!');
			}

			foreach ($result as $line)
			{
				$output .= $line . "\n";
			}
		}
		else
		{
			$output = T_('This location is not exist!');
		}

		// start show result
		$html = "<pre>";
		$html .= htmlspecialchars($output);
		$html .= "</pre>";

		return $html;

	}

	public static function gitdiff($_location)
	{
		\dash\temp::set('git_diff_change', true);
		if(!self::$baseLocation)
		{
			// if have not baseLocation get the value of this
			self::$baseLocation = getcwd();
		}
		else
		{
			// else change folder to baseLocation
			chdir(self::$baseLocation);
		}

		$result     = [];

		$output     = null;
		// if folder of location exist prepare commands
		if(\dash\file::exists($_location))
		{
			// change location to address of requested
			chdir($_location);

			$command  = 'git diff ';

			exec($command, $result);
			if(!$result || !is_array($result))
			{
				$output     = T_('NO change!');
				\dash\temp::set('git_diff_change', false);
			}

			foreach ($result as $line)
			{
				$output .= $line . "\n";
			}
		}
		else
		{
			$output = T_('This location is not exist!');
		}

		// start show result
		$html = "<pre>";
		$html .= htmlspecialchars($output);
		$html .= "</pre>";

		return $html;

	}


	public static function gitstatus($_location)
	{
		if(!self::$baseLocation)
		{
			// if have not baseLocation get the value of this
			self::$baseLocation = getcwd();
		}
		else
		{
			// else change folder to baseLocation
			chdir(self::$baseLocation);
		}

		$result     = [];

		$output     = null;
		// if folder of location exist prepare commands
		if(\dash\file::exists($_location))
		{
			// change location to address of requested
			chdir($_location);

			$command  = 'git status ';

			exec($command, $result);
			if(!$result || !is_array($result))
			{
				$output     = T_('Not Work!');
			}

			foreach ($result as $line)
			{
				$output .= $line . "\n";
			}
		}
		else
		{
			$output = T_('This location is not exist!');
		}

		// start show result
		$html = "<pre>";
		$html .= $output;
		$html .= "</pre>";

		return $html;

	}



	public static function createPackage($_dash = true)
	{
		echo "<pre>";
		$res = [];
		//get details from last commit
		if($_dash)
		{
			chdir(core);
		}
		exec("git log --name-only --max-count=4", $res);
		//keep only files names, not commit details
		foreach($res as $k=>$string)
		{
			if(!is_file($string))
				unset($res[$k]);
		}
		//recount array
		\dash\code::dump($res);
		array_values($res);
		echo "<h1>Files found in git log result:</h1>";
		\dash\code::pretty($res);
		echo "<hr />";
		//specify the folder where your packages are stored
		$packagesfolder = core."packages";
		//specify the folder name for this particular package
		$folder = "package.".date("m.d.Y.h.i", time());
		// if the packages folder doesn't exist create one
		if(!is_dir($packagesfolder))
		{
			mkdir($packagesfolder);
			echo "<h1>Packages folder not found - created a new one</h1>";
			echo "<hr />";
		}
		// $result = self::create_zip($res, $packagesfolder.'/'.$folder.'.zip', true);
		// copy the files to the package folder and keep the entire folder structure
		// (eg: if a file is in ... sub_folder/sub_sub_folder/file.php ... it will be copied to packagefolder/sub_sub_folder/sub_sub_folder/file.php )

		foreach($res as $file)
		{
			exec('cp --parents '.$file.' '.$packagesfolder.'/');
		}

		echo "<h1>Files copied</h1>";
		echo "<hr />";
		//navigate to the packagefolder
		chdir($packagesfolder);
		//archive now

		exec( 'tar -cf '.$folder.'.tar *' );
		echo "<h1>Files archived</h1>";
		echo "<hr />";

		exec( 'mv '.$folder.'.tar ../' );
		echo "<h1>tar file moved to the packages folder</h1>";
		echo "<hr />";
		//return to the packages folder
		chdir( '..' );
		exec('rm -rf '.$folder.'/');
		echo "<h1>package folder removed</h1>";
		echo "<hr />";
		\dash\code::bye("done");
	}


	/* creates a compressed zip file */
	protected static function create_zip($files = [], $destination = '', $overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }
		//vars
		$valid_files = [];
		//if files were passed in...
		if(is_array($files))
		{
			//cycle through each file
			foreach($files as $file)
			{
				//make sure the file exists
				if(file_exists($file))
				{
					$valid_files[] = $file;
				}
			}
		}
		//if we have good files...
		if(count($valid_files))
		{
			//create the archive
			$zip = new \ZipArchive();
			if($zip->open($destination, $overwrite ? \ZIPARCHIVE::OVERWRITE : \ZIPARCHIVE::CREATE) !== true)
			{
				\dash\code::dump($destination);
				return false;
			}
			//add the files
			foreach($valid_files as $file)
			{
				$zip->addFile($file,$file);
			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

			//close the zip -- done!
			$zip->close();

			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}

}
?>