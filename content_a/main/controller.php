<?php
namespace content_a\main;

class controller extends \mvc\controller
{

	/**
	 * rout
	 */
	public function repository()
	{
		if(!$this->login())
		{
			$this->redirector($this->url('base'). '/enter')->redirect();
			return;
		}
	}
}
?>