<?php
namespace content_api\v1\product\tools;
use \lib\utility;
use \lib\debug;
use \lib\db\logs;
trait product_check_args
{
	public function product_check_args($_args, &$args, $log_meta)
	{
		$store_id       = utility::request('store_id');
		$creator        = utility::request('creator');
		$title          = utility::request('title');
		$name           = utility::request('name');
		$slug           = utility::request('slug');
		$company        = utility::request('company');
		$shortcode      = utility::request('shortcode');
		$unit           = utility::request('unit');
		$barcode        = utility::request('barcode');
		$barcode2       = utility::request('barcode2');
		$code           = utility::request('code');
		$buyprice       = utility::request('buyprice');
		$price          = utility::request('price');
		$discount       = utility::request('discount');
		$vat            = utility::request('vat');
		$initialbalance = utility::request('initialbalance');
		$minstock       = utility::request('minstock');
		$maxstock       = utility::request('maxstock');
		$status         = utility::request('status');
		$sold           = utility::request('sold');
		$stock          = utility::request('stock');
		$thumb          = utility::request('thumb');
		$service        = utility::request('service');
		$checkstock     = utility::request('checkstock');
		$sellonline     = utility::request('sellonline');
		$sellstore      = utility::request('sellstore');
		$carton         = utility::request('carton');
		$datecreated    = utility::request('datecreated');
		$datemodified   = utility::request('datemodified');
		$desc           = utility::request('desc');


	}
}
?>