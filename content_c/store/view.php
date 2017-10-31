<?php
namespace content_c\store;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Stores");
		$this->data->page['desc']  = T_("View list of stores and add new one easily just in seconds.");

		$this->data->list_store    = $this->model()->getListStore();
	}
}
?>