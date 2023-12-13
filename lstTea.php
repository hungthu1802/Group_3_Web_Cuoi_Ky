<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="70px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand" href="index.html"><img src="images/logo-default-196x47.png" alt="" width="196" height="47"/></a></div>
                </div>
                <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Basket-->
                    <?php
                    require_once "./db.conn.php";
                    require_once "./app/Interface/ICartDetails.php";
                    require_once "./app/Classes/CartDetails.php";
                    require_once "./app/Interface/ICart.php";
                    require_once "./app/Classes/Cart.php";
                    require_once "./app/Interface/IFood.php";
                    require_once "./app/Classes/Food.php";
                    $cart = new Cart();
                    $cart_id= $cart->getCartByID($_GET["id"])[0]["cart_id"];
                    $cartDetails = new CartDetails();
                    $food = new Food();
                    $cartlstAll = $cartDetails->GetCartDetails($cart_id);
                    $cartDetails_id = [];
                    $cartlst = [];
                    foreach($cartlstAll as $item){
                      if($item["isPay"] == "N"){
                        array_push($cartlst, $item);
                        array_push($cartDetails_id,$item["cart_item_id"]);
                      }
                    }
                    $_SESSION["cart_item_id"] = $cartDetails_id;
                    $numberFood = count($cartlst);
                    $sum = 0;
                    foreach($cartlst as $item){
                      $food_id = $item["food_id"];
                      $foodFind = $food->getById($food_id)[0];
                      $sum = $foodFind["price_new"]+$sum;
                    }
                    ?>
                    <div class="rd-navbar-basket-wrap">
                      <button class="rd-navbar-basket fl-bigmug-line-shopping198" data-rd-navbar-toggle=".cart-inline"><?php 
                      echo '<span>'.$numberFood.'</span>';
                      ?></button>
                      <div class="cart-inline">
                        <div class="cart-inline-header">
                          <?php
                          echo '
                          <h5 class="cart-inline-title">Giỏ hàng:<span>'.$numberFood.'</span> món ăn</h5>
                          <h6 class="cart-inline-title">Tổng giá:<span>'.$sum.'</span></h6>
                          '
                           ?>
                        </div>
                        <div class="cart-inline-body">
                          
                          <?php
                          require_once "./app/Interface/IImage.php";
                          require_once "./app/Classes/Image.php";
                                $image = new Image();
                              $arr_id = [];
                              foreach($cartlst as $item){
                                array_push($arr_id, $item["food_id"]);
                              }
                              $arr_id = array_unique($arr_id);
                              foreach($arr_id as $item){
                              $numberKey=0;
                                foreach($cartlst as $cart){
                                    if($item == $cart["food_id"]){
                                      $numberKey++;
                                    }
                                }
                                $food_id = $item;
                                $foodFind = $food->getById($food_id)[0];
                                $imageFood = $image->getById($foodFind["food_id"])[0];
                                echo '
                              <div class="cart-inline-item">
                            <div class="unit align-items-center">
                              <div class="unit-left"><a class="cart-inline-figure" href="#"><img src="images/'.$imageFood["image_url"].'" alt="" style="width: 108px;, height:100px;"/></a></div>
                              <div class="unit-body">
                                <h6 class="cart-inline-name"><a href="#">'.$foodFind["food_name"].'</a></h6>
                                <div>
                                  <div class="group-xs group-inline-middle">
                                    <h6 class="cart-inline-title">'.$foodFind['price_new'].'</h6>
                                    <div class="table-cart-stepper" style="display:flex;">
                                    <a class="" style="padding:10px;background-color:#ccc;" href="./app/Controller/Cart.php?id='.$_GET["id"].'&delete=true&food_id='.$food_id.'">-</a>
                                    <span class"numberFood" style="padding:0 10px;display:flex; align-items:center;">'.$numberKey.'</span>
                                    <a style="padding:10px;background-color:#ccc;" href="./app/Controller/Cart.php?id='.$_GET["id"].'&create=true&food_id='.$food_id.'">+</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                              ';
                              }
                           ?>


                        </div>
                        <div class="cart-inline-footer">
                          <?php
                          if(count($cartlst)>0){
                            echo '
                          <div class="group-sm"><a class="button button-md button-primary button-pipaluk" href="Order.php?id='.$_GET["id"].'" style="width: 100%;">Checkout</a></div>
                          ';
                          }
                          else{
                            echo '
                          <div class="group-sm"><p class="button button-md button-primary button-pipaluk" style="width: 100%;" disable>Checkout</p></div>
                          ';
                          }
                           ?>
                        </div>
                      </div>
                    </div><a class="rd-navbar-basket rd-navbar-basket-mobile fl-bigmug-line-shopping198" href="#"><span>2</span></a>
                    <!-- RD Navbar Search-->
                    <div class="rd-navbar-search">
                      <button class="rd-navbar-search-toggle" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                      <form class="rd-search" action="./app/Controller/Search.php" method="post">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-search-form-input">Search...</label>
                          <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="search">
                          <input class="rd-navbar-search-form-input form-input" id="user_id" type="text" name="id" style="display: none;">
                          
                          <button class="rd-search-form-submit fl-bigmug-line-search74" type="submit"></button>
                        </div>
                      </form>
                      <?php

                          echo '
                          <script>
                            document.getElementById("user_id").value = "'.$_GET["id"].'"
                          </script>
                          '
                           ?>
                    </div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <?php
                      echo '
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php?id='.$_SESSION["user_id"].'">TRANG CHỦ</a>
                      </li>
                      '
                       ?>
                       <?php
                       echo '
                      <li class="rd-nav-item"><a class="rd-nav-link" href="index.php?id='.$_GET["id"].'#KM">KHUYẾN MÃI</a>
                       '
                        ?>
                      </li>
                      <?php
                      echo '
                      <li class="rd-nav-item"><a class="rd-nav-link" href="index.php?id='.$_GET["id"].'#SP">SẢN PHẨM</a>
                      '
                       ?>
                      </li>
                      <?php
                      echo '
                      <li class="rd-nav-item"><a class="rd-nav-link" href="lstSp.php?id='.$_GET["id"].'">ĐƠN HÀNG</a>
                      '
                       ?>
                      </li>
                    </ul>
                  </div>
                  <div class="rd-navbar-project-hamburger" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
                    <div class="project-hamburger"><span class="project-hamburger-arrow-top"></span><span class="project-hamburger-arrow-center"></span><span class="project-hamburger-arrow-bottom"></span></div>
                    <div class="project-hamburger-2"><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span>
                    </div>
                    <div class="project-close"><span></span><span></span></div>
                  </div>
                </div>
                <div class="rd-navbar-project rd-navbar-modern-project">
                  <div class="rd-navbar-project-modern-header">
                    <h4 class="rd-navbar-project-modern-title">Thông Tin Tài Khoản</h4>
                    <div class="rd-navbar-project-hamburger" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
                      <div class="project-close"><span></span><span></span></div>
                    </div>
                  </div>
                  <div class="rd-navbar-project-content rd-navbar-modern-project-content">
                    <div>
                      <ul class="rd-navbar-modern-contacts">
                        <li>
                          <div class="unit unit-spacing-sm">
                            <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                            <div class="unit-body"><a class="link-phone" href="tel:#">0365022208</a></div>
                          </div>
                        </li>
                        <li>
                          <div class="unit unit-spacing-sm">
                            <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                            <div class="unit-body"><a class="link-location" href="#">số nhà 14 ngõ 26, hồ tùng mậu</a></div>
                          </div>
                        </li>
                        <li>
                          <div class="unit unit-spacing-sm">
                            <div class="unit-left"><span class="icon fa fa-envelope"></span></div>
                            <div class="unit-body"><a class="link-email" href="mailto:#">thangthanhthat10a3@gmail.com</a></div>
                          </div>
                        </li>
                      </ul>
                      <div class="oh button-wrap" ><a class="button button-primary button-ujarak slideInLeft animated" href="about-us.html" data-caption-animate="slideInLeft" data-caption-delay="400" style="width:100%;">Đăng xuất</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
<section class="section section-md bg-default">
        <div class="container">
          <div class="row row-40">
          <div class="col-md-12  col-lg-12">
          <div class="row">
                <?php
                require_once "./db.conn.php";
                require_once "./app/Interface/IFood.php";
                require_once "./app/Classes/Food.php";
                require_once "./app/Interface/IPromotion.php";
                require_once "./app/Classes/Promotion.php";
                require_once "./app/Interface/IImage.php";
                require_once "./app/Classes/Image.php";
                $food = new Food();
                $image = new Image();
                $foods = $food->getByMenu($_GET["menu_id"]);    
                $numoffood = count($foods);   
                $numfoodinPage= 4;
                $totalPages = ceil($numoffood/$numfoodinPage);
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                $start = ($currentPage - 1)*$numfoodinPage;
                $end = $start + $numfoodinPage;

                for($i = $start; $i < $end; $i++){
                  if($i > $numoffood-1){
                    break;
                  }
                  $food = $foods[$i];
                $promotion = new Promotion();
                $km= $promotion->getPromotionById($food["promotion_id"]);
                $imageFood = $image->getById($food["food_id"])[0];
                  echo '
                  <div class="col-sm-6 col-md-3 mb-3">
                  <div class="oh-desktop">
                    <!-- Product-->
                    <article class="product product-2 box-ordered-item wow slideInRight" data-wow-delay="0s">
                      <div class="unit flex-row flex-lg-column">
                        <div class="unit-left">
                          <div class="product-figure"><img src="images/'.$imageFood["image_url"].'" alt="" style="width:270px; height:266px; background-image:center;"/>
                            <div class="product-button"><a class="button button-md button-white button-ujarak" href="./app/Controller/Cart.php?id='.$_GET["id"].'&food_id='.$food["food_id"].'&create=true">Add to cart</a></div>
                          </div>
                        </div>
                        <div class="unit-body">
                          <h6 class="product-title"><a href="#">'.$food["food_name"].'</a></h6>
                          <div class="product-price-wrap">
                          ';
                          if(count($km)> 0){
                            echo '
                          <div class="product-price product-price-old">'.$food["price"].'</div>
                            <div class="product-price">'.$food["price_new"].'</div> 
                            ';
                          }
                          else{
                            echo '
                          <div class="product-price">'.$food["price"].'</div>
                            ';
                          }
                    echo'             
                          </div><a class="button button-sm button-secondary button-ujarak" href="./app/Controller/Cart.php?id='.$_GET["id"].'&food_id='.$food["food_id"].'&create=true">Add to cart</a>
                          <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="index.php?id='.$_GET["id"].'#imageMA" data-caption-animate="slideInLeft" data-caption-delay="400">Xem ảnh</a></div>

                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                  ';
                }
                 ?>
                

              </div>
            </div>
          </div>
        </div>

        <?php

// Hàm để tạo URL với trang đã chọn
function getPageUrl($page) {
  $id = $_SESSION["user_id"];
    return '?id='.$id.'&page='.$page.'&menu_id='.$_GET["menu_id"].'';
}

// Hàm để tạo danh sách nút phân trang
function generatePagination($totalPages, $currentPage) {
    echo '<ul class="pagination justify-content-center" style="padding-top:40px">';
    
    // Nút "Previous"
    if ($currentPage > 1) {
        echo '<li class="page-item"><a class="page-link" href="' . getPageUrl($currentPage - 1) . '">Previous</a></li>';
    }

    // Danh sách nút phân trang
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item' . ($i == $currentPage ? ' active' : '') . '"><a class="page-link" href="' . getPageUrl($i) . '">' . $i . '</a></li>';
    }

    // Nút "Next"
    if ($currentPage < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="' . getPageUrl($currentPage + 1) . '">Next</a></li>';
    }

    echo '</ul>';
}

// Gọi hàm để tạo danh sách nút phân trang
generatePagination($totalPages, $currentPage);

?>

      </section>

      <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>

    <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-variant-2-content">
          <div class="container">
            <div class="row row-40 justify-content-between">
              <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="oh-desktop">
                  <div class="wow slideInRight" data-wow-delay="0s">
                    <div class="footer-brand"><a href="index.html"><img src="images/logo-inverse-196x42.png" alt="" width="196" height="42"/></a></div>
                    <p>Herber là một của hàng ẩm thực nằm ở Việt Nam. Chúng tôi cung cấp thực phẩm và sản phẩm tốt cho sức khỏe cho khách hàng.</p>
                    <ul class="footer-contacts d-inline-block d-md-block">
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                          <div class="unit-body"><a class="link-phone" href="tel:0365022208">+84 365022208</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-clock-o"></span></div>
                          <div class="unit-body">
                            <p>Mon-Sat: 07:00AM - 05:00PM</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                          <div class="unit-body"><a class="link-location" href="#">Số nhà 14, ngõ 26, Mai Dịch, Cầu Giấy, Hà Nội</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4 col-xl-4">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInDown" data-wow-delay="0s">
                    <h5>Newsletter</h5>
                    <p>Join our email newsletter for news and tips.</p>
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                      <div class="form-wrap">
                        <input class="form-input" id="subscribe-form-5-email" type="email" name="email" data-constraints="@Email @Required">
                        <label class="form-label" for="subscribe-form-5-email">Enter Your E-mail</label>
                      </div>
                      <button class="button button-block button-white" type="submit">Subscribe</button>
                    </form>
                    <div class="group-lg group-middle">
                      <p class="text-white">Follow Us</p>
                      <div>
                        <ul class="list-inline list-inline-sm footer-social-list-2">
                          <li><a class="icon fa fa-facebook" href="#"></a></li>
                          <li><a class="icon fa fa-twitter" href="#"></a></li>
                          <li><a class="icon fa fa-google-plus" href="#"></a></li>
                          <li><a class="icon fa fa-instagram" href="#"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xl-3">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInLeft" data-wow-delay="0s">
                    <h5>Gallery</h5>
                    <div class="row row-10 gutters-10" data-lightgallery="group">
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="./images/1.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="./images/1.jpg" data-lightgallery="item"><img src="images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/3.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-8-1200x800.jpg" data-lightgallery="item"><img src="images/2.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/2.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-9-800x1200.jpg" data-lightgallery="item"><img src="images/3.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/2.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-10-1200x800.jpg" data-lightgallery="item"><img src="images/2.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </footer>
        <div class="footer-variant-2-content">
          <div class="container">
            <div class="row row-40 justify-content-between">
              <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="oh-desktop">
                  <div class="wow slideInRight" data-wow-delay="0s">
                    <div class="footer-brand"><a href="index.html"><img src="images/logo-inverse-196x42.png" alt="" width="196" height="42"/></a></div>
                    <p>Herber is an organic farm located in California. We offer healthy foods and products to our clients.</p>
                    <ul class="footer-contacts d-inline-block d-md-block">
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                          <div class="unit-body"><a class="link-phone" href="tel:#">+1 323-913-4688</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-clock-o"></span></div>
                          <div class="unit-body">
                            <p>Mon-Sat: 07:00AM - 05:00PM</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                          <div class="unit-body"><a class="link-location" href="#">4730 Crystal Springs Dr, Los Angeles, CA 90027</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4 col-xl-4">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInDown" data-wow-delay="0s">
                    <h5>Newsletter</h5>
                    <p>Join our email newsletter for news and tips.</p>
                    <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                      <div class="form-wrap">
                        <input class="form-input" id="subscribe-form-5-email" type="email" name="email" data-constraints="@Email @Required">
                        <label class="form-label" for="subscribe-form-5-email">Enter Your E-mail</label>
                      </div>
                      <button class="button button-block button-white" type="submit">Subscribe</button>
                    </form>
                    <div class="group-lg group-middle">
                      <p class="text-white">Follow Us</p>
                      <div>
                        <ul class="list-inline list-inline-sm footer-social-list-2">
                          <li><a class="icon fa fa-facebook" href="#"></a></li>
                          <li><a class="icon fa fa-twitter" href="#"></a></li>
                          <li><a class="icon fa fa-google-plus" href="#"></a></li>
                          <li><a class="icon fa fa-instagram" href="#"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xl-3">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInLeft" data-wow-delay="0s">
                    <h5>Gallery</h5>
                    <div class="row row-10 gutters-10" data-lightgallery="group">
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-7-800x1200.jpg" data-lightgallery="item"><img src="images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/gallery-image-2-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-8-1200x800.jpg" data-lightgallery="item"><img src="images/gallery-image-2-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-9-800x1200.jpg" data-lightgallery="item"><img src="images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/gallery-image-4-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-10-1200x800.jpg" data-lightgallery="item"><img src="images/gallery-image-4-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </footer>
</body>
</html>