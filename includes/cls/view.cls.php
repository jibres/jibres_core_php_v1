<?php
class view_cls{
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
}

class aDATA{
	function compile(){
		return ((array) $this);
	}
}
?>