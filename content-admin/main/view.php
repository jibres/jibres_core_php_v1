<?php
class main_view
{
	public $formIndex = array();
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
		//var_dump($host_names);

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
			}
			else
			{
				// in root page like site.com/admin/banks show datatable
				$this->include->datatable	= true;

				// get data from database through model
				$this->data->datarow		= $this->sql("#datarow", $this->data->module);
				if($this->data->datarow)
				{
					// get all fields of table and filter fields name for show in datatable, access from columns variable
					// check if datarow exist then get this data
					$fields 					= array_keys($this->data->datarow[0]);
					$this->data->columns 		= array_fill_keys($fields, null);
					$this->data->slug			= null;

					foreach ($fields as $key)
					{
						if ($key!=='id' and $key!=='date_created' and $key!=='date_modified')
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





				// var_dump($this->data->datarow[0]);
				
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
		}
		return $form;
	}

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
}

class aDATA{
	function compile(){
		return ((array) $this);
	}
}
?>