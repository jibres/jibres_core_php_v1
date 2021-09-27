<?php
namespace content_a\order\address;


class view
{
	public static function config()
	{
		$address = a(\dash\data::orderDetail(), 'address');
      	\dash\data::dataRowAddress($address);

      	\content_a\order\view::master_order_view();

		$customer = a(\dash\data::orderDetail(), 'factor', 'customer');
		if($customer)
		{
			$customer_address_list = \dash\app\address::user_address_list($customer);
			\dash\data::customerAddressList($customer_address_list);

			foreach ($customer_address_list as $key => $value)
			{

				if(
					// \dash\validate::is_equal(a($address, 'companyname'), a($value, 'companyname')) &&
					// \dash\validate::is_equal(a($address, 'company'), a($value, 'company')) &&
					// \dash\validate::is_equal(a($address, 'jobtitle'), a($value, 'jobtitle')) &&
					\dash\validate::is_equal(a($address, 'country'), a($value, 'country')) &&
					\dash\validate::is_equal(a($address, 'province'), a($value, 'province')) &&
					\dash\validate::is_equal(a($address, 'city'), a($value, 'city')) &&
					\dash\validate::is_equal(a($address, 'address'), a($value, 'address')) &&
					// \dash\validate::is_equal(a($address, 'address2'), a($value, 'address2')) &&
					\dash\validate::is_equal(a($address, 'postcode'), a($value, 'postcode')) &&
					\dash\validate::is_equal(a($address, 'phone'), a($value, 'phone'))
					// \dash\validate::is_equal(a($address, 'mobile'), a($value, 'mobile')) &&
					// \dash\validate::is_equal(a($address, 'fax'), a($value, 'fax'))
				  )
				{
					// var_dump($value);exit;
					\dash\data::currentCustomerAddressid(a($value, 'id'));
				}
			}
		}

	}
}
?>