<?php
namespace content_a\product\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		// add back to product list link
		$product_list_link =  '<a href="'. $this->url('baseFull') .'/product/summary" data-shortkey="118">'. T_('Products dashboard'). '</a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/product/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'   => \lib\utility::get('order'),
			'sort'    => \lib\utility::get('sort'),
			'barcode' => \lib\utility::get('barcode'),
			'in'      => \lib\utility::get('in'),
		];

		$search_string            = \lib\utility::get('q');

		$this->data->product_list = \lib\app\product::list($search_string, $args);

		if(is_array($this->data->product_list) && count($this->data->product_list) === 1)
		{
			$barcode_is_scaned = false;
			if(isset($this->data->product_list[0]['barcode']) && $this->data->product_list[0]['barcode'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($this->data->product_list[0]['barcode2']) && $this->data->product_list[0]['barcode2'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($this->data->product_list[0]['id']) && $barcode_is_scaned)
			{
				$this->redirector($this->url('baseFull').'/product/edit/general?id='. $this->data->product_list[0]['id'])->redirect();
				return;
			}

		}

		if(\lib\utility::get('json') === 'true')
		{
			if(\lib\utility::get('barcode'))
			{
				if(!$this->data->product_list)
				{
					$this->data->product_list = null;
				}
			}

			echo json_encode($this->data->product_list, JSON_UNESCAPED_UNICODE);
			\lib\code::exit();
		}

		$this->data->sort_link = self::make_sort_link(\lib\app\product::$sort_field, $this->url('baseFull'). '/product');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
