<?php
namespace content_business\f\home;

class model
{

	/**
	 * This function replace in content_a\form\answer\edit\model
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function edit_mode()
	{
		return false;
	}


	/**
	 * Save form answer
	 */
	public static function post()
	{
		$post  = \dash\request::post();
		$files = \dash\request::files();

		$answer                  = [];
		$answer['form_id']       = \dash\data::formId();
		$answer['startdate']     = \dash\request::post('startdate');
		$answer['user_id']       = \lib\store::in_store() ? \dash\user::id() : null;
		$answer['answer']        = [];
		$answer['formloadtoken'] = \dash\request::post('formloadtoken');
		$answer['formloadtid']   = \dash\request::post('formloadtid');

		if(\dash\data::fillByAdmin())
		{
			$answer['user_id'] = null;
		}

		foreach ($post as $key => $value)
		{
			if(preg_match("/^a_(\d+)$/", $key, $split))
			{
				$answer['answer'][$split[1]] = $value;
			}
		}

		foreach ($files as $key => $value)
		{
			if(preg_match("/^a_(\d+)$/", $key, $split))
			{
				$answer['answer'][$split[1]] = 1; // get the file in other place
			}
		}

		$meta = [];

		// this model extended in content_a\form\answer\edti\model
		if(static::edit_mode())
		{
			$meta['edit_mode'] = true;
			$meta['answer_id'] = \dash\request::get('aid');

			$load_answer_detail = \lib\app\form\answer\get::by_id($meta['answer_id']);

			$answer['form_id']   = \dash\request::get('id');
			$answer['user_id']   = a($load_answer_detail, 'user_id');
			$answer['startdate'] = a($load_answer_detail, 'startdate');


		}

		\lib\app\form\answer\add::public_new_answer($answer, $meta);

		if(\dash\engine\process::status())
		{
			if(a($post, 'notredirect'))
			{
				// nothing
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}

}

?>