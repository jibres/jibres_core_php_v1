<?php
namespace content_c\store\add;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Add New Store");
		$this->data->page['desc'] = T_("Add with simple detail and config more after adding new store.");
	}
}
?>