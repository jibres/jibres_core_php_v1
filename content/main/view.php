<?php
class main_view extends view_cls
{
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
		$this->global->page_title			= "";
		$this->global->page_desc			= $this->global->site_desc;
		$this->global->site_title_show		= true;

		$this->include->datatable			= false;
		$this->include->jquery				= true;

		//$this->global->menu					= menu_cls::list_menu();

		// *********************************************************************** Other ...
		$this->form = (object) "form";
		unset($this->form->scalar);
		$this->data->form			= $this->form;
		$this->data->layout			= './main/display.html';
		$this->data->macro['forms']	= 'macro/forms.html';
		$this->data->macro['list']	= 'macro/tagMaker.html';
		if(isset($_SESSION['error']) && isset($_SESSION['error'][config_lib::$URL]) && isset($_SERVER['HTTP_REFERER'])){
			$this->data->debug = $_SESSION['error'][config_lib::$URL];
			unset($_SESSION['error'][config_lib::$URL]);
		}

		if(method_exists($this, 'config')){
			$this->config();
			$this->checkRedirect();
		}
		$this->compile();

	}

	public final function createform($type = false, $args = array()){
		$this->data->extendForm = true;
		$cForm = new forms_lib();
		$form = $cForm->make($type, $args);
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
}
?>