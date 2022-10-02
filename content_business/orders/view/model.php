<?php
namespace content_business\orders\view;


class model
{

	public static function post()
	{
		if(\dash\request::post('answerform') === 'answerform' && \dash\data::satisfactionSurveyForm())
		{
			$post  = \dash\request::post();
			$files = \dash\request::files();

			$answer                  = [];
			$answer['form_id']       = \dash\data::satisfactionSurveyForm();
			$answer['factor_id']     = \dash\request::get('id');
			$answer['startdate']     = \dash\request::post('startdate');
			$answer['user_id']       = \dash\user::id();
			$answer['answer']        = [];
			$answer['formloadtoken'] = \dash\request::post('formloadtoken');
			$answer['formloadtid']   = \dash\request::post('formloadtid');
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

			\lib\app\form\answer\add::public_new_answer($answer);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return;

		}


		if(\dash\request::post('cart') === 'buy')
		{
			$result =
				\lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));

		}

		if(\dash\request::post('cart') === 'add')
		{
			$result =
				\lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));
		}

		if(\dash\request::post('set_status') === 'cancel')
		{
			\lib\app\factor\edit::user_cancel(\dash\request::get('id'));
			\dash\redirect::pwd();
		}
	}

}

?>
