<?php
namespace content_a\main;


class view extends \mvc\view
{
	public function repository()
	{
		$this->data->bodyclass = 'fixed unselectable siftal';
		$this->include->chart  = true;

		$this->data->display['adminTeam'] = 'content_a\main\layoutTeam.html';
	}
}
?>