<?php
class aDATA{
	function compile(){
		return ((array) $this);
	}
}

class view_cls{
	public final function __construct($controller)
	{
		$this->controller		= $controller;
		$this->data				= new aDATA();
		$this->data->global		= new aData();
		$this->data->url		= new aData();
		$this->data->include	= new aData();
		$this->global			= $this->data->global;
		$this->url				= $this->data->url;
		$this->include			= $this->data->include;
		$this->data->class		= $this->url_class();
		$this->data->module		= $this->url_method_real();
		$this->data->child		= $this->url_child_real();

		// *********************************************************************** Site Global Variables
		$this->url->domain					= DOMAIN;
		$this->url->path					= PATH;
		$host_names 						= explode(".", DOMAIN);
		$this->url->raw				 		= $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
		$this->url->root				 	= "http://" . $this->url->raw. '/';
		$this->url->current				 	= "http://" . DOMAIN . PATH;
		$this->url->static					= $this->url->root . 'static/';
		// $this->url->static				 	= $this->url->current .'static/';

		$this->global->site_title			= "Jibres";
		$this->global->site_desc			= "Store management by SAMAC";
		$this->global->page_title			= ucfirst($this->data->module);
		$this->global->page_desc			= $this->global->site_desc;
		$this->global->site_title_show		= true;

		$this->include->datatable			= false;
		$this->include->jquery				= true;

		//$this->global->menu					= menu_cls::list_menu();

		// *********************************************************************** Other ...
		$this->form = (object) "form";
		unset($this->form->scalar);
		$this->data->form			= $this->form;
		$this->data->layout			= 'main/display.html';
		$this->data->macro['forms']	= 'macro/forms.html';
		// $this->data->macro['list']	= 'macro/tagMaker.html';
		if(isset($_SESSION['error']) && isset($_SESSION['error'][config_lib::$URL]) && isset($_SERVER['HTTP_REFERER'])){
			$this->data->debug = $_SESSION['error'][config_lib::$URL];
			unset($_SESSION['error'][config_lib::$URL]);
		}

		if(method_exists($this, 'config')){
			$this->config();
			$this->checkRedirect();
		}
		if(method_exists($this, "options")) $this->options();
		$this->compile();

	}
	
	public $formIndex = array();
	public final function compile(){
		if(isset($this->data->form)){
			$aForm = array();
			$forms = $this->data->form;
			foreach ($forms as $key => $value) {
				if(method_exists($value, "compile")){
					$aForm[$key] = $value->compile();
				}else{
					$this->data->form->$key = array();
					foreach ($value as $ckey => $cvalue) {
						if(!method_exists($cvalue, 'compile')){
							echo "$ckey not found compile";
							exit();
						}
						$aForm[$key[$ckey]] = $cvalue->compile();
					}
				}
			}
		}
		$this->data->form = $aForm;
		$this->Localy();

		$Header 		= apache_request_headers();
		$tmpname		= config_lib::$class.'/'.config_lib::$method;
		$tmpname 		.= (config_lib::$child !='') ? '/'.config_lib::$child : '';
		$tmpname 		.='/display.html';
		if(ifAjax()){
			$this->data->layout = './main/xhr.html';
			echo '<div id="global">'.json_encode($this->global->compile())."</div>\n";
		}
		require_once core.'Twig/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();
		$loader			= new Twig_Loader_Filesystem(content);

		$twig			= new Twig_Environment($loader);
		$this->main_Extentions($twig);
		$template		= $twig->loadTemplate($tmpname);
		$template ->	display($this->data->compile());
	}

	public final function main_Extentions($twig){
		$twig->addFilter($this->twig_fcache());
		$twig->addFilter($this->twig_lang());
		if(DEBUG)
			$twig->addExtension(new Twig_Extension_Debug());
	}
	public function twig_fcache(){
		return new Twig_SimpleFilter('fcache', function ($string) {
			if(file_exists($string)){
				return $string.'?'.filemtime($string);
			}
		});
	}

	public function twig_lang(){
		return new Twig_SimpleFilter('lang', function ($string) {
			if(!empty($string)){
				$s = preg_split("/,/", $string);
				$a = array();
				foreach ($s as $key => $value) {
					array_push($a, gettext($value));
				}
				return join($a, '، ');
			}else{
				return $string;
			}
		});
	}

	public function __call($name, $args){
		if(preg_grep('/^'.$name.'$/', $this->controller->__autocallMethod)){
			return call_user_func_array(array($this->controller, $name), $args);
		}
	}

	public function __get($name){
		if(preg_grep('/^'.$name.'$/', $this->controller->__autogetProperty)){
			return $this->controller->$name;
		}else{
			return false;
		}
	}

	public function Localy(){
		/**
		 * forms
		 */
		$this->global->page_title = _($this->global->page_title);

	}

	public final function createform($type = false, $args = array()){
		$this->data->extendForm = true;
		$cForm = new forms_lib();
		// var_dump($cForm);
		$form = $cForm->make($type, $args);
		// var_dump($form);
		array_push($this->formIndex, $form);
		if(preg_match("/^@(.*)$/", $type, $name)){
			$this->form->{$name[1]} = $form;
			$form->hidden->value(preg_replace("/_[^_]*$/", "", $form->hidden->attr['value']));

		//************************************************************************************************
		}elseif(preg_match("/^.(.*)$/", $type, $name)){
			if(!isset($this->customforms)){
				$this->customforms = new customforms_cls;
				$this->form->{$name[1]} = $form = $this->customforms->{$name[1]}();
			}
		}
		//************************************************************************************************
		return $form;
	}


	/**
	@ below lines Added by Javad
	**/
	public function fill_for_edit($datarow, $form)
	{
		foreach ($form as $key => $value) 
		{
			if(isset($datarow[$key]))
			{
				$oForm = $form->$key;
				if($oForm->attr['type'] == "radio" || $oForm->attr['type'] == "select" || $oForm->attr['type'] == "checkbox")
				{
					foreach ($oForm->child as $k => $v)
					{
						if($v->attr["value"] == $datarow[$key])
						{
							if ($oForm->attr['type'] == "select")
							{
								$form->$key->child($k)->selected("selected");
							}
							else
							{
								$v->checked("checked");
							}
						}
					}
				}
				else
				{
					$oForm->value($datarow[$key]);
				}
			}
		}
	}



}
?>