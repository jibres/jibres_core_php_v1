<?php
namespace content_cms\posts\edit;

class model
{
	public static function post()
	{

		$id = \dash\request::get('id');

		if(self::upload_editor())
		{
			return false;
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


		$post =
		[

			'subtitle'    => \dash\request::post('subtitle'),
			'title'       => \dash\request::post('title'),
			'content'     => \dash\request::post_raw('content'),
			'parent'      => \dash\request::post('parent') ? \dash\request::post('parent') : null,
			'tag'         => \dash\request::post('tag'),
			'cat'         => \dash\request::post('cat'),

		];

		if(!$post || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function remove_gallery($_id)
	{
		$fileid = \dash\request::post('fileid');
		\dash\app\posts\gallery::gallery($_id, $fileid, 'remove');
		\dash\notif::ok(T_("File removed"));
		// \dash\redirect::pwd();
	}


	public static function setthumb($_id)
	{
		$fileid = \dash\request::post('fileid');
		\dash\app\posts\gallery::setthumb($_id, $fileid);
		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Product thumb set"));
			\dash\redirect::pwd();
		}

	}



	/**
	 * Uploads a gallery.
	 * Use this function in api
	 */
	public static function upload_gallery($_id)
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\upload\cms::set_post_gallery(\dash\coding::decode($_id));

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\dash\app\posts\gallery::gallery($_id, $uploaded_file, 'add');
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




	public static function upload_editor()
	{
		if(\dash\request::files('upload'))
		{
			$uploaded_file = \dash\upload\cms::set_post_gallery_editor(\dash\coding::decode(\dash\request::get('id')));

			if($uploaded_file)
			{
				// save uploaded file
				\dash\app\posts\gallery::gallery(\dash\request::get('id'), $uploaded_file, 'add');
			}

			$result             = [];
			$result['fineName'] = $uploaded_file['filename'];
			$result['url']      = \lib\filepath::fix($uploaded_file['path']);
			$result['uploaded'] = 1;

			if(!\dash\engine\process::status())
			{
				// $result['uploaded'] = 0;
			}

			\dash\code::jsonBoom($result);

			return true;
		}
		return false;

	}
}
?>
