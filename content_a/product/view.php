<?php
namespace content_a\product;

class view extends \content_a\main\view
{

	public function config()
	{
		$team                      = \lib\router::get_url(0);
		$product                    = \lib\router::get_url(3);

		if(isset($this->data->current_team['creator']))
		{
			$creator_id = $this->data->current_team['creator'];
			$creator_id = \lib\utility\shortURL::decode($creator_id);

			$userteam_id = $product;
			$userteam_id = \lib\utility\shortURL::decode($userteam_id);

			if($userteam_id)
			{
				$get_user_id = \lib\db\userteams::get(['id' => $userteam_id, 'limit' => 1]);

				if(isset($get_user_id['user_id']))
				{
					if(intval($get_user_id['user_id']) === intval($creator_id))
					{
						\lib\temp::set('change_creator', true);
					}
				}

				if(isset($get_user_id['rule']) && $get_user_id['rule'] === 'admin')
				{
					\lib\temp::set('change_admin', true);
				}
			}
		}

		$this->data->change_creator = \lib\temp::get('change_creator');
		$this->data->change_admin   = \lib\temp::get('change_admin');
		$this->data->is_admin       = \lib\temp::get('is_admin');
		$this->data->is_creator     = \lib\temp::get('is_creator');

		if($product)
		{
			$product                    = $this->model()->edit($team, $product);
			$this->data->product        = $product;
		}
	}


	/**
	 * get list of product on this team and branch
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_list($_args)
	{
		$team                    = \lib\router::get_url(0);
		$request                 = [];
		$request['id']           = $team;
		$product_list             = $this->model()->list_product($request);


		if(is_array($product_list))
		{
			$ids          = array_column($product_list, 'id');
			$product_list    = array_combine($ids, $product_list);
			$ids          = array_map(function($_a){return \lib\utility\shortURL::decode($_a);}, $ids);
			$product_session_list_time = \lib\session::get('product_list_detail_time');
			if(time() - intval($product_session_list_time) > 60)
			{
				$static_count = \lib\db\userteams::count_detail($ids, true);
				\lib\session::set('product_list_detail', $static_count);
				\lib\session::set('product_list_detail_time', time());
			}
			else
			{
				$static_count = \lib\session::get('product_list_detail');
			}

			foreach ($product_list as $key => $value)
			{
				if(array_key_exists($key, $static_count))
				{
					$product_list[$key]['stats'] = $static_count[$key];
				}
			}
		}

		$this->data->list_product = $product_list;

		if(isset($this->data->current_team['name']))
		{
			$this->data->page['title'] = T_('Member of :name', ['name'=> $this->data->current_team['name']]);
			$this->data->page['desc']  = T_('Quick view to team products and add or edit detail of products');
		}
	}
}
?>