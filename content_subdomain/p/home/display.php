<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-5">
          <img src="<?php echo \dash\data::dataRow_thumb(); ?>">
        </div>
        <div class="c-xs-12 c-7">
          <h1><?php echo \dash\data::dataRow_title(); ?></h1>


          <div class="priceLine">
            <div class="row align-center">
              <div class="c">

                <div data-first>
                  <span><?php echo T_("List Price"); ?></span>
                  <div class="priceShow">
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                    <span class="unit"><?php echo \lib\currency::unit(); ?></span>
                  </div>
                </div>

                <div data-final>
                  <span><?php echo T_("Price"); ?></span>
                  <div class="priceShow">
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                    <span class="unit"><?php echo \lib\currency::unit(); ?></span>
                  </div>
                </div>

                <div data-discount>
                  <span><?php echo T_("You Save"); ?></span>
                  <div class="priceShow">
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                    <span class="unit"><?php echo \lib\currency::unit(); ?></span>
                  </div>
                </div>

              </div>
              <div class="c-auto">
                <div data-ajaxify data-method='post' data-action='<?php echo \dash\url::here(). '/cart'; ?>'  data-data='{"cart": "add", "product_id" : "<?php echo \dash\data::dataRow_id() ?>", "count": 1}' class="addToCart"><?php echo T_("Add to Cart"); ?></div>
              </div>
            </div>
          </div>

          <div class="featureBullets ltr">
            <ul>
              <?php foreach (\dash\data::dataRow_bullet() as $key => $value) {?>
                <li><?php echo \dash\get::index($value, 'text'); ?></li>
              <?php } // endif ?>
            </ul>

          </div>


        </div>

      </div>
  </div>

  <div class="box productDesc"><?php echo \dash\data::dataRow_desc();?></div>
  <div class="box shareBox">
    <nav class="row align-center">
      <div class="c">
        <a href="<?php echo \dash\url::base(). '/n/'. \dash\data::dataRow_id(); ?>"><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::dataRow_id()); ?></span></a>
      </div>
      <div class="c-auto share1">
        <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
          <?php echo \dash\face::site(); ?> <?php echo T_("facebook"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/home?status=<?php echo \dash\url::pwd(); ?>" class="twitter">
          <?php echo \dash\face::site(). ' '. T_("twitter"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo \dash\url::pwd(); ?>&title=<?php echo urlencode(\dash\face::title()); ?>&summary=<?php echo urlencode(\dash\face::desc()); ?>" class="linkedin">
          <?php echo \dash\face::site(). ' '. T_("linkedin"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
          <?php echo \dash\face::site(). ' '. T_("telegram"); ?>
        </a>

      </div>
    </nav>
  </div>

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





<div class=" hide2 jibresBanner">
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