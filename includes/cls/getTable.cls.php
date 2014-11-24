<?php
class getTable_cls
{
	public static function get($name)
	{
		$ret = array();
		$table = sql_lib::getTable($name);
		foreach ($table as $key => $value) 
		{
			array_push($ret, $key);
		}
		return $ret;
	}

	public static function fields($name)
	{
		$ret = array();
		$table = sql_lib::getTable($name);
		foreach ($table as $key => $value) 
		{
			if (isset($value->closure->form))
			{
				$ret[$key] = substr($key,strrpos($key,'_')+1);
				if ($ret[$key]==='id' || $key=="user_id_customer")
				{
					// if this field related with other table(foreign key) only show the target table
					$ret[$key] = substr($key,0,strrpos($key,'_'));
				}
			}
			else
			{
				$ret[$key] = '';
			}
		}
		return $ret;
	}

	public static function datatable($name)
	{
		$ret = array();
		$table = sql_lib::getTable($name);
		foreach ($table as $key => $value) 
		{
			if (isset($value->closure->form))
			{
				$field_name = substr($key,strrpos($key,'_')+1);
				if ($field_name==='id' || $key=="user_id_customer")
				{
					// if this field related with other table(foreign key) only show the target table
					$field_name = substr($key,0,strrpos($key,'_'));
				}

				if($value->null=='YES')
				{
					$ret[$key] = false;
					
				}
				else
				{
					$ret[$key] = $field_name;
				}
			}
		}
		return $ret;
	}

	public static function forms($name)
	{
		$ret = array();
		$table = sql_lib::getTable($name);
		// var_dump($table);
		foreach ($table as $key => $value) 
		{

			if(isset($value->closure->form))
			{
				$field_name = substr($key,strrpos($key,'_')+1);
				if ($field_name==='id' || $key=="user_id_customer")
				{
					// if this field related with other table(foreign key) only show the target table
					$field_name = substr($key,0,strrpos($key,'_'));
				}
				// var_dump($field_name."::".$value->show);

				if($value->show=='YES')
				{
					$ret[$field_name]	= $field_name;
				}
				else
				{
					$ret[$field_name]	= '';
				}
			}
		}
		return $ret;
	}
}