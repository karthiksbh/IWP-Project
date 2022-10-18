<header class="header" style="background-color: black;">
   <section class="flex" style="padding-bottom: 8px; border-bottom-width: 10px;">
      <a href="home.php" class="logo"><img src="images/logo.png" alt="" height="40px"; style="margin: 0;"></a>
      <nav class="navbar" style="margin-bottom: 10px;">
         <a href="home.php" style="color: white;">Home</a>
         <a href="about.php" style="color: white;">About</a>
         <a href="orders.php" style="color: white;">Orders</a>
         <a href="shop.php" style="color: white;">Products</a>
         <a href="contact.php" style="color: white;">Contact</a>
      </nav>

      <div class="icons" style="margin-bottom: 10px;">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php" style="margin-right:5px"><i class="fas fa-search" style="font-size:20px; color: white;"></i></a>
         <a href="wishlist.php" style="margin-right:5px"><i class="fas fa-heart" style="font-size:20px; color: white;"></i><sub><span style="color: white;font-size:17px;"><?= $total_wishlist_counts; ?></span></sub></a>
         <a href="cart.php" style="margin-right:5px"><i class="fas fa-shopping-cart" style="font-size:20px; color: white;"></i><sub><span style="color: white;font-size:17px;"><?= $total_cart_counts; ?></span></sub></a>
         <div id="user-btn" class="fas fa-user" style="font-size:20px; color: white;"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Welcome <?= $fetch_profile["name"]; ?></p>
         <a href="components/user_logout.php" class="delete-btn" style="background-color:#FF6700" onclick="return confirm('Do You want to login?');">logout</a> 
         <?php
            }else{
         ?>
         <p>Please Login or Register!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn" style="background-color: #FF6700">register</a>
            <a href="user_login.php" class="option-btn" style="background-color: #FF6700">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>
<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message" style="background-color: #FF6700; width: 25%; margin-top: 20px;">
            <span style="margin: 0 auto; color: white; font-size: 1.8rem;">'.$message.'</span>
            <i class="fas fa-times" style="color: white; font-size: 1.8rem;" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>