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




		$posts = self::getPost();

		if(!$posts || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($posts, \dash\request::get('id'));

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
				\dash\app\posts::post_gallery(\dash\request::get('id'), $uploaded_file, 'add');
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



	public static function getPost()
	{


		$post =
		[

			'subtitle'    => \dash\request::post('subtitle'),
			'excerpt'     => \dash\request::post('excerpt'),
			'title'       => \dash\request::post('title'),
			'tag'         => \dash\request::post('tag'),
			'slug'        => \dash\request::post('slug'),
			'content'     => \dash\request::post_raw('content'),
			'publishdate' => \dash\request::post('publishdate'),
			'publishtime' => \dash\request::post('publishtime'),
			'status'      => \dash\request::post('status'),
			'comment'     => \dash\request::post('comment'),
			'language'    => \dash\request::post('language') ? \dash\request::post('language') : \dash\language::current(),
			'parent'      => \dash\request::post('parent'),
			'special'     => \dash\request::post('special'),
			'creator'     => \dash\request::post('creator'),
			'seotitle'    => \dash\request::post('seotitle'),
			'subtype'     => \dash\request::post('subtype'),
			'btntitle'    => \dash\request::post('btntitle'),
			'btnurl'      => \dash\request::post_raw('btnurl'),
			'btntarget'   => \dash\request::post('btntarget'),
			'btncolor'    => \dash\request::post('btncolor'),
			'srctitle'    => \dash\request::post('srctitle'),
			'srcurl'      => \dash\request::post_raw('srcurl'),
			'redirecturl' => \dash\request::post_raw('redirecturl'),
			'cat'         => \dash\request::post_raw('cat'),

		];


		if(!$post['status'])
		{
			$post['status'] = 'draft';
		}

		if(\dash\request::post('publishBtn') === 'publish')
		{
			$post['status'] = 'publish';
		}

		// if(!\dash\permission::check('cpPostsEditStatus'))
		// {
		// 	unset($post['status']);
		// }

		if(\dash\request::get('type'))
		{
			$post['type'] = \dash\request::get('type');
		}

		if(\dash\request::post('icon'))
		{
			$post['icon'] = \dash\request::post('icon');
		}


		$uploaded_file = \dash\upload\cms::set_post_thumb(\dash\coding::decode(\dash\request::get('id')));

		if($uploaded_file)
		{
			$post['thumb'] = $uploaded_file;
		}

		return $post;

	}
}
?>
