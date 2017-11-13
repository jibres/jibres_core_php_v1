<?php
namespace content_a\product\summary;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Products Summary');
		$this->data->page['desc']  = T_('Some detail about your product!');

		$this->data->page['badge']['link'] = '/a/product/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$this->data->dashboard_detail = \lib\app\product::dashboard();
	}
}
?>
