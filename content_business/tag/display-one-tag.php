<div class="avand category">
    <div class="box">
      <div class="pad">
        <a href="<?php echo \dash\url::kingdom(). '/tag'; ?>"><?php echo T_("Tags") ?></a>
        <?php if(\dash\data::dataRow_parent() && is_array(\dash\data::dataRow_parent())) {?>
          <?php foreach (\dash\data::dataRow_parent() as $key => $value) { echo ' / '; ?>
          <a href="<?php echo a($value, 'url') ?>"><?php echo a($value, 'title') ?></a>
        <?php } //endfor ?>
      <?php } //endif ?>
    </div>
  </div>
  <div class="box">
    <div class="body">
      <div class="row">
        <div class="c-10 c-xs-12">
          <h2><?php echo \dash\data::dataRow_title(); ?></h2>
          <div><?php echo \dash\data::dataRow_desc(); ?></div>
        </div>
        <div class="c-2 c-xs-12">
          <img class="w300" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
        </div>
      </div>
    </div>
  </div>
  <?php if(\dash\data::dataRow_child() && is_array(\dash\data::dataRow_child())) {?>
    <div class="box">
      <div class="pad">
        <div class="row">
          <?php foreach (\dash\data::dataRow_child() as $key => $value) {?>
            <a  class="c-auto txtC" href="<?php echo a($value, 'url') ?>">
              <div>
                <img class="w100" src="<?php echo a($value, 'file') ?>" alt="<?php echo a($value, 'title') ?>">
              </div>
              <div class="txtC">
                <?php echo a($value, 'title') ?>
              </div>
            </a>
          <?php } //endif ?>
        </div>
      </div>
    </div>
  <?php } //endif ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <div class="box">
      <div class="pad">
        <div class="txtB mB10"><?php echo T_("Filter") ?></div>
        <form method="get" action="<?php echo \dash\url::that(); ?>">
          <div class="searchBox mB20">
            <div class="input search <?php if(\dash\validate::search_string()) { echo 'apply'; }?>">
              <input type="search" name="q" placeholder='<?php echo T_("Search products"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>"  autocomplete='off' >
              <button class="addon btn light3 s0"><i class="sf-search"></i></button>
            </div>
          </div>
          <?php HTML_tag_filter(); ?>


        </form>
      </div>
    </div>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <?php
    if(\dash\data::productList())
    {
      \lib\website::product_list(\dash\data::productList(), 2);
      \dash\utility\pagination::html();
    }
    ?>

  </div>
</div>
</div>
<?php
function HTML_tag_filter()
{
   if(is_array(\dash\data::tagFilterList()))
  {

    echo '<div class="filterList">';

    $first            = true;
    $myClass          = null;
    $lastGroup        = null;
    $apply_filter_btn = false;

    foreach (\dash\data::tagFilterList() as $key => $value)
    {
      if($lastGroup !== $value['group'])
      {
        echo '<div class="mB5">'. $value['group']. '</div>';
        $lastGroup = $value['group'];
      }


      echo '<a class="btn mB20 mLa5 '. $myClass;

      if(a($value, 'is_active'))
      {
        echo ' primary2';
      }
      else
      {
       echo ' light';
      }
      echo '" href="'. \dash\url::that(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';

      $myClass = null;
      $first = false;
    }
    echo '</div>';
  }
}

 ?>