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

		$galleryMode = 'add';
		if(in_array(\dash\data::dataRow_subtype(), ['audio', 'video']))
		{
			$galleryMode = 'update';
		}

		if(self::upload_gallery($id, $galleryMode))
		{
			return false;
		}


		if(\dash\request::post('fileaction') === 'remove')
		{
			self::remove_gallery($id);
			return false;
		}

		$post = [];




		if(\dash\request::post('remove_cover') === 'remove_cover')
		{
			$post['cover'] = null;
		}
		elseif(\dash\request::post('runaction_setcover'))
		{
			$file_cover = \dash\upload\cms::set_post_cover(\dash\coding::decode(\dash\request::get('id')));
			if(!$file_cover)
			{
				\dash\notif::error(T_("Please upload a photo"));
				return false;
			}
			$post['cover'] = $file_cover;
		}
		elseif(\dash\request::post('runaction_setthumb'))
		{
			$file_thumb = \dash\upload\cms::set_post_thumb(\dash\coding::decode(\dash\request::get('id')));
			if(!$file_thumb)
			{
				\dash\notif::error(T_("Please upload a photo"));
				return false;
			}
			$post['thumb'] = $file_thumb;
		}
		elseif(\dash\request::post('remove_thumb') === 'remove_thumb')
		{
			$post['thumb'] = null;
		}
		else
		{
			$post =
			[
				'subtitle'    => \dash\request::post('subtitle'),
				'title'       => \dash\request::post('title'),
				'content'     => \dash\request::post_raw('content'),
				'tag'         => \dash\request::post('tag'),
			];

		}


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



	/**
	 * Uploads a gallery.
	 * Use this function in api
	 */
	public static function upload_gallery($_id, $_mode = 'add')
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\upload\cms::set_post_gallery(\dash\coding::decode($_id));

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\dash\app\posts\gallery::gallery($_id, $uploaded_file, $_mode);
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

			$result             = [];
			if(isset($uploaded_file['filename']) && isset($uploaded_file['path']))
			{
				$result['fineName'] = $uploaded_file['filename'];
				$result['url']      = \lib\filepath::fix($uploaded_file['path']);
				$result['uploaded'] = 1;
			}
			else
			{
				$result['uploaded'] = 0;
			}

			\dash\code::jsonBoom($result);

			return true;
		}
		return false;

	}
}
?>
