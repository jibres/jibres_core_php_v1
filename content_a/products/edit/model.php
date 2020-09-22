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

		if(array_key_exists('desc', $_POST))
		{
			$post['desc']      = isset($_POST['desc']) ? $_POST['desc'] : null;
		}

		$post['cat']       = \dash\request::post('cat');
		$post['tag']       = \dash\request::post('tag');
		$post['buyprice']  = \dash\request::post('buyprice');
		$post['price']     = \dash\request::post('price');
		$post['discount']  = \dash\request::post('discount');
		$post['vat']       = \dash\request::post('vat');
		$post['barcode']   = \dash\request::post('barcode');
		$post['barcode2']  = \dash\request::post('barcode2');

		$post['slug']      = \dash\request::post('slug');
		$post['seodesc']   = \dash\request::post('seodesc');
		$post['scalecode'] = \dash\request::post('scalecode');


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


		if(\dash\request::post('wholeeditequalprice'))
		{
			self::whole_edit_price($id);
		}


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