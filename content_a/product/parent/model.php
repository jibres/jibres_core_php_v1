<?php
namespace content_a\product\parent;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
{

	/**
	 * Gets the list.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function list_product($_args)
	{
		$this->user_id  = $this->login('id');


		$team_id        = utility\shortURL::decode(\lib\router::get_url(0));
		$get_userparent = ['related_id' => $team_id, 'status' => 'enable'];
		$userparent     = \lib\db\userparents::load_parent($get_userparent);



		$request        = [];
		$request['id'] = isset($_args['id']) ? $_args['id'] : null;
		utility::set_request_array($request);
		$result =  $this->get_list_product();

		if(!is_array($result))
		{
			return false;
		}

		$user_ids      = array_column($result, 'user_id');
		$user_ids      = array_map(function($_a){return \lib\utility\shortURL::decode($_a);}, $user_ids);
		$result        = array_combine($user_ids, $result);

		foreach ($userparent as $key => $value)
		{
			if(array_key_exists($value['user_id'], $result))
			{
				$result[$value['user_id']]['parent'][] = $value;
			}
		}
		// var_dump($result);exit();
		return $result;
	}
}
?>