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

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(isset($result['id']))
		{
			self::upload_gallery($result['id']);
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}
	}


	public static function get_post()
	{
		$post                      = [];

		$post['title']     = \dash\request::post('title');
		$post['title2']    = \dash\request::post('title2');

		if(\dash\request::key_exists('html', 'POST'))
		{
			$post['desc']      = \dash\request::post_html();
		}

		$post['category']           = \dash\request::post('category');
		$post['buyprice']      = \dash\request::post('buyprice');
		$post['price']         = \dash\request::post('price');
		$post['discount']      = \dash\request::post('discount');
		$post['vat']           = \dash\request::post('vat');
		$post['barcode']       = \dash\request::post('barcode');
		$post['barcode2']      = \dash\request::post('barcode2');
		$post['status']        = \dash\request::post('status');

		$post['slug']          = \dash\request::post('slug');
		$post['seodesc']       = \dash\request::post('seodesc');
		$post['scalecode']     = \dash\request::post('scalecode');

		$post['trackquantity'] = \dash\request::post('trackquantity');
		$post['oversale']      = \dash\request::post('oversale');
		$post['stock']         = \dash\request::post('stock');
		$post['saleonline']    = \dash\request::post('saleonline');
		$post['minstock']      = \dash\request::post('minstock');
		$post['maxstock']      = \dash\request::post('maxstock');


		return $post;
	}


	public static function post()
	{
		$id = \dash\request::get('id');

		if(self::upload_suggestion_image($id))
		{
			return true;
		}

		if(self::upload_editor($id))
		{
			return true;
		}

		if(self::delete_product($id))
		{
			return true;
		}

		if(self::archive_product($id))
		{
			return true;
		}

		if(self::upload_gallery($id))
		{
			return false;
		}


		if(self::save_barcode_setting())
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

		if(self::update_suggestion())
		{
			return false;
		}

		$result = null;


		if(\dash\request::post('wholeeditequalprice'))
		{
			self::whole_edit_price($id);
		}


		// if(\dash\request::post('submitall') === 'master')
		{

			$post = self::get_post();
			$result = \lib\app\product\edit::edit($post, $id);
		}

		// \dash\notif::ok_once(T_("Product successfully edited"));

		if(!$result)
		{
			return false;
		}


		// product no changed not redirect
		if(\dash\temp::get('productNoChangeNotRedirect'))
		{
			\dash\redirect::to(\lib\app\back_btn\link::products());
		}

		// \dash\redirect::pwd();

	}


	private static function save_barcode_setting()
	{
		if(\dash\request::post('set_barcodesetting') === 'save')
		{
			$post =
			[
				'barcode' =>  \lib\store::detail('barcode') ? 0 : 1, // toggle barcode
				'scale'   => 1, // \dash\request::post('scale')
			];

			$condition =
			[
				'barcode' => 'bit',
				'scale'   => 'bit',
			];

			$require = [];

			$meta =	[];

			$data = \dash\cleanse::input($post, $condition, $require, $meta);

			foreach ($data as $key => $value)
			{
				\lib\app\setting\tools::update('store_setting', $key, $value);
			}

			\dash\notif::clean();
			\dash\notif::complete();
			\lib\store::refresh();

			return true;
		}

		return false;
	}

	private static function update_suggestion()
	{
		$all_post  = \dash\request::post();

		if(array_key_exists('runaction_product_suggestion', $all_post))
		{
			$post['product_suggestion'] = \dash\request::post('product_suggestion');

			\lib\app\setting\set::product_setting($post);
			\dash\notif::clean();
			return true;
		}

		return false;

	}


	private static function upload_suggestion_image($_id)
	{
		if(\dash\request::post('poof'))
		{
			$url = \dash\request::post('url');
			if($url)
			{
				\lib\app\product\gallery::upload_from_url($_id, $url);
				if(\dash\engine\process::status())
				{
					\dash\redirect::pwd();
				}
			}
		}
		return false;
	}


	private static function whole_edit_price($_id)
	{
		$child = \dash\data::productDataRow_child();
		if(!is_array($child))
		{
			$child = [];
		}

		$whole_edit = [];

		foreach ($child as $key => $value)
		{
			if(isset($value['id']))
			{
				$whole_edit[$value['id']] =
				[
					'price'    => \dash\request::post('price'),
					'discount' => \dash\request::post('discount'),
					'buyprice' => \dash\request::post('buyprice'),
				];
			}
		}

		if(!empty($whole_edit))
		{
			\lib\app\product\edit::whole_edit($whole_edit, $_id);
			\dash\notif::clean();
		}
	}


	private static function archive_product($_id)
	{
		if(\dash\request::post('archive') === 'product')
		{
			$result = \lib\app\product\edit::edit(['status' => 'archive'], $_id);
			if($result)
			{
				\dash\redirect::to(\lib\app\back_btn\link::products());
			}
			return true;
		}

		return false;
	}


	private static function delete_product($_id)
	{
		if(\dash\request::post('delete') === 'product')
		{
			$result = \lib\app\product\remove::product($_id);
			if($result)
			{
				\dash\redirect::to(\lib\app\back_btn\link::products());
			}
			return true;
		}


		if(\dash\request::post('remove') === 'remove')
		{
			$result = \lib\app\product\remove::product(\dash\request::post('id'));
			if($result)
			{
				\dash\redirect::pwd();
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
				$result['fileName'] = $uploaded_file['filename'];
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
				if(\dash\url::child() === 'add')
				{
					// nothing
				}
				else
				{
					\dash\notif::ok(T_("File successfully uploaded"));
	 				\dash\redirect::pwd();
				}
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
		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Product thumb set"));
		}

	}


}
?>