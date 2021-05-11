<?php
namespace dash\engine;

class template
{

	public static $display_addr    = null;
	public static $display_name    = null;
	public static $finded_template = null;
	public static $dataRow         = null;


	public static function find()
	{
		// find support link if exist
		if(self::support_link())
		{
			// redirect
			return true;
		}

		// finded the social short link
		if(self::social_short_link())
		{
			// redirect
			return true;
		}

		// not route any post or tag in jibres
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		$data         = null;
		$type         = null;
		$display_addr = null;


		if($data = self::find_tag(true))
		{
			$type         = 'tag';
			$display_addr = core . 'layout/tools/display-tag-view.php';
		}
		elseif($data = \dash\app\posts\find::post())
		{
			$type         = 'posts';
			// $display_addr = core . 'layout/post/layout-v1.php';

			$display_addr = core . 'layout/post/layout-v2.php';
		}
		elseif ($data = self::find_tag())
		{
			if(isset($data['url']))
			{
				// redirect /abc if exist in tags to /tag/abc
				$new_url = \dash\url::kingdom().'/hashtag/'.$data['url'];
				\dash\redirect::to($new_url);
			}
			return;
		}

		if($type)
		{
			self::$dataRow         = $data;
			self::$finded_template = true;
			self::$display_addr    = $display_addr;
			self::$display_name    = str_replace(root, '', $display_addr);
			return true;
		}
		else
		{
			return false;
		}
	}




	public static function support_link()
	{
		$mymodule = \dash\url::module();
		if(substr($mymodule, 0, 1) === '!')
		{
			$supportCode = substr($mymodule, 1);

			if($supportCode = \dash\validate::id($supportCode, false))
			{
				if(\dash\engine\store::inStore())
				{
					// create url of support
					$support_link = \dash\url::kingdom(). '/ticket/view?id='.$supportCode;
				}
				else
				{
					// create url of support
					$support_link = \dash\url::kingdom(). '/support/ticket/view?id='.$supportCode;
				}
				// redirect to new address
				\dash\redirect::to($support_link);
				return true;
			}
		}

		return false;
	}


	public static function social_short_link()
	{
		// save name of current module as name of social
		$mymodule    = \dash\url::module();
		$social_name = $mymodule;

		// declare list of shortkey for socials
		$social_list =
		[
			'@'        => 'twitter',
			'~'        => 'github',
			'+'        => 'googleplus',
			// 'f'        => 'facebook',
			'fb'       => 'facebook',
			'in'       => 'linkedin',
			'tg'       => 'telegram',
		];

		// if name of current module is exist then save complete name of it
		if(isset($social_list[$mymodule]))
		{
			$social_name = $social_list[$mymodule];
		}

		// declare address of social networks
		$social_list =
		[
			'twitter'    => 'https://twitter.com/ermile_jibres',
			'github'     => 'https://github.com/jibres',
			'facebook'   => 'https://www.facebook.com/jibres',
			'linkedin'   => 'https://linkedin.com/in/jibres',
			'telegram'   => 'http://telegram.me/jibres',
			// 'aparat'     => 'http://www.aparat.com/',
		];

		// if social name exist in social adresses then redirect to it
		if(isset($social_list[$social_name]))
		{
			// create url of social network
			$social_url = $social_list[$social_name];
			// redirect to new address
			\dash\redirect::to($social_url);
			return true;
		}

		return false;
	}



	public static function find_tag($_by_tag_url = false)
	{
		$myUrl = \dash\url::directory();
		$myUrl = \dash\url::urlfilterer($myUrl);

		if(substr($myUrl, 0, 5) === 'hashtag/')
		{
			$myUrl = substr($myUrl, 8);
		}
		else
		{
			// need to check url only by tag/ in url
			if($_by_tag_url)
			{
				return false;
			}
		}

		$get_tag =
		[
			'url'      => $myUrl,
			'limit'    => 1,
		];

		if(!\dash\engine\store::inStore())
		{
			$get_tag['language'] = \dash\language::current();
		}

		$cat_data = \dash\db\terms\get::get_raw($get_tag);

		if($cat_data)
		{
			$cat_data = \dash\app\terms\ready::row($cat_data);
			return $cat_data;
		}

		return false;
	}

}
?>