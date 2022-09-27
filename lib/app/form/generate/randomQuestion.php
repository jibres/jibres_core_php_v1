<?php
namespace lib\app\form\generate;


trait randomQuestion
{
	private  static $questions = false;

	private static function randomQuestion($_items)
	{
		if(self::$questions === false)
		{
			$questions = a(self::$formDetail, 'formLoad', 'questions');
			if(is_string($questions))
			{
				$questions = json_decode($questions, true);
			}

			if(!is_array($questions))
			{
				$questions = [];
			}

			self::$questions = $questions;
		}

		// no random question
		// show all question
		if(!self::$questions)
		{
			return true;
		}

		if(isset($_items['require']) && $_items['require'])
		{
			return true;
		}


		if(in_array($_items['id'], self::$questions))
		{
			return true;
		}

		return false;


	}


}
