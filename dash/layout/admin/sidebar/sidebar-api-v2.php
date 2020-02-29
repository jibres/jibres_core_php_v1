
  <li>
    <a href="<?php echo \dash\url::that(); ?>"><i class='sf-campfire'></i> <span><?php echo \dash\data::site_title(); ?> <?php echo T_("API"); ?></span></a>
    <ul>
      <?php // ------------------------------------------------------------------------------------------------------------------ INTRO  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#intro"><i class='sf-tree-1'></i> <span><?php echo T_("Introduction"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#endpoints"><i class='sf-terminal'></i> <span><?php echo T_("Endpoints"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#requests"><i class='sf-angle-double-left'></i> <span><?php echo T_("Requests"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#responses"><i class='sf-angle-double-right'></i> <span><?php echo T_("Responses"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ APPLICATION  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#app-detail"><i class='sf-download'></i> <span><?php echo T_("Get app detail"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#token"><i class='sf-unlock-alt'></i> <span><?php echo T_("Get Access Token"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Sign Up User"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#language"><i class='sf-download'></i> <span><?php echo T_("Get language list"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ LOCATION  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#location-country"><i class='sf-earth'></i> <span><?php echo T_("Country list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#location-province"><i class='sf-earth'></i> <span><?php echo T_("Province list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#location-city"><i class='sf-earth'></i> <span><?php echo T_("City list"); ?></span></a></li>
      <li><hr></li>


      <?php // ------------------------------------------------------------------------------------------------------------------ PROFILE  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#get-profile"><i class='sf-download'></i> <span><?php echo T_("Get profile detail"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#upload-avatar"><i class='sf-cloud-upload'></i> <span><?php echo T_("Upload avatar"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#update-profile"><i class='sf-edit-write'></i> <span><?php echo T_("Update profile"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#profile-address-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Add new address"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#profile-address-list"><i class='sf-th'></i> <span><?php echo T_("Get list of your address"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#profile-address-edit"><i class='sf-edit-write'></i> <span><?php echo T_("Edit address"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#profile-address-remove"><i class='sf-eraser'></i> <span><?php echo T_("Remove address"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ USER MANAGMENT  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#user-list"><i class='sf-th'></i> <span><?php echo T_("Users list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-add-crm"><i class='sf-plus-circle'></i> <span><?php echo T_("Add new user"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#get-user-detail"><i class='sf-download'></i> <span><?php echo T_("Get one user detail"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#edit-user"><i class='sf-edit-write'></i> <span><?php echo T_("Edit user"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#edit-user-avatar"><i class='sf-cloud-upload'></i> <span><?php echo T_("Set user avatar"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-address-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Add new address to user"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-address-list"><i class='sf-th'></i> <span><?php echo T_("Get list of user address"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-address-edit"><i class='sf-edit-write'></i> <span><?php echo T_("Edit user address"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-address-remove"><i class='sf-eraser'></i> <span><?php echo T_("Remove user address"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ BUSINESS  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#about"><i class='sf-download'></i> <span><?php echo T_("Get about"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#mission"><i class='sf-download'></i> <span><?php echo T_("Get mission"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#vision"><i class='sf-download'></i> <span><?php echo T_("Get vision"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#contact"><i class='sf-download'></i> <span><?php echo T_("Get contact"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#posts"><i class='sf-th'></i> <span><?php echo T_("Get list of posts"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#get-post"><i class='sf-download'></i> <span><?php echo T_("Get post detail"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ ACCOUNT  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#user-login"><i class='sf-log-in'></i> <span><?php echo T_("Login user"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#user-login-verify"><i class='sf-check'></i> <span><?php echo T_("Verify user"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#smile"><i class='sf-download'></i> <span><?php echo T_("Check new notification"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#notif"><i class='sf-th'></i> <span><?php echo T_("Get notification list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#session-list"><i class='sf-th'></i> <span><?php echo T_("Session list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#session-terminate"><i class='sf-eraser'></i> <span><?php echo T_("Terminate session"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ TICKET MANAGEMENT  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Add new ticket"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-list"><i class='sf-th'></i> <span><?php echo T_("Ticket list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-load"><i class='sf-download'></i> <span><?php echo T_("Load a ticket"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-replay"><i class='sf-plus-circle'></i> <span><?php echo T_("Answer to ticket"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-status"><i class='sf-cog'></i> <span><?php echo T_("Set ticket status"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#ticket-solved"><i class='sf-cog'></i> <span><?php echo T_("Set ticket solved"); ?></span></a></li>

      <li><hr></li>


      <?php // ------------------------------------------------------------------------------------------------------------------ PRODUCT  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#product-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Add new product"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-edit"><i class='sf-edit-write'></i> <span><?php echo T_("Edit product"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-gallery"><i class='sf-cloud-upload'></i> <span><?php echo T_("Upload product gallery"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-gallery-thumb"><i class='sf-cog'></i> <span><?php echo T_("Set product thumb"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-gallery-remove"><i class='sf-eraser'></i> <span><?php echo T_("Remove file gallery"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-get"><i class='sf-download'></i> <span><?php echo T_("Get product detail"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-list"><i class='sf-th'></i> <span><?php echo T_("Product list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-search"><i class='sf-th'></i> <span><?php echo T_("Product search"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-category-list"><i class='sf-th'></i> <span><?php echo T_("Get product by category"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-company-list"><i class='sf-th'></i> <span><?php echo T_("Get product by company"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#product-property"><i class='sf-th'></i> <span><?php echo T_("Get product property"); ?></span></a></li>


      <li><a href="<?php echo \dash\url::that(); ?>#product-remove"><i class='sf-eraser'></i> <span><?php echo T_("Remove product"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ PRODUCT COMMENT  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#product-comment-add"><i class='sf-plus-circle'></i> <span><?php echo T_("Add product comment"); ?></span></a></li>
      <li><hr></li>

      <?php // ------------------------------------------------------------------------------------------------------------------ PRODUCT META  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#category-list"><i class='sf-th'></i> <span><?php echo T_("Category list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#category-child"><i class='sf-th'></i> <span><?php echo T_("Category child"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#category-property"><i class='sf-th'></i> <span><?php echo T_("Category property"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#company-list"><i class='sf-th'></i> <span><?php echo T_("Company list"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#collection-list"><i class='sf-th'></i> <span><?php echo T_("Collection list"); ?></span></a></li>
      <li><hr></li>


      <?php // ------------------------------------------------------------------------------------------------------------------ CART  ?>
      <li><a href="<?php echo \dash\url::that(); ?>#add-to-cart"><i class='sf-plus-circle'></i> <span><?php echo T_("Add to cart"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#show-cart"><i class='sf-th'></i> <span><?php echo T_("Get cart detail"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#delete-from-cart"><i class='sf-eraser'></i> <span><?php echo T_("Delete from cart"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#edit-cart"><i class='sf-edit-write'></i> <span><?php echo T_("Edit cart"); ?></span></a></li>
      <li><a href="<?php echo \dash\url::that(); ?>#checkout-cart"><i class='sf-edit-write'></i> <span><?php echo T_("Checkout cart"); ?></span></a></li>


    </ul>
  </li>


