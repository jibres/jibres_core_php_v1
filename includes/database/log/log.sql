
#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:57:39
	---0.00030899047851562s		---0ms
	SELECT * FROM sessions WHERE `code` = '$2y$07$LyLMYIhDDDe/xGuHOG.dfu1VT2tDi3wWjDkLY251.mWDm3yrQrsgy' AND `status` = 'active' LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:57:39
	---0.010257959365845s		---10ms
	UPDATE sessions SET sessions.count = sessions.count + 1 WHERE code = '$2y$07$LyLMYIhDDDe/xGuHOG.dfu1VT2tDi3wWjDkLY251.mWDm3yrQrsgy'

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:57:39
	---0.00058794021606445s		---1ms
	SELECT * FROM users WHERE `id` = 1 LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:57:39
	---0.00037288665771484s		---0ms
	SELECT * FROM agents WHERE `agent` = 'Mozilla%2F5.0+%28X11%3B+Linux+x86_64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F55.0.2883.87+Safari%2F537.36' LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:57:39
	---0.0039491653442383s		---4ms
	UPDATE sessions SET sessions.count = sessions.count + 1 WHERE code = '$2y$07$LyLMYIhDDDe/xGuHOG.dfu1VT2tDi3wWjDkLY251.mWDm3yrQrsgy'

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:58:05
	---0.00078201293945312s		---1ms
	SELECT * FROM stores WHERE `slug` = 'saeed' LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:58:05
	---0.00038409233093262s		---0ms
	SELECT * FROM products WHERE `id` = 3 AND `store_id` = 1 LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:58:05
	---0.032448053359985s		---32ms
	UPDATE products SET  `title` = 'ماست' , `name` = 'گاور' , `slug` = 455 , `company` = 4 , `shortcode` = 54 , `unit` = 54 , `barcode` = NULL, `barcode2` = NULL, `code` = NULL , `buyprice` = 5 , `price` = 45 , `discount` = 45 , `vat` = 1 , `initialbalance` = 54 , `minstock` = 5 , `maxstock` = 4 , `status` = 'unset' , `sold` = 5 , `stock` = 45 , `thumb` = NULL , `service` = 0 , `checkstock` = 0 , `sellonline` = 0 , `sellstore` = 0 , `carton` = 45 , `desc` = NULL  WHERE products.id = 3

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:58:05
	---0.0014979839324951s		---1ms
	SELECT id FROM logitems WHERE logitems.caller = 'api:product:change:slug' LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:58:05
	---0.00012516975402832s		---0ms
	INSERT INTO logitems SET `caller` = 'api:product:change:slug' , `title` = 'api:product:change:slug'

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:59:39
	---0.0004580020904541s		---0ms
	SELECT * FROM products WHERE `id` = 3 AND `store_id` = 1 LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:59:39
	---0.00029802322387695s		---0ms
	UPDATE products SET  `title` = 'ماست' , `name` = 'گاور' , `slug` = 455 , `company` = 4 , `shortcode` = 54 , `unit` = 54 , `barcode` = NULL, `barcode2` = NULL, `code` = NULL , `buyprice` = 5 , `price` = 45 , `discount` = 45 , `vat` = 1 , `initialbalance` = 54 , `minstock` = 5 , `maxstock` = 4 , `status` = 'unset' , `sold` = 5 , `stock` = 45 , `thumb` = NULL , `service` = 0 , `checkstock` = 0 , `sellonline` = 0 , `sellstore` = 0 , `carton` = 45 , `desc` = NULL  WHERE products.id = 3

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 15:59:39
	---0.00034618377685547s		---0ms
	SELECT * FROM products WHERE `id` = 3 AND `store_id` = 1 LIMIT 1

#---------------------------------------------------------------------- /a/product/general/5
---2017-10-26 16:00:18
	---0.00034618377685547s		---0ms
	SELECT * FROM products WHERE `id` = 3 AND `store_id` = 1 LIMIT 1
