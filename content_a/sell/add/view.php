<?php
namespace content_a\sell\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new sell');
		$this->data->page['desc']  = T_('You can add new sell and after add with minimal data, we allow you to add extra detail of sell.');
	}
}
?>
