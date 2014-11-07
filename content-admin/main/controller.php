<?php
class main_controller
{
	public $onUrl = false;
	public $querys;
	public $__autocallMethod = array("sql", "redirect", "checkRedirect", "addMethod", "addPeroperty");
	public $__autogetProperty = array( "redirect");
	public final function __construct()
	{
		$this->querys = (object) array();
		if(method_exists($this, 'config'))
		{
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
		$this->addMethod('url_child_real');
		$this->addMethod('url_child');
		$this->addMethod('url_table_prefix');
		$this->addMethod('url_method_real');
		$this->addMethod('url_method');
		$this->addMethod('url_class');
		$this->addMethod('url_parameter');
		$this->addMethod('url_title');
		// $this->addMethod('slugify');

		$this->addPeroperty('edit_datarow');


		// @ Hasan: is this listen correct?
		$this->listen(
			array(
				"domain" => "admin",
				),
			array()
		);

		if ($this->url_method())
		{
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array('add')
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "edit" => "/^[0-9]{1,10}+$/")
					// "url" => array("/.*/", "edit" => "/^[a-z0-9-]+$/")
					),
				array()
			);
			$this->listen(
				array(
					"min" => 1,
					"max" => 1,
					"url" => array("/.*/", "delete" => "/^[0-9]{1,10}+$/")
					// "url" => array("/.*/", "delete" => "/^\d+$/")
					),
				array( 'mod' => 'delete')
			);
		}
	}

	// declare public variable for save last row data for edit records
	public $edit_datarow = 'datarow';

	/*
	 * this function check url and has two method for check address
	 * first compare current address with user entered value and return True or False
	 * second condition return the title of page
	 */
	function url_child_real()
	{
		// this function must go to saloos
		$mychild = explode('/', config_lib::$URL);
		if(count($mychild)>2)
			$mychild = $mychild[2];
		else
			$mychild = null;

		if($mychild == 'add')
			return 'add';
		
		$mychild = substr($mychild,0,strrpos($mychild,'='));
		if($mychild == 'edit')
			return 'edit';
	}

	function url_child($child="add")
	{
		// var_dump(config_lib::$child);
		return config_lib::$child;
	}

	function url_table_prefix()
	{
		return substr($this->url_method_real(), 0, -1);
	}

	function url_method_real()
	{
		// this function must go to saloos
		$tmp_method = explode('/', config_lib::$URL);
		return $tmp_method[1];
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
		/**
		@Hasan: Trim and safe the parameter in saloos
		**/
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

	function url_id()
	{
		// check if user id on this table exist then return correct value else return 0
		return 0;
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
