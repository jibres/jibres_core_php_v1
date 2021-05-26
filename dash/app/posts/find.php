<?php
namespace dash\app\posts;


class find
{
	public static $dataRow = [];


	public static function post()
	{
		$url = \dash\url::directory();
		$url = \dash\url::urlfilterer($url);


		if(substr($url, 0, 7) == 'static/' || substr($url, 0, 6) == 'files/' || substr($url, 0, 7) == 'static_' || substr($url, 0, 6) == 'files_')
		{
			return false;
		}

		if(file_exists(\dash\engine\content::get_addr(). "template/static/$url.html"))
		{
			return false;
		}

		$load_in_n_module = \dash\engine\content::is('business') && \dash\url::module() === 'n' && \dash\url::child() && !\dash\url::subchild();


		if($load_in_n_module)
		{
			$dataRow = self::load_by_id();
		}
		else
		{
			$dataRow = self::load_by_url($url);
		}

		// post not founded
		if(!$dataRow || !is_array($dataRow) || !isset($dataRow['id']))
		{
			return false;
		}

		$preview  = \dash\request::get('preview') ? true : false;

		// 404 on post not published
		if(!$preview && isset($dataRow['status']) && $dataRow['status'] !== 'publish')
		{
			\dash\header::status(404, T_("This post is not published"));
		}

		if(isset($dataRow['redirecturl']) && $dataRow['redirecturl'])
		{
			if(!$preview)
			{
				if(isset($dataRow['link']) && $dataRow['link'] == $dataRow['redirecturl'])
				{
					// nothing. User try to make too many redirect error!
					// redirect the post to self!
				}
				else
				{
					$match = "/\/n\/$dataRow[id](|\/|\?)/";

					if(preg_match($match, $dataRow['redirecturl']))
					{
						// not redirect. user set the redirect url the base of post url /n/Q
					}
					else
					{
						\dash\redirect::to($dataRow['redirecturl'], true, 302);
					}
				}
			}
		}

		if(isset($dataRow['status']) && $dataRow['status'] === 'deleted')
		{
			return false;
		}

		if($load_in_n_module && isset($dataRow['url']) && $dataRow['url'] && isset($dataRow['link']))
		{
			if($preview)
			{
				$dataRow['link'] = $dataRow['link']. '?preview=yes';
			}

			\dash\redirect::to($dataRow['link'], true, 302);
		}

		$id                  = \dash\coding::decode($dataRow['id']);

		$tag                 = \dash\app\posts\get::get_post_tag($id);

		$dataRow['tags']     = $tag;

		$dataRow = \dash\app\posts\ready::show($dataRow);

		self::$dataRow = $dataRow;

		if(!\dash\data::dataRow())
		{
			\dash\data::dataRow($dataRow);
		}

		\dash\engine\view::set_cms_titles();

		if(isset($dataRow['type']) && $dataRow['type'] === 'pagebuilder')
		{
			// not need to load comment
		}
		else
		{

			$customer_review = \dash\app\comment\get::post_customer_review($dataRow['id']);
			\dash\data::customerReview($customer_review);

			$commentList = \dash\app\comment\search::by_post($dataRow['id']);
			\dash\data::commentList($commentList);
		}


		return $dataRow;
	}


	private static function load_by_url($url)
	{

		$url = str_replace("'", '', $url);
		$url = str_replace('"', '', $url);
		$url = str_replace('`', '', $url);
		$url = str_replace('%', '', $url);

		if(\dash\engine\store::inStore())
		{
			// not check language
			$language = null;
		}
		else
		{
			$language = \dash\language::current();
		}

		$get_post =
		[
			'url'      => $url,
		];

		if($language)
		{
			$get_post['language'] = $language;
		}

		$dataRow = \dash\db\posts\get::get_one($get_post);
		$dataRow = \dash\app\posts\ready::row($dataRow);

		return $dataRow;
	}


	private static function load_by_id()
	{
		$load_post = \dash\app\posts\get::get(\dash\url::child());
		if(!$load_post)
		{
			return false;
		}

		return $load_post;
	}
}
?>