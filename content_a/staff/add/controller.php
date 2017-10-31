<?php
namespace content_a\staff\add;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		// ADD NEW
		$this->get(false, 'staff_add')->ALL("/^staff\/add$/");
		$this->post('staff_add')->ALL("/^staff\/add$/");


	}
}
?>