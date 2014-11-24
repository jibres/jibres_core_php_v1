<?php
class model extends main_model
{
	public function sql_datatable22($mytable=null)
	{
		// this function get table name and return all record of it. table name can set in view
		// if user don't pass table name function use current real method name get from url
		if ($mytable)
			$tmp_qry_table = 'table'.ucfirst($mytable);
		else
			$tmp_qry_table = 'table'.ucfirst(config_lib::$method);
		return $this->sql()->$tmp_qry_table()->select()->allassoc();
	}
	
}
?>