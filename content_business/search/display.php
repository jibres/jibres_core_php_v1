
<section class="avand">


    <form method="get" action="<?php echo \dash\url::that(); ?>">
      <div class="searchBox">
        <div class="f">
          <div class="c pRa10">
            <div>
              <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
                <input type="search" name="q" placeholder='<?php echo T_("Search products"); ?>' id="q" value="<?php echo \dash\request::get('q'). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
                <button class="addon btn light3 s0"><i class="sf-search"></i></button>
              </div>
            </div>
          </div>

          <div class="cauto">
            <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
              <option><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
                <?php
                foreach (\dash\data::sortList() as $key => $value)
                {
                  ?>
                  <option value="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>" <?php if(\dash\request::get('sort') == \dash\get::index($value, 'query')['sort'] && \dash\request::get('order') == \dash\get::index($value, 'query')['order']) { echo 'selected'; }?> ><?php echo \dash\get::index($value, 'title'); ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </form>


<?php
if(\dash\data::dataTable())
{
 \lib\website::product_list(\dash\data::dataTable());
}
?>
<?php \dash\utility\pagination::html(); ?>

<?php if(\dash\data::filterBox()) {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>
</section>






