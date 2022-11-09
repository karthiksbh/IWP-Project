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

<header class="header" style="background-color: black;">
   <section class="flex">
      <a href="../admin/admindashboard.php"><img src="../images/logo.png" alt="" height="40px"; style="margin: 0;"></a>
      <nav class="navbar">
         <a href="../admin/admindashboard.php" style="color: white;">Dashboard</a>
         <a href="../admin/products.php" style="color: white;">Products</a>
         <a href="../admin/placed_orders.php" style="color: white;">Orders</a>
         <a href="../admin/admin_accounts.php" style="color: white;">Admin Users</a>
         <a href="../admin/users_accounts.php" style="color: white;">Customers</a>
         <a href="../admin/messages.php" style="color: white;">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" style="color: white;"></div>
         <div id="user-btn" class="fas fa-user" style="color: white;"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         
         <p>Welcome <?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">update profile</a>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

</header>