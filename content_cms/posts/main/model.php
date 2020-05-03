<?php
namespace content_cms\posts\main;


class model
{
	public static function upload_gallery()
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\upload\cms::set_post_gallery(\dash\coding::decode(\dash\request::get('id')));

			if($uploaded_file)
			{
				// save uploaded file
				\dash\app\posts::post_gallery(\dash\request::get('id'), $uploaded_file, 'add');
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

	public static function remove_gallery()
	{
		$fileid = \dash\request::post('fileid');
		if(!$fileid || !is_numeric($fileid))
		{
			return false;
		}

		\dash\app\posts::post_gallery(\dash\request::get('id'), $fileid, 'remove');

		\dash\upload\cms::remove_post_gallery(\dash\coding::decode(\dash\request::get('id')), $fileid);

		\dash\redirect::pwd();
	}


	private static function remove_thumb()
	{
		if(\dash\request::post('deleteThumb'))
		{
			$id = \dash\request::get('id');

			\dash\app\posts::remove_thumb(\dash\request::get('id'));

			\dash\redirect::pwd();

			return true;
		}

		return false;
	}


	public static function getPost()
	{

		if(self::upload_editor())
		{
			return false;
		}

		if(self::upload_gallery())
		{
			return false;
		}

		if(\dash\request::post('type') === 'remove_gallery')
		{
			self::remove_gallery();
			return false;
		}

		if(self::remove_thumb())
		{
			return false;
		}

		$post =
		[

			'subtitle'    => \dash\request::post('subtitle'),
			'excerpt'     => \dash\request::post('excerpt'),
			'title'       => \dash\request::post('title'),
			'tag'         => \dash\request::post('tag'),
			'slug'        => \dash\request::post('slug'),
			'content'     => isset($_POST['content']) ? $_POST['content'] : null,
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
			'btnurl'      => \dash\request::post('btnurl') ? $_POST['btnurl'] : null,
			'btntarget'   => \dash\request::post('btntarget'),
			'btncolor'    => \dash\request::post('btncolor'),
			'srctitle'    => \dash\request::post('srctitle'),
			'srcurl'      => \dash\request::post('srcurl') ? $_POST['srcurl'] : null,
			'redirecturl' => \dash\request::post('redirecturl') ? $_POST['redirecturl'] : null,

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

		$all_post = \dash\request::post();

		$post['cat'] = [];

		foreach ($all_post as $key => $value)
		{
			if(substr($key, 0, 4) === 'cat_')
			{
				$post['cat'][] = substr($key, 4);
			}
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
