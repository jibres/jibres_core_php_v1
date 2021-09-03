<?php
namespace content_a\website\menu\item;


class model
{
	public static function post()
	{
		if(\dash\data::editMode())
		{
			$current_id = \dash\request::get('edit');
		}
		elseif(\dash\data::addChildMode())
		{
			$current_id = \dash\request::get('parent');
		}
		else
		{
			$current_id = \dash\request::get('id');
		}

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\menu\remove::remove($current_id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/roster?'. \dash\request::build_query(['id' => \dash\request::get('id')]));
			}

			return false;
		}


		$post =
		[
			'title'         => \dash\request::post('title'),
			'url'           => \dash\request::post('url'),
			'pointer'       => \dash\request::post('pointer'),
			'target'        => \dash\request::post('target') ? 'blank' : null,
			'product_id'    => \dash\request::post('product_id'),
			'post_id'       => \dash\request::post('post_id'),
			'tag_id'        => \dash\request::post('tag_id'),
			'socialnetwork' => \dash\request::post('socialnetwork'),
			'hashtag_id'    => \dash\request::post('hashtag_id'),
			'form_id'       => \dash\request::post('form_id'),
		];


		if(\dash\data::editMode())
		{
			$theme_detail = \lib\app\menu\edit::edit($post, $current_id);
		}
		else
		{
			$theme_detail = \lib\app\menu\add::menu_item($post, $current_id);
		}



		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '/roster?'. \dash\request::build_query(['id' => \dash\request::get('id')]));
		}
	}

}
?>