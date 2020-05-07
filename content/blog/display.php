<div class="jibresBanner">
 <div class="avand">
<?php
if(\dash\data::allPostList())
{
?>


<article class="f postListPreview">

<?php
foreach (\dash\data::allPostList() as $key => $value)
{
?>

      <section class="c4 s12 pA5">
        <a class="vcard" href="<?php echo \dash\url::here(). '/'. $value['url']; ?>">
          <?php if (isset($value['meta']['thumb']))
          {
            echo "<img src='". $value['meta']['thumb']."' alt='". $value['title']. "' >";
          }
          else
          {
            echo '<img src="'. \dash\url::siftal() .'/images/default/image-wide.png" alt="default image">' ;
          }
          ?>


          <div class="content">
            <h3><?php echo $value['title']; ?></h3>
            <p><?php echo $value['excerpt']; ?></p>
          </div>

          <div class="footer f">
            <button class="cauto os btn"><?php echo T_("Read more"); ?></button>
          </div>
        </a>
      </section>
<?php
} // end foreach
?>
</article>


<?php
} // end if
\dash\utility\pagination::html();
?>

</div>
</div>