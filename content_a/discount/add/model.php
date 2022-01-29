<?php
namespace content_a\discount\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			$result = \lib\app\discount\remove::remove(\dash\request::get('id'));

			if($result)
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}

		$post =
		[
			'code'             => \dash\request::post('code'),
			'desc'             => \dash\request::post('desc'),
			'type'             => \dash\request::post('type'),
			'percentage'       => \dash\request::post('percentage'),
			'maxamount'        => \dash\request::post('maxamount'),
			'fixedamount'      => \dash\request::post('fixedamount'),
			'applyto'          => \dash\request::post('applyto'),
			'product_category' => \dash\request::post('product_category'),
			'special_products' => \dash\request::post('special_products'),
			'minrequirements'  => \dash\request::post('minrequirements'),
			'minpurchase'      => \dash\request::post('minpurchase'),
			'minquantity'      => \dash\request::post('minquantity'),
			'customer'         => \dash\request::post('customer'),
			'customer_group'   => \dash\request::post('customer_group'),
			'special_customer' => \dash\request::post('special_customer'),
			'set_usagetotal'   => \dash\request::post('set_usagetotal'),
			'usagetotal'       => \dash\request::post('usagetotal'),
			'usageperuser'     => \dash\request::post('usageperuser'),
			'startdate'        => \dash\request::post('startdate'),
			'starttime'        => \dash\request::post('starttime'),
			'setenddate'       => \dash\request::post('setenddate'),
			'enddate'          => \dash\request::post('enddate'),
			'endtime'          => \dash\request::post('endtime'),
			'status'           => \dash\request::post('status'),
		];

		if(\dash\request::post('setstatus'))
		{
			$post = ['status' => \dash\request::post('status')];
		}

		if(\dash\data::editMode())
		{
			$result = \lib\app\discount\edit::edit($post, \dash\request::get('id'));
			if(\dash\request::post('setstatus') && \dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

		}
		else
		{
			$result = \lib\app\discount\add::add($post);

			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
			}
		}

		\dash\notif::complete();


	}
}
?>