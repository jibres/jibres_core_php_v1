<?php
namespace lib\ajib;


class installdb
{
	public function install()
	{
		$sql_file = glob(root. 'includes/database/jibres_install_db/*.sql');
		 print_r($sql_file);exit();
		if($sql_file)
		{
			foreach ($sql_file as $key => $sql_file_dir)
			{
				$query = file_get_contents($sql_file_dir);


				$result = \dash\pdo::query($query, [], true, ['database' => 'mysql']);
				var_dump($result);exit;
				if(!$result)
				{
					return throw new \Exception("Can not execute file $sql_file_dir. Go to log file and check the error", 1);
				}
			}

			return true;
		}
	}
}

