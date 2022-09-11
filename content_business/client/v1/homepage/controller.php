<?php

namespace content_business\client\v1\homepage;

class controller
{

	public static function routing()
	{
		if(\dash\request::is('get'))
		{
			view::config();;
		}
		else
		{
			\dash\header::status(405); // method not allowd
		}
	}



}