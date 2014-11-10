<?php
class main_controller extends controller_cls
{
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
}
?>
