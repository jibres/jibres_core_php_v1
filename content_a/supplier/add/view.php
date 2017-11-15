<?php
namespace content_a\supplier\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new supplier');
		$this->data->page['desc']  = T_('You can add new supplier and after add with minimal data, we allow you to add extra detail of supplier.');
	}
}
?>
