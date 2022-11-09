<?php

include '../components/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $order_status = $_POST['order_status'];
   $order_status = filter_var($order_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET order_status = ? WHERE id = ?");
   $update_payment->execute([$order_status, $order_id]);
   $message[] = 'Order Status Updated Successfully!';
}

if(isset($_POST['bill'])){
   $order_id = $_POST['order_id'];
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
   $select_orders->execute([$order_id]);
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
         ob_end_clean();
         require('../fpdf/fpdf.php');
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

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">placed orders</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Order Placed On: <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Customer Name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Customer Ph.No. : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Customer Address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Products Purchased : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Total Price: <span>₹<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> Payment Method: <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="order_status" class="select">
            <option selected disabled><?= $fetch_orders['order_status']; ?></option>
            <option value="Ordered">Ordered</option>
            <option value="Dispatched">Dispatched</option>
            <option value="Out for Delivery">Out for Delivery</option>
            <option value="Delivered">Delivered</option>
            <option value="Cancelled">Cancelled</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Do you want to delete the order?');">delete</a>
        </div>
        <input type="submit" value="Download Bill" class="option-btn" name="bill"><br>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
   ?>

</div>

</section>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>