<?php
namespace content_support\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Help center"));
		\dash\face::desc(T_("Easily manage your tickets and monitor or track them to get best answer until fix your problem"));


		\dash\data::action_text(T_('Tickets'));
		\dash\data::action_link(\dash\url::here(). '/ticket'. \dash\data::accessGet());

		// load one help article
		if(\dash\data::isHelpCenter())
		{
			\dash\data::supportAdmin('article.php');
			// btn
			\dash\data::back_text(T_('Help center'));
			\dash\data::back_link(\dash\url::support());

			self::help_center();

			// if have permission show edit link
			if(\dash\permission::check('cpHelpCenterEdit'))
			{
				\dash\face::btnSetting(\dash\url::kingdom(). '/cms/posts/edit?id='. \dash\data::datarow_id());
			}

		}
		else
		{
			\dash\data::supportAdmin('dashboard.php');
			self::helpDashboard();
			// btn
			\dash\data::action_text(T_('New Ticket'));
			\dash\data::action_icon('plus');
			\dash\data::action_link(\dash\url::support(). '/ticket/add');

		}
	}

	public static function help_center()
	{
		$master = \dash\data::moduelRow();
		if(!isset($master['id']))
		{
			return;
		}
		$subchildPost = \dash\db\posts::get(['type' => 'help', 'parent' => $master['id'], 'status' => 'publish']);
		if(is_array($subchildPost))
		{
			$subchildPost = array_map(['\dash\app\posts', 'ready'], $subchildPost);
			\dash\data::subchildPost($subchildPost);
		}

		$master = \dash\app\posts::ready($master);

		\dash\data::datarow($master);

		if(isset($master['url']))
		{
			$url = $master['url'];
			if(strpos($url, '/') !== false)
			{
				$split_url = explode('/', $url);
				if(count($split_url) > 1)
				{
					array_pop($split_url);
					$url = implode('/', $split_url);
					\dash\data::back_link(\dash\url::support(). '/'. $url);
					\dash\data::back_text(T_('Back'));
					// \dash\data::back_icon('chevron-left');
				}
			}
		}

		// set page title
		if(isset($master['title']))
		{
			// \dash\face::title($master['title']);
		}
		// set page desc
		if(isset($master['excerpt']))
		{
			\dash\face::desc($master['excerpt']);
		}
		// set page desc
		if(isset($master['meta']['icon']))
		{

		}



	}



	public static function helpDashboard()
	{

		$get_posts_term =
		[
			'type'     => 'help',
			'parent'   => null,
			'language' => \dash\language::current(),
		];

		$random_post_arg =
		[
			'type'   => 'help',
			'limit'  => 5,
			'status' => 'publish',
			// 'parent' => ["IS", "NOT NULL"]
		];

		$random_faq_args = ['type' => 'help', 'limit' => 5, 'tag' => 'faq', 'random' => true];


		if(\dash\permission::check('cpHelpCenterEditForOthers'))
		{
			// $get_posts_term['status']   = ["NOT IN", "('deleted')"];
		}
		else
		{
			// $get_posts_term['status']   = 'publish';
		}

		$search = \dash\request::get('q');
		$search = \dash\validate::search($search, false);
		\dash\data::queryString($search);
		if($search)
		{

			$get_search = $get_posts_term;
			unset($get_search['parent']);
			$dataTable = \dash\app\posts::list($search, $get_search);
			\dash\data::dataTable($dataTable);
		}

		$pageList = \dash\db\posts::get($get_posts_term);
		$pageList = array_map(['\dash\app\posts', 'ready'], $pageList);

		\dash\data::listCats($pageList);

		$randomArticles = \dash\app\posts::random_post($random_post_arg);

		\dash\data::randomArticles($randomArticles);

		$randomFAQ = \dash\db\posts::get_posts_term($random_faq_args, 'help_tag');
		\dash\data::randomFAQ($randomFAQ);

	}
}
?>