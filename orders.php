<?php
include 'components/config.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['bill'])){
   $order_id = $_POST['order_id'];
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
   $select_orders->execute([$order_id]);
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
         ob_end_clean();
         require('fpdf/fpdf.php');
         $pdf = new FPDF();
         $pdf->AddPage();
         $pdf->SetFont('Arial', 'B', 30);
         $pdf->MultiCell(1200,30,'                     Invoice Copy');
         $pdf->SetFont('Arial', 'B', 10);
         $pdf->MultiCell(1200,5,"Order Placed on: ".$fetch_orders['placed_on']);
         $pdf->MultiCell(1200,5,"Customer Name: ".$fetch_orders['name']);
         $pdf->MultiCell(1200,5,"Customer Mobile Number: ".$fetch_orders['number']);
         $pdf->MultiCell(1200,5,"Customer Address: ".$fetch_orders['address']);
         $pdf->MultiCell(1200,5,"\n\nProducts Purchased: ".$fetch_orders['total_products']);
         $pdf->MultiCell(1200,5,"\nTotal Price is: Rs.".$fetch_orders['total_price']);
         $pdf->MultiCell(1200,5,"Payment Method is: ".$fetch_orders['method']);
         $pdf->Output();
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<section class="orders">
   <h1 class="heading">Orders Placed</h1>
   <div class="box-container">
   <?php
      if($user_id == ''){
         echo '<p class="empty" style="margin: 0 auto;">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
      <div class="box">
         <p>Placed On : <span><?= $fetch_orders['placed_on']; ?></span></p>
         <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
         <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
         <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
         <p>Address : <span><?= $fetch_orders['address']; ?></span></p>
         <p>Payment Method : <span><?= $fetch_orders['method']; ?></span></p>
         <p>Your Orders : <span><?= $fetch_orders['total_products']; ?></span></p>
         <p>Total Price : <span>₹<?= $fetch_orders['total_price']; ?>/-</span></p>
         <p> Order Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
         <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <input type="submit" value="Download Bill" class="option-btn" name="bill"><br>
         </form>
      </div>
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>
   </div>
</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>