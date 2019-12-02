<?php
namespace dash\db\mysql\tools;

trait backup
{

	/**
	 * this function create a backup from db with exec command
	 * the backup file with bz2 compressing method is created in projectdir/backup/db/
	 * for using this function call it with one of below types
	 * db::backup();
	 * db::backup('Daily');
	 * db::backup('Weekly');
	 * @param  [type] $_period the name of subfolder or type of backup
	 * @return [type]          status of running commad
	 */
	public static function backup_dump($_options = [])
	{
		$default_options =
		[
			'lock_tables' => false,
			'download'    => true,
			'db_name'     => null,
			'dir'         => null,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		// TO CONNECT TO DATABSE AND SET DB_USER
		\dash\db::get("SELECT NULL");

		if(!$_options['db_name'])
		{
			$db_name = \dash\db::$db_name;
		}
		else
		{
			$db_name = $_options['db_name'];
		}

		\dash\notif::warn("Hi :)");
		return false;

		$dest_file  = $db_name.'_'. date('Y-m-d_H-i-s'). '.sql.bz2';

		if(!$_options['dir'])
		{
			$dest_dir   = database."backup/files/";
		}
		else
		{
			$dest_dir   = $_options['dir'];
		}

		// create folder if not exist
		if(!is_dir($dest_dir))
		{
			mkdir($dest_dir, 0755, true);
		}

		$cmd  = "mysqldump --single-transaction --add-drop-table";

		if(!$_options['lock_tables'])
		{
			$cmd  .= " --skip-lock-tables ";
		}

		return false;
		// $cmd .= " --host='$db_host' --set-charset='$db_charset'";
		// $cmd .= " --user='".\dash\db::$db_user."'";
		// $cmd .= " --password='".\dash\db::$db_pass."' '". $db_name."'";
		// $cmd .= " | bzip2 -c > $dest_dir$dest_file";

		// to import this file
		// bunzip2 < filename.sql.bz2 | mysql -u root -p db_name
		$return_var = NULL;
		$output     = NULL;
		$result     = exec($cmd, $output, $return_var);

		if($return_var === 0)
		{
			if($_options['download'])
			{
				\dash\file::download($dest_dir. $dest_file);
			}
			return true;
		}
		return false;
	}


}
?>
