<?php
namespace content_a\website\news;

class model
{
	public static function post()
	{


		$post            = [];
		$post['publish'] = 1;
		$post['type']    = 'news';


		if(\dash\request::post('set_limit'))
		{
			$post['limit'] = \dash\request::post('limit');
		}



		if(\dash\request::post('set_puzzle'))
		{
			$post['puzzle'] = \dash\request::post('puzzle');
		}


		if(\dash\request::post('set_avand'))
		{
			$post['avand'] = \dash\request::post('avand');
		}

		if(\dash\request::post('set_radius'))
		{
			$post['radius'] = \dash\request::post('radius');
		}

		if(\dash\request::post('set_padding'))
		{
			$post['padding'] = \dash\request::post('padding');
		}


		if(\dash\request::post('set_title'))
		{
			$post['title']             = \dash\request::post('title');
			$post['more_link']         = \dash\request::post('more_link');
			$post['more_link_caption'] = \dash\request::post('more_link_caption');
			$post['show_title'] = \dash\request::post('show_title');
		}


		if(\dash\request::post('set_filter'))
		{
			$post['tag_id']    = \dash\request::post('tag_id') ? \dash\request::post('tag_id') : null;
			$post['subtype']   = \dash\request::post('subtype');
			$post['play_item'] = \dash\request::post('play_item');
		}

		if(\dash\request::post('set_design'))
		{
			$post['design'] = \dash\request::post('design');
		}


		if(!\dash\data::dataBlockID())
		{
			$news = \lib\app\website\body\line\datablock::add($post);

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
				\lib\app\website\body\line\datablock::edit($post, \dash\data::dataBlockID());
			}


			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::current(). '?id='. \dash\data::dataBlockID());
			}
		}
	}

}
?>
