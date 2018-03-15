<?php
namespace content_a\product\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		// add back to product list link
		$product_list_link =  '<a href="'. \lib\url::this() .'/summary" data-shortkey="121">'. T_('Products dashboard'). '</a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$this->data->page['badge']['link'] = \lib\url::this(). '/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'   => \lib\request::get('order'),
			'sort'    => \lib\request::get('sort'),
		];

		if(\lib\request::get('barcode'))
		{
			$args['barcode'] = \lib\request::get('barcode');
		}

		if(\lib\request::get('price'))
		{
			$args['price'] = \lib\request::get('price');
		}

		if(\lib\request::get('buyprice'))
		{
			$args['buyprice'] = \lib\request::get('buyprice');
		}

		if(\lib\request::get('cat'))
		{
			$args['cat'] = \lib\request::get('cat');
		}

		if(\lib\request::get('discount'))
		{
			$args['discount'] = \lib\request::get('discount');
		}

		if(\lib\request::get('unit'))
		{
			$args['unit'] = \lib\request::get('unit');
		}

		$search_string            = \lib\request::get('q');

		if($search_string)
		{
			$this->data->page['title'] = T_('Search'). ' '.  $search_string;
		}

		$this->data->dataTable = \lib\app\product::list($search_string, $args);

		if(is_array($this->data->dataTable) && count($this->data->dataTable) === 1)
		{
			$barcode_is_scaned = false;
			if(isset($this->data->dataTable[0]['barcode']) && $this->data->dataTable[0]['barcode'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($this->data->dataTable[0]['barcode2']) && $this->data->dataTable[0]['barcode2'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($this->data->dataTable[0]['id']) && $barcode_is_scaned)
			{
				$this->redirector(\lib\url::this().'/edit/general?id='. $this->data->dataTable[0]['id'])->redirect();
				return;
			}

		}

		if(\lib\request::get('json') === 'true')
		{
			if(\lib\request::get('barcode'))
			{
				if(!$this->data->dataTable)
				{
					$this->data->dataTable = null;
				}
			}

			echo json_encode($this->data->dataTable, JSON_UNESCAPED_UNICODE);
			\lib\code::exit();
		}

		$this->data->barcode_scaned = null;
		if(\lib\request::get('q') && ctype_digit(\lib\request::get('q')) && mb_strlen(\lib\request::get('q')) === 13)
		{
			$this->data->barcode_scaned = '?barcode='. \lib\request::get('q');
		}
		$this->data->dataFilter = $this->createFilterMsg($args);
		$this->data->sort_link = self::make_sort_link(\lib\app\product::$sort_field, \lib\url::here(). '/product');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
