<?php
namespace content_c\home;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Jibres Dashboard");
		$this->data->page['desc'] = T_("Glance at your stores and quickly navigate to stores.");
	}
}
?>