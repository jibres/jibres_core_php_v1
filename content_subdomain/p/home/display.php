<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-5">
          <img src="<?php echo \dash\data::dataRow_thumb(); ?>">
        </div>
        <div class="c-xs-12 c-7">
          <h1><?php echo \dash\data::dataRow_title(); ?></h1>

          <div class="priceLine">
          <div class="row">
            <div class="c">
              <span><?php echo T_("Price"); ?></span>
              <div class="priceShow">
                <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                <span class="unit"><?php echo \lib\currency::unit(); ?></span>
              </div>
            </div>
            <div class="c-auto">
              <div data-ajaxify data-method='post' data-action='<?php echo \dash\url::here(). '/cart'; ?>'  data-data='{"cart": "add", "product_id" : "<?php echo \dash\data::dataRow_id() ?>", "count": 1}' class="addToCart"><?php echo T_("Add to Cart"); ?></div>
            </div>
          </div>
          </div>

          <div class="featureBullets ltr">
            <ul>
              <li>HSDPA 850 / 900 / 2100 - LTE B1 (2100) B2 (1900 PCS) B3 (1800 +) B4 (1700/2100 AWS 1) B5 (850) B7 (2600) B8 (900) B20 (800 DD) B28 (700 APT) B38 (TD 2600) B40 (TD 2300) Dual SIM (Nano-SIM, dual stand-by)> (ensure to check compatibility with your carrier before purchase)</li>
              <li>6. 3 inches 1080 x 2340 pixels, 19. 5: 9 ratio (~409 ppi density) - Fingerprint (rear-mounted)</li>
              <li>64GB + 4GB RAM - microSD, up to 256 GB - Qualcomm SDM665 Snapdragon Octa-core - Non-removable Li-Po 4000 mAh battery</li>
              <li>Rear (Main) Camera: Quad 48MP(wide) + 8MP(ultrawide) + 2MP(dedicated macro camera) + 2MP - Front Camera: 13 MP, f/2. 0 - Video: 2160p@30fps, 1080p@30/60/120fps, 720p@960fps</li>
              <li>Unlocked cellphones are compatible with most of the GSM carriers ( Like T-Mobile or AT&T ) but please be aware that are not compatible with CDMA carriers ( Like Sprint or Verizon Wireless for example ) - FCC ID: 2AFZZC3JG</li>
            </ul>

          </div>


        </div>

      </div>
  </div>

  <div class="box productDesc"><?php echo \dash\data::dataRow_desc();?></div>

<?php if(\dash\data::propertyList()) { ?>
  <div class="box productInfo">
<?php foreach (\dash\data::propertyList() as $property => $cat) {?>
      <h3><?php echo $cat['title']; ?></h3>
    <table class="tbl1 responsive v5">
<?php foreach ($cat['list'] as $key => $value) {?>
      <tr>
        <th><?php echo $value['key']; ?></th>
        <td><?php echo $value['value']; ?></td>
      </tr>
<?php     } ?>
    </table>
<?php   } ?>
  </div>
<?php } ?>

</div>





<div class=" hide jibresBanner">
 <div class="avand">
<?php $dataRow = \dash\data::dataRow(); ?>
<div class="blogEx">


<article>
  <section>
    <h2><?php echo \dash\get::index($dataRow, 'title'); ?></h2>

  <a href="<?php echo \dash\data::dataRow_link(); ?>" class="thumb">
      <img src="<?php echo \dash\get::index($dataRow, 'thumb'); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
  </a>


  <div><?php echo \dash\data::dataRow_desc(); ?></div>




  <div class='msg simple f mT20'>
    <div class="c"><time datetime="<?php echo \dash\data::dataRow_datemodified(); ?>"><?php echo \dash\fit::date(\dash\data::dataRow_publishdate()); ?></time></div>
    <div class="cauto os"><a href="<?php echo \dash\url::base(). '/n/'. \dash\data::dataRow_id(); ?>" title='<?php echo T_("For share via social networks"); ?>'><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\data::dataRow_id(); ?></span></a></div>
  </div>


  <div class="tagBox msg simple">
    <?php \dash\app\term::load_tag_html(['format' => 'html']); ?>
  </div>

    <div class="msg"><?php require_once ('shareBox.php');?></div>

    <?php
      $myPostSimilar = \dash\app\posts::get_post_list(['mode' => 'similar', 'post_id' => \dash\data::dataRow_id()]);
      if($myPostSimilar)
      {
        echo '<nav class="msg">';
        echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
        foreach ($myPostSimilar as $key => $value)
        {
          echo '<a class="block" href="'. \dash\url::kingdom().'/n/'. \dash\data::dataRow_id().'">'. $value['title']. '</a>';
        }
        echo '</nav>';
      }
    ?>


<?php
if(\dash\user::id())
{
  addNewComment();
}
  showCommentList();
?>

  </section>
</article>







<?php
function loadTermsTemplate()
{
  if(\dash\data::dataRow_type() === 'cat')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['cat' => \dash\data::dataRow_slug()]);
  }
  elseif(\dash\data::dataRow_type() === 'tag')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['tag' => \dash\data::dataRow_slug()]);
  }

  if($myPostByThisCat)
  {
    echo "<article class='postListPreview'>";

    foreach ($myPostByThisCat as $key => $value)
    {
      echo "<section class='f'>";
      if(isset($value['meta']['thumb']))
      {
        echo "<div class='cauto s12 pRa10 txtC'><a href='$value[link]'><img src='". $value['meta']['thumb']. "' alt='$value[title]' width='100px'></a></div>";
      }
      echo "<div class='c s12'><h3><a href='$value[link]'>$value[title]</a></h3><p>$value[excerpt]</p></div>";

      echo "</section>";
    }
    echo "</article>";
  }
} // end function
?>



















<?php
function addNewComment()
{
?>

<form  method="post" data-refresh autocomplete="off" action="<?php echo \dash\url::here(); ?>/comment">

  <input type="hidden" name="id" class="hide" value="<?php echo \dash\data::dataRow_id(); ?>">
  <?php
  if(!\dash\user::id())
  {
  ?>
      <div class="f">
        <div class="c pRa5">

          <div class="input">
           <label class="addon" for="name"><?php echo T_("Name"); ?></label>
           <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40' value="<?php echo \dash\user::detail('displayname'); ?>">
          </div>

        </div>
        <div class="c">
          <div class="input">
           <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
           <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Mobile"); ?>' maxlength="13" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>' value="<?php echo \dash\user::detail('mobile'); ?>">
          </div>
        </div>

        <input type="text" name="username" class="hide" value="">
      </div>
  <?php
  } // endif
  ?>

  <label><?php echo T_("Your rate"); ?></label>
  <div class="radioRating togglable">
    <div class="rateBox">
      <input type="radio" name="star" id="star-1" value="1">
      <label for="star-1"></label>
      <input type="radio" name="star" id="star-2" value="2">
      <label for="star-2"></label>
      <input type="radio" name="star" id="star-3" value="3">
      <label for="star-3"></label>
      <input type="radio" name="star" id="star-4" value="4">
      <label for="star-4"></label>
      <input type="radio" name="star" id="star-5" value="5">
      <label for="star-5"></label>
    </div>
  </div>

  <div class="input">
    <textarea name="content" class="txt" rows="5" placeholder='<?php echo T_("Write your comment..."); ?>'></textarea>
  </div>

  <button class="btn primary block mT20"><?php echo T_("Send"); ?></button>
</form>


<?php
} // end function
?>





<?php
function showCommentList()
{
  $commentList = \dash\app\comment::get_post_comment();
  if($commentList)
  {
    foreach ($commentList as $key => $value)
    {


?>

  <div class="msg mT10">
    <div class="f">
      <div class="c s12">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar">
        <span class="badge"><?php echo \dash\get::index($value, 'displayname'); ?></span>
        <?php
        if(isset($value['star']) && $value['star'])
        {
          for ($i=1; $i <= $value['star'] ; $i++)
          {
            echo '<i class="sf-star fc-yellow"></i>';
          }
        }
        ?>

      </div>
      <div class="c s12">
        <p><?php echo $value['content']; ?></p>
      </div>
      <div class="c s12">
        <span><?php echo \dash\fit::date($value['datecreated']); ?></span>
      </div>
    </div>
  </div>




<?php
    } // end for
  } // end if
} // endfunction
?>

</div>
</div>