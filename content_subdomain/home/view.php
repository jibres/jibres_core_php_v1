<?php
namespace content_subdomain\home;

class view extends \mvc\view
{
	function config()
	{
		$this->data->bodyclass = 'unselectable flex align-center justify-center txtc';

		$this->include->js     = false;
	}
}
?>