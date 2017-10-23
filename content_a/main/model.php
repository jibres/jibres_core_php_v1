<?php
namespace content_a\main;

class model extends \mvc\model
{
	/**
	 * USE ALL API FUNCTION
	 */
	use _use;


	/**
	 * set user id to use in api
	 */
	public function __construct()
	{
		// set user id for use in api
		$this->user_id = $this->login('id');

		parent::__construct(...func_get_args());
	}
}
?>