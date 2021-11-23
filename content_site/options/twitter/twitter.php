<?php
namespace content_site\options\twitter;


class twitter
{

	public static function admin_html()
	{


		$twitter_username = \lib\store::social('twitter');
		$twitter_username = a($twitter_username, 'user');


		$twitter_last_fetch = null; //\lib\app\twitter\business::last_fetch();
		\dash\data::twitterLastFetch($twitter_last_fetch);

		$twitter_posts = null; //\lib\app\twitter\business::get_my_posts();
		\dash\data::myInstagramPosts($twitter_posts);

		$html = '';
		if(!$twitter_username)
		{
			$html .= '<a target="_blank" class="btn-primary leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Connect to your twitter"). ' <i class="sf-external-link pLa5"></i> </a>';
		}
		else
		{
			if($twitter_last_fetch)
			{
				$html .= '<div class="alert2">'. T_("Last fetch"). ': '. \dash\fit::date_human($twitter_last_fetch). '</div>';
			}

			$json =
			[
				'ig_action'   => 'fetch',
			];

			$json = json_encode($json);

			$html .= '<a target="_blank" data-method="post" class="btn-primary leading-6 block" data-ajaxify=\''.$json.'\' href="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Fetch posts now"). ' <i class="sf-external-link pLa5"></i> </a>';

			$html .= '<a target="_blank" class="btn-link leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/tw">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';

		}

		return $html;
	}

}
?>