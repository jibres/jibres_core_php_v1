<?php
namespace content_love\plan\add;


class model
{
	public static function post()
	{
		$args =
			[
                'store_id' => \dash\request::get('business_id'),
                'plan'     => \dash\request::post('plan'),
                'period'   => \dash\request::post('periodtype'),
                'days'     => \dash\request::post('days'),
			];

        \lib\app\plan\planSet::setManual($args);

        if(\dash\engine\process::status())
        {
            // return to list plan for this business
            \dash\redirect::to(\dash\url::this(). \dash\request::full_get());
        }
	}
}

