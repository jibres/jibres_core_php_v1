<?php
namespace content_a\main;

class view extends \mvc\view
{


	/**
	 * config
	 */
	public function repository()
	{
		$this->data->bodyclass = 'fixed unselectable siftal';
		$this->include->css    = true;
		$this->include->chart  = true;

		$this->data->display['adminTeam'] = 'content_a\main\layoutTeam.html';


	}
}
?>