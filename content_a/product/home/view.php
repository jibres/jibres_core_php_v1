<?php
namespace content_a\product\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		// add back to product list link
		$product_list_link =  '<a href="'. \dash\url::this() .'/summary" data-shortkey="121">'. T_('Products dashboard'). '</a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$this->data->page['badge']['link'] = \dash\url::this(). '/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];

		if(\dash\request::get('barcode'))
		{
			$args['barcode'] = \dash\request::get('barcode');
		}

		if(\dash\request::get('price'))
		{
			$args['price'] = \dash\request::get('price');
		}

		if(\dash\request::get('buyprice'))
		{
			$args['buyprice'] = \dash\request::get('buyprice');
		}

		if(\dash\request::get('cat'))
		{
			$args['cat'] = \dash\request::get('cat');
		}

		if(\dash\request::get('discount'))
		{
			$args['discount'] = \dash\request::get('discount');
		}

		if(\dash\request::get('unit'))
		{
			$args['unit'] = \dash\request::get('unit');
		}

		$search_string            = \dash\request::get('q');

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
				\dash\redirect::to(\dash\url::this().'/edit/general?id='. $this->data->dataTable[0]['id']);
				return;
			}

		}

		if(\dash\request::get('json') === 'true')
		{
			if(\dash\request::get('barcode'))
			{
				if(!$this->data->dataTable)
				{
					$this->data->dataTable = null;
				}
			}

			echo json_encode($this->data->dataTable, JSON_UNESCAPED_UNICODE);
			\dash\code::exit();
		}

		$this->data->barcode_scaned = null;
		if(\dash\request::get('q') && ctype_digit(\dash\request::get('q')) && mb_strlen(\dash\request::get('q')) === 13)
		{
			$this->data->barcode_scaned = '?barcode='. \dash\request::get('q');
		}
		$this->data->dataFilter = $this->createFilterMsg($args);
		$this->data->sort_link = self::make_sort_link(\lib\app\product::$sort_field, \dash\url::here(). '/product');

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
