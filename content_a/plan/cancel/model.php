<?php

namespace content_a\plan\cancel;

class model
{
    public static function post()
    {
		if(\dash\request::post('refund') === 'refund')
		{
			\lib\app\plan\businessPlanDetail::doCancel();

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
    }

}