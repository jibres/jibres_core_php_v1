<?php
class dbTableOptions_lib{
	public $validate = null;
	public $form = null;
	public function validate(){
		if(!$this->validate){
			$this->validate = new validateMaker_lib(func_get_args());
		}
		return $this->validate;
	}

	public function form($type = false){
		$formL = new forms_lib();
		$form = $formL->make($type);
		$this->form = $form;
		$table = $this->table;
		if(isset($table->{$this->fieldName}->label)){
			$this->form->label($table->{$this->fieldName}->label);
		}
		if(!$this->validate){
			if(!$form->validate){
				$form->validate();
			}
			$this->validate = $form->validate;
			
		}
		return $form;
	}

	public function setChild($x = false){
		$args = func_get_args();
		$fn = false;
		if(isset($args[0])){
			$fn = isset($args[1]) ? $args[1] : $args[0];
			$fn = (get_class($fn) != "Closure") ? false : $fn;
		}
		$table = $this->table;
		$child = $table->{$this->fieldName}->type;
		$opt = $this->splitor($child);
		$form = $this->form;
		if($opt['type'] == 'enum' || $opt['type'] == 'set'){
			$tmp_values = $opt['value'];
			foreach ($tmp_values as $key => $value) {
				$childs = $form->child()->value($value)->label($value)->id($value);
				if($opt['type'] == "set"){
					$childs->name($form->attr['name'].'[]');
				}
				if($opt['default'] == $value){
					if(count($tmp_values)==2 && $tmp_values[0]=="yes" || $tmp_values[0]=="active"){
						$childs->checked("checked");
					}
					else{
						$childs->selected("selected");
					}
				}
			}
		}elseif( isset($table->{$this->fieldName}->foreign) ){
			// foreign written by javad @hasan: check for conflict with haram
			// check for count of running this function with uncomment below line
			// var_dump("test"); // this line run n times

			$field = $table->{$this->fieldName}->foreign;
			$options = $this->splitor($field);
			if(isset($args[0]) && is_string($args[0])){
				$default = $args[0];
			}else{
				$default = $options['default'] ? $options['default'] : $options['value'];
			}

			$order = "order".ucfirst($default);
			$sql = new sqlMaker_lib();
			$oType = $options['type'];
			$query = $sql::$oType()->$order();
			if(is_object($fn)) call_user_func_array($fn, array($query));
			$query = $query->select();
			foreach ($query->allAssoc() as $key => $value) {
				$this->form->child()->value($value[$options['value']])->label($value[$default])->id("list_child_".$value[$options['value']]);
			}
		}elseif(isset($table->foreign[$this->fieldName])){
			$field = $table->foreign[$this->fieldName];
			$options = $this->splitor($field);
			if(isset($args[0]) && is_string($args[0])){
				$default = $args[0];
			}else{
				$default = $options['default'] ? $options['default'] : $options['value'];
			}

			$order = "order".ucfirst($default);
			$sql = new sqlMaker_lib();
			$oType = $options['type'];
			$query = $sql::$oType()
			->$order();
			if(is_object($fn)) call_user_func_array($fn, array($query));
			$query = $query->select();
			foreach ($query->allAssoc() as $key => $value) {
				$this->form->child()->value($value[$options['value']])->label($value[$default])->id("list_child_".$value[$options['value']]);
			}
		}
	}


	private function splitor($string){
		preg_match("/^(.*)@([^\!]*)(\!(.*))?$/", $string, $split);
		if($split[1] == 'enum' || $split[1] == 'set'){
			$value = preg_split("/\s?,\s?/", $split[2]);
		}else{
			$value = $split[2];
		}
		return array("type"=> $split[1], "value" => $value, "default" => isset($split[4]) && !empty($split[4])? $split[4] : false);
	}
}