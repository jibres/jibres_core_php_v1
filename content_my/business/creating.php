<?php
namespace content_my\business;


class creating
{
	private static $session_data = [];


	/**
	 * Check in controller
	 *
	 * @param      string  $_step  The step
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function access_step(string $_step)
	{
		switch ($_step)
		{
			case 'start':
				return self::start('access');
				break;

			case 'ask':
				return self::ask('access');
				break;

			case 'subdomain':
				return self::subdomain('access');
				break;

			case 'creating':
				return self::creating('access');
				break;

			default:
				\dash\header::status(400, T_("Invalid business step"));
				break;
		}
	}


	/**
	 * Check in model
	 *
	 * @param      string  $_step    The step
	 * @param      array   $_detail  The detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function cross_step(string $_step, array $_detail = [])
	{
		// in every page check system is not busy
		self::check_busy();

		switch ($_step)
		{
			case 'start':
				return self::start('cross', $_detail);
				break;

			case 'ask':
				return self::ask('cross', $_detail);
				break;

			case 'subdomain':
				return self::subdomain('cross', $_detail);
				break;

			case 'creating':
				return self::creating('cross');
				break;


			default:
				\dash\header::status(400, T_("Invalid business step"));
				break;
		}
	}


	/**
	 * Go to first page
	 */
	private static function go_to_first_page()
	{
		\dash\redirect::to(\dash\url::this(). '/start');
	}



	/**
	 * Check system is not busy
	 */
	private static function check_busy()
	{
		$get_session = self::get_session();
		if(isset($get_session['store_creating_is_runing']) && $get_session['store_creating_is_runing'])
		{
			\dash\notif::error(T_("Please wait to complete creating"));
			\dash\redirect::to(\dash\url::this());
		}
	}


	/**
	 * Gets the session.
	 *
	 * @return     <type>  The session.
	 */
	private static function get_session()
	{
		if(empty(self::$session_data))
		{
			$get_session = \dash\session::get('create_business');
			if(!is_array($get_session))
			{
				$get_session = [];
			}

			self::$session_data = $get_session;
		}

		return self::$session_data;
	}


	/**
	 * Sets the session.
	 *
	 * @param      array  $_data  The data
	 */
	private static function set_session(array $_data)
	{
		\dash\session::set('create_business', $_data);
	}

	/**
	 * Clean session
	 */
	private static function clean_session()
	{
		\dash\session::clean('create_business');
	}


	/**
	 * We are in start's step
	 *
	 * @param      string   $_type  The type
	 * @param      array    $_data  The data
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function start(string $_type, array $_data = [])
	{
		$get_session = self::get_session();

		if($_type === 'cross')
		{
			if($get_session)
			{
				self::clean_session();
			}

			$_data['step']       = 'start';

			$_data['start_time'] = time();

			self::set_session($_data);

			return true;
		}
		else
		{
			// ok to load this page whithout condition
		}
	}


	/**
	 * We are in ask step
	 *
	 * @param      string  $_type  The type
	 * @param      array   $_data  The data
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function ask(string $_type, array $_data = [])
	{

		$get_session = self::get_session();

		if($_type === 'cross')
		{
			if(!$get_session)
			{
				self::go_to_first_page();
				return;
			}

			if(isset($get_session['step']) && in_array($get_session['step'], ['start']))
			{
				// ok
			}
			else
			{
				self::go_to_first_page();
				return;
			}

			$new_session = array_merge($get_session, $_data);

			$new_session['step']     = 'ask';
			$new_session['ask_time'] = time();

			self::set_session($new_session);

			return true;
		}
		else
		{
			if(isset($get_session['step']) && $get_session['step'] && in_array($get_session['step'], ['start']))
			{
				if($get_session['step'] === 'start')
				{
					// ok
				}
				else
				{
					self::go_to_first_page();
				}
			}
			else
			{
				self::go_to_first_page();
			}
		}
	}


	/**
	 * We are in subdoamin step
	 *
	 * @param      string  $_type  The type
	 * @param      array   $_data  The data
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function subdomain(string $_type, array $_data = [])
	{
		$get_session = self::get_session();

		if($_type === 'cross')
		{
			if(!$get_session)
			{
				self::go_to_first_page();
				return;
			}

			if(isset($get_session['step']) && in_array($get_session['step'], ['ask']))
			{
				// ok
			}
			else
			{
				self::go_to_first_page();
				return;
			}

			$new_session = array_merge($get_session, $_data);

			$new_session['step']           = 'subdomain';
			$new_session['subdomain_time'] = time();

			self::set_session($new_session);

			return true;
		}
		else
		{
			if(isset($get_session['step']) && $get_session['step'] && in_array($get_session['step'], ['ask']))
			{
				if($get_session['step'] === 'ask')
				{
					// ok
				}
				else
				{
					self::go_to_first_page();
				}
			}
			else
			{
				self::go_to_first_page();
			}
		}
	}


	/**
	 * Creating module
	 *
	 * @param      string  $_type  The type
	 * @param      array   $_data  The data
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function creating(string $_type, array $_data = [])
	{
		$get_session = self::get_session();

		if($_type === 'cross')
		{
			if(!$get_session)
			{
				self::go_to_first_page();
			}

			if(isset($get_session['step']) && in_array($get_session['step'], ['subdomain']))
			{
				// ok
			}
			else
			{
				self::go_to_first_page();
			}

			$new_session = array_merge($get_session, $_data);

			$new_session['step']                     = 'creating';
			$new_session['store_creating_is_runing'] = true;
			$new_session['creating_time']            = time();

			self::set_session($new_session);

			self::create_new_business();
		}
		else
		{
			self::check_busy();

			if(isset($get_session['step']) && $get_session['step'] && in_array($get_session['step'], ['subdomain']))
			{
				if($get_session['step'] === 'subdomain')
				{
					// ok
				}
				else
				{
					self::go_to_first_page();
				}
			}
			else
			{
				self::go_to_first_page();
			}
		}
	}


	private static function create_new_business()
	{

		$get_session = self::get_session();

		\lib\app\store\timeline::set('startcreate');

		$title           = a($get_session, 'title');
		$subdomain       = a($get_session, 'subdomain');

		if(!$title || !$subdomain)
		{
			self::go_to_first_page();
		}

		$question_answer = [];

		if(a($get_session, 'Q1'))
		{
			$question_answer['Q1'] = a($get_session, 'Q1');
		}

		if(a($get_session, 'Q2'))
		{
			$question_answer['Q2'] = a($get_session, 'Q2');
		}

		if(a($get_session, 'Q3'))
		{
			$question_answer['Q3'] = a($get_session, 'Q3');
		}

		if(a($get_session, 'st1'))
		{
			$question_answer['st1'] = a($get_session, 'st1');
		}

		if(a($get_session, 'st2'))
		{
			$question_answer['st2'] = a($get_session, 'st2');
		}

		if(a($get_session, 'st3'))
		{
			$question_answer['st3'] = a($get_session, 'st3');
		}

		$question_answer['st4'] = time();

		$post =
		[
			'title'     => $title,
			'subdomain' => $subdomain,
			'answer'    => $question_answer,
		];

		\dash\temp::set('clesnse_not_end_with_error', true);

		$result = \lib\app\store\add::free($post);

		self::clean_session();

		if(\dash\engine\process::status() && isset($result['store_id']))
		{
			\dash\notif::direct();

			$url = \dash\url::kingdom(). '/'. \dash\store_coding::encode($result['store_id']). '/a?'. \dash\request::fix_get(['bigopening' => 1]);

			\dash\redirect::to($url);
		}
		else
		{
			if(\dash\temp::get('subdomain_exist_in_creating_store'))
			{

			}
			else
			{
				\dash\log::set('business_creatingNew', ['my_step' => 'creating', 'my_error' => true, 'my_data' => $post]);
				\dash\session::set('createNewStore_error', true,  'CreateNewStore');
			}

			\dash\redirect::to(\dash\url::this(). '/error');
			return false;
		}
	}
}
?>