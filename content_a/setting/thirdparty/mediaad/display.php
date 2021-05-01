<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
        <div class="body">
          <div class="msg">
            <p>مدیااد، یک پلتفرم تبلیغات دیجیتال است که به تبلیغ‌دهندگان و صاحبان کسب‌وکارها کمک می‌کند تا تبلیغ برند، محصولات و خدمات خود را در فضای وب‌سایت‌های معتبر فارسی به مخاطبان هدفشان نمایش دهند و ترافیک باکیفیتی جذب کنند و از سوی دیگر، به صاحبان وب‌سایت‌های ایرانی کمک می‌کند تا از طریق نمایش تبلیغ در وب‌سایت خود، به درآمدزایی پایداری دست یابند.</p>
          </div>
          <p>در کد SDK ریتارگتینگ که به شما داده شده است، یک عدد وجود دارد که لطفا آن عدد را اینجا وارد کنید</p>
          <div class="msg info ltr">https://s1.mediaad.org/serve/<b class="txtB fc-red">24225</b>/retargeting.js</div>
            <label for="iretargeting">کد SDK ریتارگتینگ <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="tel" name="addon_mediaad" id="iretargeting" value="<?php echo a($storeData, 'addon_mediaad'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='10' minlength="4">
            </div>
        </div>
<?php if (!\dash\detect\device::detectPWA()) { ?>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
<?php } ?>
    </div>
  </form>
</div>


