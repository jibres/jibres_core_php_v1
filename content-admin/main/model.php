<?php
class main_model{
	public $plugin = true;
	public $commit = array();
	public $rollback = array();
	public $endProcess = false;
	public final function __construct($controller, $local = false){
		// var_dump($this->sqlcustom_datatable2('users'));
		$this->controller = $controller;
		$sQl = new dbconnection_lib;
		$sQl->query("START TRANSACTION");
		if(isset($_POST['_post']) && method_exists($this, "post_$_POST[_post]")){
			$this->redirect(false, true, true);
			$sModel = "post_$_POST[_post]";
			#before config
			// $this->beforeConfig();
			#on config
			$this->$sModel();
			#after config
			// $this->afterConfig();

			$this->endEfect();

			if(isset($_POST['INPUT_MODEL_ID']) && isset($_SESSION['model'])){
				$KEY = array_search($_POST['INPUT_MODEL_ID'], $_SESSION['model']);
				unset($_SESSION['model'][$KEY]);
			}
			$array = debug_lib::compile();
			foreach ($array as $key => $value) {
				if(!is_array($value) || $key == 'msg') continue;
				foreach ($value as $k => $v) {
					$err = isset($v['error']) ? $v['error'] : $v;
					if(preg_match("/^\[\[(update|insert|delete|select)\s(.*)\s(true|false|successful|failed)\]\]$/", $err, $parm)){
						$err = _($parm[1]).' '._($parm[2]).' '._($parm[3]);
					}
					if(isset($v['error'])){
						$array[$key][$k]['error'] = $err;
					}else{
						$array[$key][$k] = $err;
					}
				}
			}
			if(ifAjax()){
				header('Content-Type: application/json');
				echo json_encode($array);
			}elseif($this->redirect){
				if(!isset($_SESSION['error'])) $_SESSION['error'] = array();
				$_SESSION['error'][$this->redirect->compileUrl()] = $array;
				$this->checkRedirect();
			}
		}elseif(!$local){
			page_lib::access("model");
		}
	}


	// ---------------------------------------------------------------- default controller and some other function for ADMIN

	public function sql_datatable($mytable=null)
	{
		// this function get table name and return all record of it. table name can set in view
		// if user don't pass table name function use current real method name get from url
		if ($mytable)
			$tmp_qry_table = 'table'.ucfirst($mytable);
		else
			$tmp_qry_table = 'table'.ucfirst($this->url_method_real());

		return $this->sql()->$tmp_qry_table()->select()->allassoc();
	}

	public function sqlcustom_datatable2($mytable=null)
	{
		// this function get table name and return all record of it. table name can set in view
		// if user don't pass table name function use current real method name get from url
		if ($mytable)
			$tmp_qry_table = 'table'.ucfirst($mytable);
		else
			$tmp_qry_table = 'table'.ucfirst($this->url_method_real());

		return $this->sql()->$tmp_qry_table()->select()->allassoc();
	}
	/**
	 @Javad: check if new slug is not exist in table
	**/
	public function sql_datarowbyid($mytable=null, $myid=null)
	{
		// this function get table name and slug then related record of it. table name and slug can set
		// but if user don't pass table name or slug,
		// function use current real method name get from url for table name and current parameter for slug
		if (!$mytable)
			$mytable = $this->url_method_real();

		// if myid parameter set use it else use url parameter for myid
		if (!$myid)
			$myid = $this->url_parameter();
		
		$mytable		= ucfirst($mytable);
		$tmp_qry_where	= 'whereId';
		$mytable		= 'table'.$mytable;


		$tmp_result = $this->sql()->$mytable()->$tmp_qry_where($myid)->select();
		
		if ($tmp_result->num() == 1)
		{
			return $tmp_result->assoc();
		}
		elseif($tmp_result->num() > 1)
		{
			page_lib::access("id is found 2 or more times. it's imposible!");
		}
		else
		{
			page_lib::access("Url incorrect: id not found");
		}
		return 0;
	}

	public function sql_datarowbyslug($mytable=null, $myslug=null)
	{
		// this function get table name and slug then related record of it. table name and slug can set
		// but if user don't pass table name or slug,
		// function use current real method name get from url for table name and current parameter for slug
		if (!$mytable)
			$mytable = $this->url_method_real();

		// if myslug parameter set use it else use url parameter for myslug
		if (!$myslug)
			$myslug = $this->url_parameter();
		
		$mytable		= ucfirst($mytable);
		$tmp_qry_where	= 'where'. substr($mytable, 0, -1). '_slug';
		$mytable		= 'table'.$mytable;


		$tmp_result = $this->sql()->$mytable()->$tmp_qry_where($myslug)->select();
		
		if ($tmp_result->num() == 1)
		{
			return $tmp_result->assoc();
		}
		elseif($tmp_result->num() > 1)
		{
			page_lib::access("slug is found 2 or more times. it's imposible!");
		}
		else
		{
			page_lib::access("Url incorrect: slug not found");
		}
		return 0;
	}


	public function sql_query()
	{
		// for debug uncomment below line for disable redirect
		// $this->redirect 	= false;
		$tmp_module			= $this->url_method_real();
		$tmp_qry_table		= 'table'.ucfirst($tmp_module);
		$tmp_qry			= $this->sql()->$tmp_qry_table();
		$tmp_table_prefix	= $this->url_table_prefix();

		$tmp_datatable		= $this->sql_datatable($tmp_module);
		// var_dump($tmp_datatable);
		if($tmp_datatable)
		{
			// get all fields of table and filter fields name for show in datatable, access from columns variable
			// check if datatable exist then get this data
			$fields			= array_keys($tmp_datatable[0]);
			$tmp_columns	= array_fill_keys($fields, null);
			$isnull			= true;

			foreach ($fields as $key)
			{
				if ($key!=='id' and $key!=='date_created' and $key!=='date_modified')
				{
					$tmp_columns[$key] = substr($key,strrpos($key,'_')+1);
					if ($tmp_columns[$key]==='Id')
					{
						// if this field related with other table(foreign key) only show the target table
						$tmp_columns[$key] = ucfirst(substr($key,0,strrpos($key,'_')));
					}
					$tmp_col			= $tmp_columns[$key];
					$tmp_setfield		= 'set'.ucfirst($key) ;
					$tmp_value			= post::$tmp_col();
					if(!empty($tmp_value))
						$tmp_qry	= $tmp_qry->$tmp_setfield($tmp_value);

					if ($tmp_value)
						$isnull = false;
				}
			}
			if($isnull)
			{
				debug_lib::$status=0;
				debug_lib::msg("All of records are null");
			}
		}
		else
		{
			debug_lib::$status=0;
			debug_lib::msg("At least one record must be exist. This methode must be replace with read from table classes");
		}

		// var_dump($tmp_qry);
		return $tmp_qry;
	}

	function post_add()
	{
		// if you want to create special function for each module, simply declare a function post_add() and use it!
		// $this->redirect 	= false;
		$sql	= $this->sql_query()->insert();
		// var_dump($sql); exit();
		

		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		//
		// if query run without error means commit
		$this->commit(function()
		{
			debug_lib::true("Insert a new ". $this->url_table_prefix() ." successfully");
		} );

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			debug_lib::fatal("Insert a new ". $this->url_table_prefix() ." failed");
		} );
	}

	function post_edit()
	{
		// if you want to create special function for each module, simply declare a function post_edit() and use it!
		// $this->redirect 	= false;

		$tmp_qry_where		= 'whereId';
		$tmp_qry_id			= $this->url_parameter();
		$sql				= $this->sql_query()->$tmp_qry_where($tmp_qry_id)->update();
		// var_dump($sql); exit();


		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		//
		// if query run without error means commit
		$this->commit(function()
		{
			// $this->redirect->childChange('edit', false);
			debug_lib::true("Update ". $this->url_table_prefix() ." successfully");
		});

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function()
		{
			debug_lib::fatal("Update ". $this->url_table_prefix() ." failed");
		} );

	}

	function post_delete()
	{
		// if you want to create special function for each module, simply declare a function post_delete() and use it!
		// $this->redirect = false;

		$this->redirect->urlChange("delete", false);
		$tmp_module			= $this->url_method_real();
		$tmp_qry_table		= 'table'.ucfirst($tmp_module);
		$tmp_qry_slug		= $this->url_parameter();
		// two below line delete with slug
		// $tmp_table_prefix	= $this->url_table_prefix();
		// $tmp_qry_where		= 'where'.ucfirst($tmp_table_prefix).'_slug';
		$tmp_qry_where		= 'whereId';

		$sql				= $this->sql()->$tmp_qry_table()->$tmp_qry_where($tmp_qry_slug)->delete();


		// ======================================================
		// you can manage next event with one of these variables,
		// commit for successfull and rollback for failed
		//
		// if query run without error means commit
		$this->commit(function($tmp_slug=null)
		{
			debug_lib::true("Delete ". $this->url_table_prefix() ."($tmp_slug) successfully");
		}, $tmp_qry_slug);

		// if a query has error or any error occour in any part of codes, run roolback
		$this->rollback(function($tmp_slug=null)
		{
			debug_lib::fatal("Delete ". $this->url_table_prefix() ."($tmp_slug) failed");
		}, $tmp_qry_slug);	
	
	}



// 	function post_add_users()
// 	{
// 		$sql = $this->sql()
// 			->tableUsers()
// 			// -> $x = "where"."->$dsadas"
// 			->whereUser_email(post::user_email())
// 			->andUser_pass(post::user_pass())
// 			->select();
// // alternative
// // $f = "User_name";
// // $w = "where".$f;
// // $sql->tableUsers()
// // ->$w()
// // ->andPassword('111111')

// 		if(debug_lib::$status and $sql->num() == 0){
// 			debug_lib::fatal("username or password incorrect");
// 			// debug_lib::fatal("username or password incorrect", "user_pass", "form");
// 		}

// 		$this->commit(function($p){

// 		}, $sql->assoc());

// 		$this->rollback(function(){

// 		});
// 	}

	// function post_delete()
	// {
	// 	var_dump($this->redirect->urlChange("delete", false));
	// 	var_dump("delete");
	// }







	// ---------------------------------------------------------------- Until this line - Added by Javad


	public function endEfect(){
		$sQl = new dbconnection_lib;
		if($this->endProcess) return;
		$endEfect = (debug_lib::$status)? "commit" : "rollback";
		if(isset($this->$endEfect)){
			$aEndEfect = $this->$endEfect;
		}
		if(isset($this->$endEfect) && isset($aEndEfect[0]) && is_object($aEndEfect[0])){
			call_user_func_array($aEndEfect[0], array_slice($this->$endEfect, 1));
			$sQl->query("$endEfect");
		}
		$this->endProcess = true;
	}

	public function sql_loadForm($table, $args){
		$sql = $this->sql();
		$sqlf = $sql::$table();
		return $sqlf->loadForm($args);
	}

	public final function sql($name = false){
		$sql = new query_cls;
		$args = func_get_args();
		return call_user_func_array(array($sql, 'sql'), $args);
	}

	public final function commit(){
		$this->commit = func_get_args();
	}

	public final function rollback(){
		$this->rollback = func_get_args();
	}

	final function loadOnPlugin($name, $args){
		$this->loadBeforePlugin($name, $args);
		return call_user_func_array(array($this,$name), $args);
		$this->loadAfterPlugin($name, $args);
	}

	final function loadBeforePlugin($name, $args){
		if(!isset($this->plugin) || !$this->plugin) return;

	}

	final function loadAfterPlugin($name, $args){
		if(!isset($this->plugin) || !$this->plugin) return;
	}

	public function __call($name, $args){
		if(preg_grep('/^'.$name.'$/', $this->controller->__autocallMethod)){
			return call_user_func_array(array($this->controller, $name), $args);
		}
		if(preg_match("/^_sql_(.*)$/", $name, $method)){
			return $this->loadOnPlugin("sql_".$method[1], $args);
		}else{
			page_lib::core("invalid $name");
		}
	}

	public function __get($name){
		if(preg_grep('/^'.$name.'$/', $this->controller->__autogetProperty)){
			return $this->controller->$name;
		}else{
			return false;
		}
	}
}
?>