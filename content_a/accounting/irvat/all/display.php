<?php function pageStat() {?>
<?php $myData = \dash\data::summaryDetail(); ?>
<section class="f">
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Count");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'count'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Total pay");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'total'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Total by vat");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'subtotalitembyvat'));?></div>
    </a>
  </div>
   <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo T_("Sum vat");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'sumvat'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("6%");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'sumvat6'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a class="stat x70">
      <h3><?php echo \dash\fit::text("3%");?></h3>
      <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'sumvat3'));?></div>
    </a>
  </div>

</section>
<?php } //endfunction ?>

<?php
if(\dash\data::dataTable())
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();
        pageStat();
        htmlTable();
        htmlFilter();
    }
    else
    {
        htmlSearchBox();
        pageStat();
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
?>







<?php function htmlSearchBox() {?>
<form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::current(); ?>">
  <div class="box">
    <header data-kerkere='.showBoxSearch'><h2><?php echo T_("Search") ?></h2></header>
    <div class="showBoxSearch"  data-kerkere-content='hide'>

      <div class="body">

            <div class="check1">
              <input type="checkbox" name="vat" id="vat"  <?php if(\dash\request::get('vat')) { echo 'checked'; } ?> >
              <label for="vat"><?php echo T_("Are you want to calculate in vat result?"); ?></label>
            </div>

            <div class="check1">
              <input type="checkbox" name="official" id="official"  <?php if(\dash\request::get('official')) { echo 'checked'; } ?> >
              <label for="official"><?php echo T_("Official factor?"); ?></label>
            </div>

            <div class="input mB10">
              <input type="text" name="year" placeholder='<?php echo T_("Year"); ?>' value="<?php echo \dash\request::get('year'); ?>">
            </div>
            <div class="input mB10">
              <input type="text" name="season" placeholder='<?php echo T_("Season"); ?>' value="<?php echo \dash\request::get('season'); ?>">
            </div>
            <div class="input mB10">
              <input type="text" name="seller" placeholder='<?php echo T_("Seller"); ?>' value="<?php echo \dash\request::get('seller'); ?>">
            </div>
            <div class="input search">
                <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
            </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Search"); ?></button>
      </footer>
    </div>
  </div>
  </form>

<?php } //endfunction ?>


<?php function htmlTable() {?>
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
    <table class="tbl1 v5 responsive">
        <thead>
            <tr class="fs09">

                <th data-sort="<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>"><?php echo T_("Title"); ?></a></th>
                <th class="txtL collapsing" data-sort="<?php echo \dash\get::index($sortLink, 'factordate', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'factordate', 'link'); ?>"><?php echo T_("Date"); ?></a></th>
                <th class="txtL collapsing"><?php echo T_("Season") ?></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'total', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'total', 'link'); ?>"><?php echo T_("Total pay"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'subtotalitembyvat', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'subtotalitembyvat', 'link'); ?>"><?php echo T_("Total item by vat"); ?></a></th>
                <th class="txtL" data-sort="<?php echo \dash\get::index($sortLink, 'sumvat', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'sumvat', 'link'); ?>"><?php echo T_("Sum vat"); ?></a></th>
                <th class="txtL collapsing"><?php echo T_("Economic code") ?><br><?php echo T_("Company national id"); ?> </th>
                <th class="txtC collapsing"><?php echo T_("Thirdparty") ?></th>

            </tr>
        </thead>
        <tbody class="">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td>
                    <a href="<?php echo \dash\url::that(); ?>/edit?id=<?php echo \dash\get::index($value, 'id'); ?>" class="link">

                         <?php echo \dash\get::index($value, 'title'); ?>

                    </a>
                </td>

                <td class="ltr txtL"><?php echo \dash\fit::date(\dash\get::index($value, 'factordate')); ?></td>
                <td class="ltr txtL collapsing"><a href="<?php echo \dash\url::that(). '?year='. \dash\get::index($value, 'year'). '&season='. \dash\get::index($value, 'season'); ?>"><?php echo \dash\fit::text(\dash\get::index($value, 'year'). ' / '. \dash\get::index($value, 'season')); ?></a></td>
                <td class="ltr txtL"><?php echo \dash\fit::number(\dash\get::index($value, 'total')); ?></td>
                <td class="ltr txtL"><?php echo \dash\fit::number(\dash\get::index($value, 'subtotalitembyvat')); ?></td>
                <td class="ltr txtL">
                    <?php echo \dash\fit::number(\dash\get::index($value, 'sumvat')); ?>


                    <?php if(!\dash\get::index($value, 'vat_ok')) {?>
                        <i title="<?php echo \dash\fit::number(\dash\get::index($value, 'vat_9_percent')); ?>" class="sf-info fc-red fs14"></i>
                    <?php } //endif ?>
                </td>

                <td class="fs08 txtL ltr ">
                  <div><?php echo \dash\fit::text(\dash\get::index($value, 'user_detail_legal', 'companyeconomiccode')); ?></div>
                  <div><?php echo \dash\fit::text(\dash\get::index($value, 'user_detail_legal', 'companynationalid')); ?></div>
                </td>

                <td class="">
                  <a href="<?php echo \dash\url::that(). '?seller='. \dash\get::index($value, 'user_detail', 'id');?>"  class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'user_detail_legal', 'mobile'); ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'user_detail_legal', 'mobile')); ?></div>
                      <div class="name"><?php echo \dash\get::index($value, 'user_detail_legal', 'companyname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
                  </a>
                </td>
            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::current(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>


</div>

<?php } //endfunction ?>

