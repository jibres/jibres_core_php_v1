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
		$post                   = [];
		$post['title']          = \dash\request::post('title');
		$post['title2']          = \dash\request::post('title2');
		$post['desc']           = isset($_POST['desc']) ? $_POST['desc'] : null;
		$post['buyprice']       = \dash\request::post('buyprice');
		$post['price']          = \dash\request::post('price');
		// $post['compareatprice'] = \dash\request::post('CompareAtPrice');
		$post['discount']       = \dash\request::post('discount');
		$post['vat']            = \dash\request::post('vat');
		$post['sku']            = \dash\request::post('sku');
		// $post['code']           = \dash\request::post('code');
		$post['barcode']        = \dash\request::post('barcode');
		$post['barcode2']       = \dash\request::post('barcode2');
		$post['infinite']       = \dash\request::post('infinite');
		// $post['gallery']        = \dash\request::post('gallery');
		$post['weight']         = \dash\request::post('weight');
		$post['seotitle']       = \dash\request::post('seotitle');
		$post['slug']           = \dash\request::post('slug');
		$post['type']           = \dash\request::post('type');
		$post['seodesc']        = \dash\request::post('seodesc');
		$post['company']        = \dash\request::post('company');
		$post['scalecode']      = \dash\request::post('scalecode');
		$post['status']         = \dash\request::post('status');
		$post['minstock']       = \dash\request::post('minstock');
		$post['maxstock']       = \dash\request::post('maxstock');
		$post['minsale']        = \dash\request::post('minsale');
		$post['maxsale']        = \dash\request::post('maxsale');
		$post['salestep']       = \dash\request::post('salestep');
		$post['oversale']       = \dash\request::post('oversale');
		$post['company']        = \dash\request::post('company');
		$post['unit']           = \dash\request::post('unit');
		// $post['category']    = \dash\request::post('cat');
		$post['cat_id']         = \dash\request::post('cat_id');
		$post['tag']            = \dash\request::post('tag');


		$post['length']         = \dash\request::post('length');
		$post['width']          = \dash\request::post('width');
		$post['height']         = \dash\request::post('height');
		$post['filesize']       = \dash\request::post('filesize');
		$post['fileaddress']    = \dash\request::post('fileaddress');

		return $post;
	}


	public static function post()
	{
		$id = \dash\request::get('id');

		if(self::upload_editor($id))
		{
			return true;
		}

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

		$result = null;

		if(\dash\request::post('submitall') === 'master')
		{
			$post = self::get_post();
			$result = \lib\app\product\edit::edit($post, $id);
		}


		if(!$result)
		{
			return false;
		}

		// product no changed not redirect
		if(\dash\temp::get('productNoChangeNotRedirect'))
		{
			\dash\redirect::to(\lib\backlink::products());
		}

		// \dash\redirect::pwd();

	}

	private static function delete_product($_id)
	{
		if(\dash\request::post('delete') === 'product')
		{
			$result = \lib\app\product\remove::product($_id);
			if($result)
			{
				\dash\redirect::to(\lib\backlink::products());
			}
			return true;
		}
		return false;
	}


	private static function upload_editor($_id)
	{
		if(\dash\request::files('upload'))
		{
			$uploaded_file = \dash\upload\product::set_product_gallery_editor($_id);

			$result             = [];

			if(isset($uploaded_file['filename']) && isset($uploaded_file['path']))
			{
				$result['fineName'] = $uploaded_file['filename'];
				$result['url']      = \lib\filepath::fix($uploaded_file['path']);
				$result['uploaded'] = 1;

			}

			if(!\dash\engine\process::status())
			{
				// $result['uploaded'] = 0;
			}

			\dash\code::jsonBoom($result);

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
			$uploaded_file = \dash\upload\product::set_product_gallery($_id);

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\lib\app\product\gallery::gallery($_id, $uploaded_file, 'add');
			}

			if(!\dash\engine\process::status())
			{
				// \dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
 				// \dash\redirect::pwd();
			}

			return true;
		}
		return false;

	}


	public static function remove_gallery($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\product\gallery::gallery($_id, $fileid, 'remove');
		\dash\notif::ok(T_("File removed"));
		// \dash\redirect::pwd();
	}


	public static function setthumb($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\product\gallery::setthumb($_id, $fileid);
		\dash\notif::ok(T_("Product thumb set"));
	//	\dash\redirect::pwd();
	}


}
?>