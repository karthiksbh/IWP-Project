<?php
include 'components/config.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Message already sent';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);
      $message[] = 'Message sent! Will get back to you soon :)';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Form </title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<section class="contact">
   <form action="" method="post">
      <h3>Enter Your Queries</h3>
      <input type="text" style="border: 3px solid black;" name="name" placeholder="Enter your Name" required maxlength="20" class="box">
      <input type="email" style="border: 3px solid black;" name="email" placeholder="Enter your Email" required maxlength="50" class="box">
      <input type="number" style="border: 3px solid black;" name="number" min="0" max="9999999999" placeholder="Enter your Number" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msg" style="border: 3px solid black;" class="box" placeholder="Enter your Message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" style="background-color: #FF6700;" class="btn">
   </form>
</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>