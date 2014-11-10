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

	// ---------------------------------------------------------------- default config function for ADMIN
	public function config() 
	{
		$this->data->child			= $this->url_child_real();
		$this->data->module			= $this->url_method_real();
		$this->data->table_prefix	= $this->url_table_prefix();
		$this->data->class			= $this->url_class();
		$this->global->page_title	= ucfirst($this->data->module);
		
		if(method_exists($this, "options")) $this->options();

		if($this->data->module)
		{
			if($this->data->child)
			{
				// in add, edit or delete pages
				$this->data->form_title		= ucfirst($this->url_table_prefix());
				$this->global->page_title	= $this->url_title() . ' ' . $this->data->form_title;
				$myForm						= $this->createform("@".$this->data->module, $this->data->child);
				$this->data->form_show		= true;

				
				if($this->url_child_real()==='edit')
				{
					$tmp_result = $this->sql("#datarowbyid");
					$this->fill_for_edit($tmp_result, $myForm);
				}
			}
			else
			{
				// in root page like site.com/admin/banks show datatable

				// get data from database through model
				$this->data->datatable		= $this->sql("#datatable");
				if($this->data->datatable)
				{
					// get all fields of table and filter fields name for show in datatable, access from columns variable
					// check if datatable exist then get this data
					$this->include->datatable	= true;
					// $fields					= array_keys($this->data->datatable[0]);
					$fields						= getTable_cls::get($this->url_method_real());
					$this->data->columns		= array_fill_keys($fields, null);
					$this->data->slug			= null;

					foreach ($fields as $key)
					{
						if ($key!=='id' and $key!=='date_modified')
						{
							$this->data->columns[$key] = ucfirst(substr($key,strrpos($key,'_')+1));
							if ($this->data->columns[$key]==='Id')
							{
								// if this field related with other table(foreign key) only show the target table
								$this->data->columns[$key] = ucfirst(substr($key,0,strrpos($key,'_')));
							}
							// if( $key== ($this->data->table_prefix.'_slug') )
							// {
							// 	$this->data->slug 		= $key;
							// 	// var_dump($this->data->slug);
							// }
						}
					}
				}
			}
		}
	}

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

	// ---------------------------------------------------------------- Until this line - Added by Javad


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