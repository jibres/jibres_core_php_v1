<?php
namespace content_api\v1\store;
use \lib\debug;
use \lib\utility;
use \lib\db\logs;
class model extends \addons\content_api\v1\home\model
{
	use tools\add;
	use tools\get;
	use tools\delete;
	use tools\close;


	/**
	 * Posts a store.
	 * insert new store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function post_store()
	{
		return $this->add_store();
	}


	/**
	 * patch the ream
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function patch_store()
	{
		return $this->add_store(['method' => 'patch']);
	}


	/**
	 * Gets one store.
	 *
	 * @return     <type>  One store.
	 */
	public function get_one_store()
	{
		return $this->get_store();
	}


	/**
	 * Gets the store list.
	 *
	 * @return     <type>  The store list.
	 */
	public function get_storeList()
	{
		return $this->get_list_store();
	}
}
?>