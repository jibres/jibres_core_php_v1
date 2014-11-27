<?php
class listen_cls{
	public $cond = true;
	function __construct($c){
		$this->static = (isset($c['static']))? $c['static'] : true;
		if(!isset($c['min'])){
			$c['min'] = 0;
		}
		if(!isset($c['max'])){
			if(!isset($c['url'])){
				$c['max'] = 1;
			}else{
				if(is_array($c['url'])){
					$c['max'] = count($c['url']);
				}else{
					$c['max'] = 1;
				}
			}
		}
		foreach ($c as $key => $value) {
			if(method_exists($this, $key)){
				$this->$key($value);
			}
		}
	}
	function max($c){
		if($c < count(config_lib::$aurl))
			$this->cond = false;
	}

	function min($c){
		if(count(config_lib::$aurl) < $c)
			$this->cond = false;
	}

	function url($urlParameters){
		if(!is_array($urlParameters)){
			$this->checkUrlReg($urlParameters, config_lib::$url);
			return;
		}
		$k = 0;
		foreach ($urlParameters as $key => $value) {
			$array = (preg_match("/\d+/", $key)) ? config_lib::$aurl : config_lib::$surl;
			if(!isset($array[$key])){
				$this->cond = false;
				break;
			}
			$this->checkUrlReg($value, $array[$key]);
			$k++;
		}
	}

	function checkUrlReg($reg, $value){
		if(preg_match("/^(\/.*\/|#.*#|[.*])[gui]{0,3}$/i", $reg)){
			if(!preg_match($reg, $value)){
				$this->cond = false;
			}
		}elseif($reg != $value){
			$this->cond = false;
		}
	}

	function real_url($url_Parameters){
		$this->parametersCaller($url_Parameters, config_hendel_lib::$real_url);
	}

	function domain($domain_Parameters){
		$this->parametersCaller($domain_Parameters, config_hendel_lib::$a_domain, '.');
	}

	function func($f){
		if(!call_user_func($f)){
			$this->cond = false;
		}
	}

	/**
	 * 
	 */

	function parametersCaller($parameters, $array, $join = "/"){
		if(!is_array($parameters)){
			$this->check_parameters($parameters, join($array, $join));
			return;
		}
		$k = 0;
		foreach ($parameters as $key => $value) {
			if(!isset($array[$key])){
				$this->cond = false;
				break;
			}
			$this->check_parameters($value, $array[$key]);
			$k++;
		}
	}

	function check_parameters($reg, $value){
		if(preg_match("/^(\/.*\/|#.*#|[.*])[gui]{0,3}$/i", $reg)){
			if(!preg_match($reg, $value)){
				$this->cond = false;
			}
		}elseif($reg != $value){
			$this->cond = false;
		}
	}
}
?>