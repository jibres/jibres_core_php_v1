<?php
namespace lib\db\form_load;


class get
{


	public static function get($_id)
	{
		$query  = "SELECT * FROM form_load WHERE form_load.id = :id  LIMIT 1";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function by_token($_token)
	{
		$query  = "SELECT * FROM form_load WHERE form_load.token = :token  LIMIT 1";
		$param  = [':token' => $_token];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function checkUniqueIpAgent($_form_id, mixed $_ip_id, mixed $_agent_id)
	{
		$query =
			"
				SELECT 
				    form_answer.id AS `id` 
				FROM 
				    form_load
				RIGHT JOIN form_answer ON form_load.id = form_answer.form_load_id
				WHERE 
				    form_load.form_id = :form_id AND
				    form_load.ip_id = :ip_id AND  
				    form_load.agent_id = :agent_id 	AND 
				    form_answer.status != 'deleted'
				LIMIT 1
			";

		$param =
			[
				':form_id'  => $_form_id,
				':ip_id'    => $_ip_id,
				':agent_id' => $_agent_id,
			];

		$result = \dash\pdo::get($query, $param, 'id', true);

		return $result;
	}


	public static function checkUniqueUserId($_form_id, mixed $_user_id)
	{
		$query =
			"
				SELECT 
				    form_answer.id AS `id` 
				FROM 
				    form_load
				RIGHT JOIN form_answer ON form_load.id = form_answer.form_load_id
				WHERE 
				    form_load.form_id = :form_id AND
				    form_load.user_id = :user_id  AND
				    form_answer.status != 'deleted'
				     		    
				LIMIT 1
			";

		$param =
			[
				':form_id' => $_form_id,
				':user_id' => $_user_id,
			];

		$result = \dash\pdo::get($query, $param, 'id', true);

		return $result;
	}

}
