<?php
class model extends main_model
{
	function post_add_users(){
		$sql = $this->sql()
			->tableUsers()
			->whereUser_email(post::user_email())
			->andUser_pass(post::user_pass())
			->select();
		if(debug_lib::$status and $sql->num() == 0){
			debug_lib::fatal("username or password incorrect");
			// debug_lib::fatal("username or password incorrect", "user_pass", "form");
		}

		$this->commit(function($p){

		}, $sql->assoc());

		$this->rollback(function(){

		});
	}



}
?>