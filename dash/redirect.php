<?php
namespace dash;

class redirect
{
	/**
	 * try to redirect to new location
	 * @param  [type]  $_url address
	 * @param  boolean $_php use php
	 * @param  [type]  $_arg special argument like txt in html or type in php
	 * @return [type]        [description]
	 */
	public static function to($_url, $_php = true, $_arg = null)
	{
		$statusCode = 307;
		// set header for redirect via php
		if(is_numeric($_arg))
		{
			$statusCode = $_arg;
		}
		\dash\header::set($statusCode);

		if(\dash\request::json_accept() || \dash\request::ajax())
		{
			self::via_pushstate($_url, $_php);
		}

		if($_php === true)
		{
			self::via_php($_url, $_arg);
		}
		else
		{
			self::via_html($_url, $_arg);
		}

		\dash\code::bye();
	}

	/**
	 * redirect to current location
	 */
	public static function pwd($_scroll = true)
	{
		if($_scroll === 'top')
		{
			\dash\notif::replaceState('top');
		}
		else
		{
			\dash\notif::replaceState(true);
		}
		self::to(\dash\url::pwd());
	}


	/**
	 * via pushstate
	 * @param  [type] $_loc [description]
	 * @return [type]       [description]
	 */
	private static function via_pushstate($_loc, $_type)
	{
		if($_type === 'direct')
		{
			\dash\notif::direct();
		}
		\dash\notif::redirect($_loc);
		\dash\code::end();

		// remove below code if have no problem
		// header('Content-Type: application/json');
		// echo \dash\notif::json();
		// \dash\code::bye();
	}


	/**
	 * with php
	 * @param  [type]  $_loc  [description]
	 * @param  integer $_type [description]
	 * @return [type]         [description]
	 */
	private static function via_php($_loc, $_type = 307)
	{
		if (!headers_sent())
		{
			header('Pragma: no-cache');
			header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			header("Expires: Fri, 08 Sep 2017 06:12:00 GMT");
			header('Location: '. $_loc);
		}
	}


	/**
	 * with html and design
	 * @param  [type] $_loc [description]
	 * @return [type]       [description]
	 */
	private static function via_html($_loc, $_txt = null)
	{
		require_once(core."redirect_html.php");
	}


	public static function remove_subdomain()
	{
		// need to check some option subdomain
		if(\dash\url::subdomain())
		{
			// remove subdomain
			\dash\redirect::to(\dash\url::site(). \dash\url::path());
		}
	}


	public static function remove_store()
	{
		// need to check some option store
		if(\dash\url::store())
		{
			// remove store
			$path = str_replace('/'. \dash\url::store(). '/', '/', \dash\url::path());

			\dash\redirect::to(\dash\url::site(). $path);
		}
	}


	public static function to_login($_php = null)
	{
		if(!\dash\user::login())
		{
			if($_php)
			{
				\dash\redirect::to(\dash\url::kingdom(). '/enter?referer='. \dash\url::pwd(), true, 302);
			}
			else
			{
				\dash\redirect::to(\dash\url::kingdom(). '/enter?referer='. \dash\url::pwd(), false);
			}
		}
		\dash\data::pageWithLogin(true);
	}
}
?>