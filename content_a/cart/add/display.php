<div class="avand">
  <form method="post" autocomplete="off" data-refresh>
    <div class="cbox" id="searchInProducts">
      <div class="f">
        <div class="c">
          <select name="product" class="select22 barCode" id="productSearch"  data-model='html' autofocus  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::that(). '?user='. \dash\request::get('user'); ?>&json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in list to add product"); ?> +'>
          </select>

        </div>
        <div class="cauto">
          <div class="input">
            <input type="number" name="count" placeholder="<?php echo T_("Count"); ?>" value="1">
          </div>
        </div>
        <div class="cauto">
          <button class="btn success"><?php echo T_("Add"); ?></button>
        </div>
      </div>
    </div>

  </form>
</div>
