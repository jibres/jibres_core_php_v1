<?php $myData = \dash\data::myData(); ?>

<section class="row">
  <div class="c-xs-12 c-md-3">
    <a class="stat">
      <h3><?php echo T_("Cart count");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count'));?></div>
    </a>
  </div>

  <div class="c-xs-12 c-md-3">
    <a class="stat">
      <h3><?php echo T_("Total price");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'price'));?></div>
    </a>
  </div>

  <div class="c-xs-12 c-md-3">
    <a class="stat">
      <h3><?php echo T_("Product count");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'product'));?></div>
    </a>
  </div>

  <div class="c-xs-12 c-md-3">
    <a class="stat">
      <h3><?php echo T_("Item count");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'item'));?></div>
    </a>
  </div>
</section>

<?php
if(\dash\data::dataTable())
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();
        htmlTable();
        htmlFilter();
    }
    else
    {
        htmlSearchBox();
        htmlTable();
    }

}
else
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();

        htmlFilter();
    }
    else
    {
        htmlStartAddNew();
    }
}




 function htmlSearchBox() {?>

    <form method="get" action="<?php echo \dash\url::that(); ?>">
        <?php if(\dash\request::get('hu')) {?><input type="hidden" name="hu" value="<?php echo \dash\request::get('hu'); ?>"><?php } //endif ?>
        <?php if(\dash\request::get('order')) {?><input type="hidden" name="order" value="<?php echo \dash\request::get('order'); ?>"><?php } //endif ?>
        <?php if(\dash\request::get('sort')) {?><input type="hidden" name="sort" value="<?php echo \dash\request::get('sort'); ?>"><?php } //endif ?>


        <div class="searchBox">
            <div class="f">
                <div class="cauto pRa10">
                    <a class="btn light3 <?php if(in_array('hu', array_keys(\dash\request::get()))) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
                </div>
                <div class="c pRa10">
                    <div>
                        <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
                            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" data-default data-pass='submit' autocomplete='off' autofocus>
                            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="cauto">
                    <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
                        <option value="<?php echo \dash\url::that(); ?>"><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
                        <?php foreach (\dash\data::mySort() as $key => $value) {?>
                            <option value="<?php echo \dash\url::that(). '?'. $value['link']; ?>" <?php if(\dash\request::get('sort') == $value['sort'] && \dash\request::get('order') == $value['order']) { echo 'selected'; }?> ><?php echo $value['title']; ?></option>
                        <?php } //endif ?>

                        </select>
                    </div>
                </div>
            </div>


            <div class="filterBox" data-kerkere-content='hide'>

                <p><?php echo T_("Show cart where"); ?></p>

                <div class="f align-center">

                    <div class="c">
                        <a class='btn <?php if(\dash\request::get('hu') === 'y') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?hu=y"><?php echo T_("User login and add cart"); ?></a>
                        <a class='btn <?php if(\dash\request::get('hu') === 'n') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?hu=n"><?php echo T_("Gues user add cart"); ?></a>


                    </div>
                </div>
            </div>
    </form>
<?php } //endfunction







 function htmlTable() {?>

<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>

  <table class="tbl1 v1 cbox fs12">
    <thead>
      <tr>
        <th class="collapsing"><?php echo T_("View"); ?></th>
        <th><?php echo T_("Product count"); ?></th>
        <th><?php echo T_("Item count"); ?></th>
        <th><?php echo T_("Date"); ?></th>
        <th class="collapsing"><?php echo T_("User"); ?></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

      <tr class="">
        <td class="collapsing"><a href="<?php echo \dash\url::this(). '/add?'. \dash\request::fix_get(['user' => $value['user_id'], 'guestid' => $value['guestid']]); ?>"><i class="sf-list-ul"></i> <?php echo T_("Detail"); ?></a></td>

        <td>
          <?php echo \dash\fit::number(\dash\get::index($value, 'product_count')); ?> <small><?php echo T_("Product"); ?></small>
        </td>
        <td>
          <?php echo \dash\fit::number(\dash\get::index($value, 'item_count')); ?> <small><?php echo T_("Item"); ?></small>
        </td>
        <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>

        <td class="collapsing">
            <a <?php if(\dash\get::index($value, 'user_id')) {?> href="<?php echo \dash\url::kingdom(). '/crm/member/general?id='.\dash\get::index($value, 'user_id'); ?>" <?php } // endif ?> class="f align-center userPack">
              <div class="c pRa10">
                <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'user_detail', 'mobile'); ?>"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                <div class="name"><?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?></div>
              </div>
              <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
            </a>
          </td>
      </tr>
      <?php } //endif ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endif







 function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>
<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/<?php echo \dash\url::module(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>
<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("No record exist!"); ?></p>
<?php } //endif ?>