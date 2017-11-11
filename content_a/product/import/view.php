<?php
namespace content_a\product\import;


class view extends \content_a\main\view
{
	public function view_import($_args)
	{
		$this->data->page['title'] = T_('Add new product');
		$this->data->page['desc']  = T_('You can set detail of team product and assign some extra data to use later');
	}
}
?>
