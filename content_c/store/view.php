<?php
namespace content_c\store;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Dashboard");
		$this->data->page['desc']  = T_("View team summary and add new team or change it");

		$list_store                = $this->model()->getListStore();
		$this->data->list_store    = $list_store;
	}
}
?>