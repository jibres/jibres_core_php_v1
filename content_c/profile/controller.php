<?php
namespace content_c\profile;

class controller extends \content_c\main\controller
{
	/**
	 * rout
	 */
	function ready()
	{

		$this->get(false, 'profile')->ALL('profile');
		$this->post('profile')->ALL('profile');
	}
}
?>