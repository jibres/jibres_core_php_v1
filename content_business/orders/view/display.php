<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-md-4">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-md-8">
			<div class="box">
				<div class="body">
					<div class="row">
						<div class="c-auto">
							<div class="badge pA10-f mB10 fs09 light"><?php echo T_("Order number") ?> <code class="btn link"><?php echo \dash\get::index(\dash\data::dataRow_order(), 'id_code'); ?></code></div>
						</div>
						<div class="c-auto">
							<div class="badge pA10-f mB10 fs09 light"><?php echo T_("Order status") ?> <code class="btn link"><?php echo \dash\get::index(\dash\data::dataRow_order(), 'status'); ?></code></div>
						</div>

					</div>

          <div class="msg">

          <?php $address = \dash\get::index(\dash\data::dataRow(), 'address'); ?>
          <?php if(isset($address['country']) && $address['country']) {?><i class="flag <?php echo mb_strtolower($address['country']); ?>"></i><?php } //endif ?>
          <span ><?php echo \dash\get::index($address, 'location_string'); ?></span>
          <span><?php echo \dash\get::index($address, 'address'); ?></span>
          <?php if(isset($address['postcode']) && $address['postcode']) {?>
            <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($address['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>
          <?php }//endif ?>
          <?php echo \dash\get::index($address, 'name'); ?></td>
          <?php if(isset($address['phone']) && $address['phone']) {?>
            <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($address['phone']); ?></div>
          <?php } //endif ?>
          <?php if(isset($address['mobile']) && $address['mobile']) {?>
           <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($address['mobile']); ?></div>
          <?php } //endif ?>
          </div>

				</div>

					<?php if(!\dash\get::index(\dash\data::dataRow_order(), 'pay') && \dash\get::index(\dash\data::dataRow_order(), 'status') !== 'cancel') {?>
						<footer class="txtRa">
							<div class="btn warn" data-confirm data-data='{"set_status": "cancel"}'><?php echo T_("Cancel order") ?></div>
						</footer>
					<?php } //endif ?>



			</div>
				<?php \lib\website::product_list_raw(\dash\data::dataRow_products()); ?>

		</div>
	</div>
</div>



<?php if(false) {?>
	/home/reza/projects/jibres/content_business/orders/view/controller.php:17:
array (size=4)
  'order' =>
    array (size=26)
      'id' => string '1356068' (length=7)
      'id_code' => string 'JF1356068' (length=9)
      'type' => string 'sale' (length=4)
      'customer' => null
      'seller' => null
      'date' => string '2020-07-21 12:53:07' (length=19)
      'title' => null
      'qty' => float 1
      'item' => string '1' (length=1)
      'subprice' => float 4000
      'subdiscount' => float 0
      'subtotal' => float 4000
      'subvat' => float 0
      'discount' => float 0
      'discount2' => null
      'pre' => null
      'shipping' => null
      'shippingvat' => null
      'total' => float 4000
      'pay' => string '1' (length=1)
      'address_id' => null
      'status' => string 'pending_verify' (length=14)
      'datecreated' => string '2020-07-21 12:53:07' (length=19)
      'datemodified' => string '2020-07-21 12:53:16' (length=19)
      'desc' => null
      'guestid' => string '930413721493c57e0e5aa9e07c4b47e3' (length=32)
  'products' =>
    array (size=1)
      0 =>
        array (size=17)
          'id' => string '15' (length=2)
          'url' => string 'https://mydomain.local/fa/p/15/آدامس' (length=41)
          'unit' => string 'عدد' (length=6)
          'price' => float 4000
          'discount' => string '0' (length=1)
          'finalprice' => float 4000
          'vat' => boolean false
          'count' => string '1' (length=1)
          'sum' => string '4000' (length=4)
          'title' => string 'آدامس' (length=10)
          'slug' => string 'آدامس' (length=10)
          'thumb' => string 'https://cdn.jibres.local/img/default/image.png' (length=46)
          'trackquantity' => boolean false
          'instock' => boolean false
          'status' => string 'available' (length=9)
          'category_list' =>
            array (size=0)
              empty
          'allow_shop' => boolean true
  'address' =>
    array (size=25)
      'location_string' => string '' (length=0)
      'factor_id' => string '1356068' (length=7)
      'title' => null
      'name' => string 'رضا محیطی' (length=17)
      'company' => null
      'companyname' => null
      'jobtitle' => null
      'country' => null
      'flag' => null
      'country_name' => null
      'province' => null
      'province_name' => null
      'city' => null
      'city_name' => null
      'address' => string 'خیابن شهید محلانسیب' (length=36)
      'address2' => null
      'postcode' => null
      'phone' => null
      'mobile' => string '91055556644' (length=11)
      'fax' => null
      'latitude' => null
      'longitude' => null
      'map' => null
      'datecreated' => string '2020-07-21 12:53:07' (length=19)
      'datemodified' => null
  'action' =>
    array (size=2)
      0 =>
        array (size=13)
          'id' => string '3' (length=1)
          'factor_id' => string '1356068' (length=7)
          'action' => string 'pay_successfull' (length=15)
          'desc' => null
          'file' => null
          'user_id' => null
          'datecreated' => string '2020-07-21 12:53:16' (length=19)
          'datemodified' => null
          'displayname' => string 'بدون کاربر' (length=19)
          'avatar' => string 'https://cdn.jibres.local/img/avatar/unknown.png' (length=47)
          'gender' => boolean false
          'gender_string' => null
          'mobile' => null
      1 =>
        array (size=13)
          'id' => string '2' (length=1)
          'factor_id' => string '1356068' (length=7)
          'action' => string 'order' (length=5)
          'desc' => null
          'file' => null
          'user_id' => null
          'datecreated' => string '2020-07-21 12:53:07' (length=19)
          'datemodified' => null
          'displayname' => string 'بدون کاربر' (length=19)
          'avatar' => string 'https://cdn.jibres.local/img/avatar/unknown.png' (length=47)
          'gender' => boolean false
          'gender_string' => null
          'mobile' => null
<?php } //endif ?>