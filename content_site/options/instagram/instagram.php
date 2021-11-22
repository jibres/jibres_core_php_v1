<?php
namespace content_site\options\instagram;


class instagram
{

	public static function admin_html()
	{


		$instagram_access_token = \lib\app\instagram\business::access_token();
		\dash\data::instagramAccessToken($instagram_access_token);

		$instagram_last_fetch = \lib\app\instagram\business::last_fetch();
		\dash\data::instagramLastFetch($instagram_last_fetch);

		$instagram_posts = \lib\app\instagram\business::get_my_posts();
		\dash\data::myInstagramPosts($instagram_posts);

		$html = '';
		if(!$instagram_access_token)
		{
			$html .= '<a target="_blank" class="btn-primary  leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/instagram">'. T_("Connect to your instagram"). ' <i class="sf-external-link pLa5"></i> </a>';
		}
		else
		{
			if($instagram_last_fetch)
			{
				$html .= '<div class="alert2">'. T_("Last fetch"). ': '. \dash\fit::date_human($instagram_last_fetch). '</div>';
			}

			$html .= '<a target="_blank" class="btn-primary  leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/instagram">'. T_("Fetch posts now"). ' <i class="sf-external-link pLa5"></i> </a>';


		}

		return $html;
	}

}
?>