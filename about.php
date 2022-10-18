<?php

include 'components/config.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">
   <div class="row">
      <div class="image">
         <img src="images/aboutimg.jpg" style="margin:-10%;" alt="">
      </div>
      <div class="content" style="padding:30px;">
         <h3>Xiaomi Corporation</h3>
         <p style="font-weight: 500;">Xiaomi Corporation, commonly known as Xiaomi and registered as Xiaomi Inc., is a Chinese designer and manufacturer of consumer electronics and related software, home appliances, and household items. Behind Samsung, it is the second largest manufacturer of smartphones in the world, most of which run the MIUI operating system. The company is ranked 338th and is the youngest company on the Fortune Global 500.
         <br>
         <p style="font-weight: 500;">Xiaomi was founded in 2010 in Beijing by now multi-billionaire Lei Jun when he was 40 years old, along with six senior associates. Lei had founded Kingsoft as well as Joyo.com, which he sold to Amazon for $75 million in 2004. In August 2011, Xiaomi released its first smartphone and, by 2014, it had the largest market share of smartphones sold in China. Initially the company only sold its products online; however, it later opened brick and mortar stores. By 2015, it was developing a wide range of consumer electronics.</p>
      </div>
   </div>
</section>

<section class="reviews">
   <h1 class="heading">Customer Reviews</h1>
   <div class="swiper reviews-slider">
   <div class="swiper-wrapper">
      <div class="swiper-slide slide">
         <img src="images/pic-1.png" alt="">
         <p>This is a good, high-quality and cheap technique. I use smart sockets, light bulbs and vacuum cleaners from this company. During the operation for the device, it only shows positive emotions.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sritam Mishra</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-5.png" alt="">
         <p>Super phone Poco X3 now 2 years in use and very happy with it. dropped it so many times and its still working without any cracks in screen. Can compete with competitors where you pay 600-700 euros for a similar device.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Karthik Srinivas</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>I'm using the K20 Pro from Mi and I think this is one of the best android phones I've ever purchased. Phone with a full-screen display. The thing I love most about this phone is its pop front camera which has sound and light effects. </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Kunal Vijay</h3>
      </div>
    
   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>