<?php
namespace content_a\product\import;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Import product from CSV');
		$this->data->page['desc']  = T_('You can import more than one product in one request via CSV import process');

		$this->data->page['badge']['link'] = \lib\url::here(). '/product/summary';
		$this->data->page['badge']['text'] = T_('Back to product dashboard');
	}
}
?>
