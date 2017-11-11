<?php
namespace content_a\product\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new product or goods');
		$this->data->page['desc']  = T_('You can set main property of product and allow to assign some extra or edit it later.');
	}
}
?>
