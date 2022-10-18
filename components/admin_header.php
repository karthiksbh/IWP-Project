<header class="header">
   <section class="flex">
      <a href="../admin/products.php"><img src="../images/logo.png" alt="" height="40px"; style="margin: 0;"></a>
      <div class="icons">
         <div id="menu-btn" style="color:white;" class="fas fa-bars"></div>
         <div id="user-btn" style="color:white;" class="fas fa-user"></div>
      </div>
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>Welcome <?= $fetch_profile['name']; ?></p>
         <a href="../components/admin_logout.php" class="delete-btn" style="background-color: #FF6700;" onclick="return confirm('Logout From Website?');">logout</a> 
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