<?php
namespace content_a\staff\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new staff');
		$this->data->page['desc']  = T_('You can add new staff and after add with minimal data, we allow you to add extra detail of staff.');
	}
}
?>
