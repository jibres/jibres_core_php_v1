<?php
namespace content_api\v1\store;

class controller extends \addons\content_api\home\controller
{

	/**
	 * store
	 */
	public function ready()
	{
		// get store list
		$this->get('storeList')->ALL('v1/store/list');
		$this->get('storeList')->ALL('v1/storelist');
		// get 1 store detail
		$this->get('one_store')->ALL('v1/store');
		// add new store
		$this->post('store')->ALL('v1/store');
		// update old store
		$this->patch('store')->ALL('v1/store');
	}
}
?>