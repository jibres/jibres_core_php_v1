<?php
namespace content_a\products\edit;


class model
{
	public static function add()
	{
		$post = self::get_post();

		$result = \lib\app\product\add::add($post);

		if(!$result)
		{
			return false;
		}

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}
	}


	public static function get_post()
	{
		$post                    = [];
		$post['title']           = \dash\request::post('title');
		$post['desc']            = \dash\request::post('desc') ? $_POST['desc'] : null;
		$post['buyprice']        = \dash\request::post('buyprice');
		$post['price']           = \dash\request::post('price');
		$post['discount']        = \dash\request::post('discount');
		$post['vat']             = \dash\request::post('vat');
		$post['sku']             = \dash\request::post('sku');
		$post['code']            = \dash\request::post('code');
		$post['barcode']         = \dash\request::post('barcode');
		$post['barcode2']        = \dash\request::post('barcode2');
		$post['infinite']        = \dash\request::post('infinite');
		$post['gallery']         = \dash\request::post('gallery');
		$post['weight']          = \dash\request::post('weight');
		$post['weightunit']      = \dash\request::post('weightunit');
		$post['seotitle']        = \dash\request::post('seotitle');
		$post['slug']            = \dash\request::post('slug');
		$post['type']            = \dash\request::post('type');
		$post['seodesc']         = \dash\request::post('seodesc');
		$post['saleonline']      = \dash\request::post('saleonline');
		$post['saletelegram']    = \dash\request::post('saletelegram');
		$post['saleapp']         = \dash\request::post('saleapp');
		$post['publishdatetype'] = \dash\request::post('publishdatetype');
		$post['publishdate']     = \dash\request::post('publishdate');
		$post['publishtime']     = \dash\request::post('publishtime');
		$post['company']         = \dash\request::post('company');
		$post['scalecode']       = \dash\request::post('scalecode');
		$post['status']          = \dash\request::post('status');
		$post['minsale']         = \dash\request::post('minsale');
		$post['maxsale']         = \dash\request::post('maxsale');
		$post['salestep']        = \dash\request::post('salestep');
		$post['oversale']        = \dash\request::post('oversale');
		$post['company']         = \dash\request::post('company');
		$post['unit']            = \dash\request::post('unit');
		$post['category']        = \dash\request::post('cat');
		$post['tag']             = \dash\request::post('tag');

		return $post;
	}


	public static function post()
	{
		$id = \dash\request::get('id');

		if(self::delete_product($id))
		{
			return true;
		}

		if(self::upload_gallery($id))
		{
			return false;
		}

		if(\dash\request::post('fileaction') === 'remove')
		{
			self::remove_gallery($id);
			return false;
		}

		if(\dash\request::post('fileaction') === 'setthumb')
		{
			self::setthumb($id);
			return false;
		}

		self::set_variant($id);


		$post = self::get_post();

		$result = \lib\app\product\edit::edit($post, $id);


		if(!$result)
		{
			return false;
		}

		\dash\redirect::pwd();
	}

	private static function delete_product($_id)
	{
		if(\dash\request::post('delete') === 'product')
		{
			$result = \lib\app\product\remove::product($_id);
			if($result)
			{
				\dash\redirect::to(\dash\url::this());
			}
			return true;
		}
		return false;
	}


	/**
	 * Uploads a gallery.
	 * Use this function in api
	 */
	public static function upload_gallery($_id)
	{
		if(\dash\request::files('gallery'))
		{
			$upload_detail =
			[
				'debug'        => false,
				'upload_name'  => 'gallery',
				'user_id' => \dash\user::id(),
				// 'related'      => 'product',
				// 'related_id'   => $_id,
				'store_id'     => \lib\store::id(),
			];

			$uploaded_file = \dash\app\file::upload_store($upload_detail);

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\lib\app\product\gallery::gallery($_id, $uploaded_file, 'add');
			}

			if(!\dash\engine\process::status())
			{
				\dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
			}

			return true;
		}
		return false;

	}


	public static function remove_gallery($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\product\gallery::gallery($_id, $fileid, 'remove');
		\dash\redirect::pwd();
	}


	public static function setthumb($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\product\gallery::setthumb($_id, $fileid);
		\dash\redirect::pwd();
	}


	private static function getPostVariant()
	{
		$args =
		[
			'optionname1'  => \dash\request::post('optionname1'),
			'optionname2'  => \dash\request::post('optionname2'),
			'optionname3'  => \dash\request::post('optionname3'),
			'optionvalue1' => \dash\request::post('optionvalue1'),
			'optionvalue2' => \dash\request::post('optionvalue2'),
			'optionvalue3' => \dash\request::post('optionvalue3'),
		];

		return $args;
	}

	private static function get_variant()
	{
		$post = \dash\request::post();

		$variant  = [];

		$avalible = [];
		$option1  = [];
		$option2  = [];
		$option3  = [];
		$stock    = [];
		$price    = [];
		$barcode  = [];

		foreach ($post as $key => $value)
		{
			if(substr($key, 0, 9) === 'avalible_' && is_numeric(substr($key, 9)))
			{
				$avalible[substr($key, 9)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option1_' && is_numeric(substr($key, 8)))
			{
				$option1[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option2_' && is_numeric(substr($key, 8)))
			{
				$option2[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 8) === 'option3_' && is_numeric(substr($key, 8)))
			{
				$option3[substr($key, 8)] = $value;
			}
			elseif(substr($key, 0, 6) === 'stock_' && is_numeric(substr($key, 6)))
			{
				$stock[substr($key, 6)] = $value;
			}
			elseif(substr($key, 0, 4) === 'sku_' && is_numeric(substr($key, 4)))
			{
				$sku[substr($key, 4)] = $value;
			}
			elseif(substr($key, 0, 6) === 'price_' && is_numeric(substr($key, 6)))
			{
				$price[substr($key, 6)] = $value;
			}
			elseif(substr($key, 0, 8) === 'barcode_' && is_numeric(substr($key, 8)))
			{
				$barcode[substr($key, 8)] = $value;
			}

		}

		$final_list = [];

		foreach ($avalible as $key => $value)
		{
			if(isset($stock[$key]) && $stock[$key])
			{
				$final_list[] =
				[
					'option1' => array_key_exists($key, $option1) ? $option1[$key] : null,
					'option2' => array_key_exists($key, $option2) ? $option2[$key] : null,
					'option3' => array_key_exists($key, $option3) ? $option3[$key] : null,
					'stock'   => array_key_exists($key, $stock) ? $stock[$key] : null,
					'price'   => array_key_exists($key, $price) ? $price[$key] : null,
					'barcode' => array_key_exists($key, $barcode) ? $barcode[$key] : null,
					'sku'     => array_key_exists($key, $sku) ? $sku[$key] : null,
				];
			}
		}

		return $final_list;

	}


	private static function set_variant($_id)
	{

		if(\dash\request::post('saveproductvariants'))
		{
			$variant = self::get_variant();

			if(!$variant)
			{
				\dash\notif::error(T_("Please set stock and price of product"));
				return false;
			}

			\lib\app\product\variants::set_product($variant, $_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('makevariants'))
		{
			$request         = self::getPostVariant();

			\lib\app\product\variants::set($request, $_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
	}
}
?>