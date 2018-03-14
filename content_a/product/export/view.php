<?php
namespace content_a\product\export;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Export product to CSV');
		$this->data->page['desc']  = T_('You can export all product to CSV file');

		$this->data->page['badge']['link'] = \lib\url::here(). '/product/summary';
		$this->data->page['badge']['text'] = T_('Back to product dashboard');
	}
}
?>
