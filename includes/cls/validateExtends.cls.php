<?php
class validateExtends_cls{
	public function reg($reg = false){
		if(preg_match($reg, $this->value)){
			return true;
		}else{
			return false;
		}

	}
	public function id(){
		if($this->value == 'null' or preg_match("/^\d+$/", $this->name)){
			return true;
		}else{
			return false;
		}
	}

	public function date(){
	if($this->value == null) return true;		
		// var_dump($this->value);
		// $ptdt = "/^((13(89|9[0-9]))|(14(0[0-8])))\/(((0?[1-6])\/(0?[1-9]|[1-2]\d|3[0-1]))|((0?[7-9])\/(0?[1-9]|[1-2]\d|30))|((12)\/(0?[1-9]|[1-2]\d)))$/";
		if(!preg_match("/^(\d{4})(\-|\/|)(\d{1,2})(\-|\/|)(\d{1,2})$/", $this->value, $date)){
			return false;
		}else{

			$this->value = $date[1]
			.
			(($date[3] < 10) ? "0".$date[3] : $date[3])
			.
			(($date[5] < 10) ? "0".$date[5] : $date[5]);
		}
		return true;
	}

	public function username(){
		return true;
		if(!preg_match("/^\d{10}$/", $this->value)){
			return false;
			// $this->SetOnError('username');
		}
		return true;
	}

	public function repassword($repass){
		if($this->value != md5($this->_parm[$repass])){
			return false;
			// $this->SetOnError('repassword');
		}
		return true;
	}

	public function password(){
		if(!preg_match("/^.{6,32}$/", $this->value)){
			return false;
			// $this->SetOnError('password');
		}else{
			$this->value = md5($this->value);
		}
		return true;
	}

	public function fn($fn){
		$args = func_get_args();
		$debug = call_user_func_array($fn, array_slice($args, 1));
		if(!$debug){
			return false;
			// $this->SetOnError('fn');
		}
		return ture;
	}

	public function nationalcode(){
		// id 97 : iran
		if(validator_lib::$save["form"]['nationality']->value != '97'){
			if(preg_match("/\d/", $this->value)){
				return true;
			}else{
				return false;
			}
		}else{
			$code = $this->value;
			$r = false;
			if(strlen($code) == 10){
				$c = str_split($code);
				$main_place = array();
				$i = 10;
				$p = 0;
				foreach ($c as $n => $value) {
					$main_place[$i] = $value;
					if($i != 1){
						$p = $p + ($value * $i);
					}
					$i--;
				}
				$ba = fmod($p, 11);
				if($ba < 2){
					if($main_place[1] == $ba){
						$r = true;
					}else{
						$r = false;
					}
				}else{
					if($main_place[1] == (11 - $ba)){
						$r = true;
					}else{
						$r = false;
					}
				}
			}
			if($r){
				$this->value = $code;
			}else{
				return false;
				// $this->SetOnError('nationalcode');
			}
		}
	}

	public function number($a = false, $b = false){
		return true;
		$a = (preg_match("/^\d+$/", $a)) ? $a : 7;
		if(!$b){
			$num = '/^\d{'.$a.'}$/';
		}else{
			$b = (preg_match("/^\d+$/", $b)) ? $b : 0;
			$num = "/^\d{".$a.", ".$b."}$/";
		}
		if(!preg_match($num, $this->value)){
			return false;
			// $this->SetOnError('number');
		}else{
			$this->value = intval($this->value);
		}
		return true;
	}

	public function description($args = false){
		$args = trim($args);
		if(!preg_match("/^.{0,255}$/", $args)){
			$this->_type = "warn";
			return true;
			// $this->SetOnError('descript');
		}
		return true;
	}

	public function farsi($a = false, $b = false){
		$status = true;
		$strn = strlen(utf8_decode($this->value));
		$a = (preg_match("/^\d+$/", $a)) ? $a : false;
		if(!$b && $a !== false){
			if(!$strn != $a){
				$status= false;
			}
		}else{
			$b = (preg_match("/^\d+$/", $b)) ? $b : 0;
			if($strn < $a && $strn > $b){
				$status= false;
			}
		}
		$this->value = trim($this->value);
		$fa = "[ضصثقفغعهخحجچگکمنتالبیسشظطزرذدئوآةژ]";
		$pattern = "/^".$fa."{2,}(\s".$fa."{2,})*$/";
		if(!preg_match($pattern, $this->value)){
			$status= false;
		}
	}

	public function email() {
		if($this->value == null) return true;
		// daie();
		$reg_email = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
		if(preg_match($reg_email, $this->value)){
			return true;
		}else{
			return false;
		}
	}

	public function price() {
		return true;
	}

	public function title() {
		// $this->SetOnError('test for title');
		return true;
	}

	public function slug() {
		// $this->SetOnError('test for title');
		return true;
	}

}
?>