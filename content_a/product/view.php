<?php
namespace content_a\product;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		$this->data->page['badge']['link'] = '/a/product/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'  => \lib\utility::get('order'),
			'sort'   => \lib\utility::get('sort'),
		];

		$this->data->product_list  = \lib\app\product::list(\lib\utility::get('q'), $args);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
