<?php
class main_controller{
	public $onUrl = false;
	public $querys;
	public $__autocallMethod = array("sql", "redirect", "checkRedirect", "addMethod", "addPeroperty");
	public $__autogetProperty = array( "redirect");
	public final function __construct(){
		$this->querys = (object) array();
		if(method_exists($this, 'config')){
			$this->config();
		}
	}

	// ---------------------------------------------------------------- default controller and some other function for ADMIN
	public function config()
	{
		if(method_exists($this, "options")) $this->options();
		/**
		 * DONT REMOVE THIS COMMENTS ! ***************************
		 * array(class, method, child)
		 * array("class" => class, ...)
		 * array('admin', 'locations', '', 'delete')
		 * OR function(){save(class, method, child)}
		 * try to use array
		 */
		// add user defined method for use in view, model and controller
		$this->addMethod('url_child');
		$this->addMethod('url_method');
		$this->addMethod('url_class');
		$this->addMethod('url_parameter');
		$this->addMethod('url_title');
		$this->addMethod('submit_title');		

		if ($this->url_method())
		{
			if($this->url_child())
			{
				// in add, edit or delete pages do NOTHING
			}
			else
			{
				// in root page like site.com/admin/banks control
				$this->listen(
					array(
						"min" => 1,
						"max" => 1,
						"url" => array('add')
						),
					array('child' => 'add')
				);

				$this->listen(
					array(
						"min" => 1,
						"max" => 2,
						"url" => array('edit')
						// [ae][d][di][t]
						// ^add$ ^edit$
						),
					array('child' => 'add')
				);

				$this->listen(
					array(
						"min" => 1,
						"max" => 2,
						"url" => array('delete')
						),
					array('child' => 'home', 'mod' => 'delete')
				);
			}
		}
	}

	/*
	 * this function check url and has two method for check address
	 * first compare current address with user entered value and return True or False
	 * second condition return the title of page
	 */
	function url_child($child="add")
	{
		// var_dump(config_lib::$child);
		return config_lib::$child;
	}

	function url_method($method=false)
	{
		return config_lib::$method;
	}

	function url_class()
	{
		return config_lib::$class;
	}

	function url_parameter()
	{
		var_dump("parameter");
		var_dump(config_lib::$aurl[0]);
		if( isset(config_lib::$aurl[0]) && config_lib::$aurl[0] == 'edit' && isset(config_lib::$aurl[1]) )
			return (config_lib::$aurl[1]);
	}

	function url_title()
	{
		$mychild = current(config_lib::$aurl);
		if($mychild == 'add')
			return 'Add New';
		elseif($mychild == 'edit')
			return 'Edit';
	}

	function submit_title()
	{
		$mychild = current(config_lib::$aurl);
		if($mychild == 'add')
			return 'Submit';
		elseif($mychild == 'edit')
			return 'Save';
	}
	// ---------------------------------------------------------------- Until this line - Added by Javad


	public final function hendel(){
		$sMod = config_lib::$mod;
		$this->$sMod = new $sMod($this);
	}

	public final function addMethod($name){
		array_push($this->__autocallMethod, $name);
	}

	public final function addPeroperty($name){
		array_push($this->__autogetProperty, $name);
	}

	public final function sql($name){
		preg_match("/^(\.|@|#)?([a-z0-9_]*|([a-z0-9_]+)\.([a-z0-9_]+))$/Ui", $name, $type);
		$args = func_get_args();
		$args = array_splice($args, 1);

		if($type[1] == "@"){
			return call_user_func_array(array($this->model(), 'sql_'.$type[2]), $args);
		}elseif($type[1] == "." || count($type) == 5){
			$sClass = (count($type) == 5) ? $type[3] : $type[2];
			$qClass = "query_".$sClass.'_cls';
			$qMethod = (count($type) == 5) ? $type[4] : 'config';
			return call_user_func_array(array(new $qClass, $qMethod), $args);
		}elseif($type[1] == "#"){
			$qMethod = "sql_{$type[2]}";
			return call_user_func_array(array($this->model(), $qMethod), $args);
		}

	}

	public final function model(){
		if(!isset($this->model)){
			$this->model = new model($this, true);
		}
		return $this->model;
	}
	public final function view(){
		if(!isset($this->view)){
			$this->view = new view($this, true);
		}
		return $this->view;
	}

	public final function redirect($redirect = false, $exit = true, $php = false){
		$redirectClass = new redirector_cls($redirect, $exit, $php);
		$this->redirect = $redirectClass;
		return $redirectClass;
	}

	public final function checkRedirect(){
		if(isset($this->redirect) && is_object($this->redirect)){
			$this->redirect->redirect();
		}
	}

	public final function listen($cond, $callback = false){
		if(is_array($cond)){
			$listen = new listen_cls($cond);
			$cond = $listen->cond;
		}
		if($cond){
			$this->onUrl = true;
			if(gettype($callback) == 'object'){
				$args = func_get_args();
				$this->CallBackFunc = $callback;
				call_user_func_array($this->CallBackFunc, array_splice($args, 2));
			}else if(is_array($callback)){
				save($callback);
			}
		}
	}

	public function tag($tag = false) {
		return new tagMaker_lib($tag);
	}

	public function jTime() {
		return new jTime_lib;
	}

	public function dateNow() {
		return $this->jTime()->date("Ymd", false, false);
	}
}
?>