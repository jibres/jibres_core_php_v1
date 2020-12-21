<?php
namespace content_a\website\news;

class model
{
	public static function post()
	{


		$post            = [];
		$post['publish'] = 1;


		if(\dash\request::post('set_limit'))
		{
			$post['limit'] = \dash\request::post('limit');
		}



		if(\dash\request::post('set_puzzle'))
		{
			$post['puzzle'] = \dash\request::post('puzzle');
		}

		if(\dash\request::post('set_template'))
		{
			$post['template'] = \dash\request::post('template');
		}

		if(\dash\request::post('set_title'))
		{
			$post['title']             = \dash\request::post('title');
			$post['more_link']         = \dash\request::post('more_lik');
			$post['more_link_caption'] = \dash\request::post('more_link_cption');
		}


		if(\dash\request::post('set_filter'))
		{
			$post['cat_id']  = \dash\request::post('cat_id');
			$post['tag_id']  = \dash\request::post('tag_id');
			$post['subtype'] = \dash\request::post('subtype');
		}

		// 	'play_item'         => \dash\request::post('play_item'),


		if(!\dash\data::newsID())
		{
			$news = \lib\app\website\body\line\news::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($news['id']))
				{
					\dash\redirect::to(\dash\url::current(). '?id='. $news['id']);
				}
				else
				{
					// @BUG!
					\dash\redirect::to(\dash\url::this());
				}
			}

			return;
		}
		else
		{
			if(\dash\request::post('remove') === 'line')
			{
				\lib\app\website\body\remove::line(\dash\request::get('id'));
				\dash\redirect::to(\dash\url::this(). '/body');
				return;
			}
			else
			{
				\lib\app\website\body\line\news::edit($post, \dash\data::newsID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::current(). '?id='. \dash\data::newsID());
			}
		}
	}

}
?>
