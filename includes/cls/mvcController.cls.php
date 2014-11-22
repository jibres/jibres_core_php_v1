<?php
class mvcController_cls{
	public $onUrl = false;
	public $querys;
	public $__autocallMethod = array("sql", "redirect", "checkRedirect", "addMethod", "addPeroperty");
	public $__autogetProperty = array( "redirect");
	public final function __construct()
	{
		dbconnection_lib::$db_name_selected = db_name;
		$this->querys = (object) array();
		if(method_exists($this, 'config')) $this->config();
		if(method_exists($this, "options"))	$this->options();
				/**
		 * DONT REMOVE THIS COMMENTS ! ***************************
		 * array(class, method, child)
		 * array("class" => class, ...)
		 * array('admin', 'locations', '', 'delete')
		 * OR function(){save(class, method, child)}
		 * try to use array
		 */
		// add user defined method for use in view, model and controller

		
		$this->addMethod('url_table_prefix');
		$this->addMethod('url_parameter');
		$this->addMethod('url_title');
		// $this->addMethod('slugify');
	}


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



	/**
	@ below lines Added by Javad
	**/
	/**
	@Hasan: Trim and safe the parameter in saloos and copy below function to saloos
	**/




	function url_table_prefix()
	{
		return substr(config_lib::$method, 0, -1);
	}


	function url_parameter()
	{
		if ( isset(config_lib::$surl['edit']) && config_lib::$surl['edit']) 
			return trim( config_lib::$surl['edit'] );
		elseif ( isset(config_lib::$surl['delete']) && config_lib::$surl['delete']) 
			return trim( config_lib::$surl['delete'] );

		return null;
	}

	function url_title()
	{
		$mychild = current(config_lib::$aurl);
		if($mychild == 'add')
			return 'Add New';
		
		$mychild = substr($mychild,0,strrpos($mychild,'='));
		if($mychild == 'edit')
			return 'Edit';
	}

	static public function slugify($text)
	{ 
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		// trim
		$text = trim($text, '-');
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// lowercase
		$text = strtolower($text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		if (empty($text))
		{
			return 'n-a';
		}
		return $text;
	}


}