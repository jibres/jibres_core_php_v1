<?php
namespace content_a\product\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of products');
		$this->data->page['desc']  = T_('You can search in list of products, add new product and edit existing.');

		// add back to product list link
		$product_list_link =  '<a href="'. $this->data->modulePath .'/summary" data-shortkey="121">'. T_('Products dashboard'). '</a>';
		$this->data->page['desc']  .= ' '. $product_list_link;

		$this->data->page['badge']['link'] = $this->data->modulePath. '/add';
		$this->data->page['badge']['text'] = T_('Add new product');

		$args =
		[
			'order'   => \lib\utility::get('order'),
			'sort'    => \lib\utility::get('sort'),
		];

		if(\lib\utility::get('barcode'))
		{
			$args['barcode'] = \lib\utility::get('barcode');
		}

		if(\lib\utility::get('price'))
		{
			$args['price'] = \lib\utility::get('price');
		}

		if(\lib\utility::get('buyprice'))
		{
			$args['buyprice'] = \lib\utility::get('buyprice');
		}

		if(\lib\utility::get('cat'))
		{
			$args['cat'] = \lib\utility::get('cat');
		}

		if(\lib\utility::get('discount'))
		{
			$args['discount'] = \lib\utility::get('discount');
		}

		if(\lib\utility::get('unit'))
		{
			$args['unit'] = \lib\utility::get('unit');
		}

		$search_string            = \lib\utility::get('q');

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
				$this->redirector($this->data->modulePath.'/edit/general?id='. $this->data->dataTable[0]['id'])->redirect();
				return;
			}

		}

		if(\lib\utility::get('json') === 'true')
		{
			if(\lib\utility::get('barcode'))
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
		if(\lib\utility::get('q') && ctype_digit(\lib\utility::get('q')) && mb_strlen(\lib\utility::get('q')) === 13)
		{
			$this->data->barcode_scaned = '?barcode='. \lib\utility::get('q');
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
