<?php
session_start();

 ?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Herber</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">

    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="page">
      <!-- Page Header-->
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
                    $cartlst = [];
                    foreach($cartlstAll as $item){
                      if($item["isPay"] == "N"){
                        array_push($cartlst, $item);
                      }
                    }
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
                      <form class="rd-search" action="#">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-search-form-input">Search...</label>
                          <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="search">
                          <button class="rd-search-form-submit fl-bigmug-line-search74" type="submit"></button>
                        </div>
                      </form>
                    </div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <?php
                      echo '
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php?id='.$_GET["id"].'">TRANG CHỦ</a>
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
                            <div class="unit-left"><i class="icon fa-solid fa-user"></i></div>
                            <?php
                            echo '
                            <div class="unit-body"><a class="link-phone" href="tel:#">'.$_SESSION["user_name"].'</a></div>
                            '
                             ?>
                          </div>
                        </li>
                        <li>
                          <div class="unit unit-spacing-sm">
                            <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                            <?php
                            echo '
                            <div class="unit-body"><a class="link-phone" href="tel:#">'.$_SESSION["phone_number"].'</a></div>
                            '
                             ?>
                          </div>
                        </li>
                        
                        <li>
                          <div class="unit unit-spacing-sm">
                            <div class="unit-left"><span class="icon fa fa-envelope"></span></div>
                            <?php
                            echo '
                            <div class="unit-body"><a class="link-email" href="mailto:#">'.$_SESSION["email"].'</a></div>
                            '
                             ?>
                          </div>
                        </li>
                      </ul>
                      <div class="oh button-wrap" ><a class="button button-primary button-ujarak slideInLeft animated" href="./app/Controller/Logout.php" data-caption-animate="slideInLeft" data-caption-delay="400" style="width:100%;">Đăng xuất</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      
      <div class="container mt-4">
        <p style="font-weight: 500; font-size: 50px;">Thông tin đơn hàng</p>
        
        <!-- Thông tin địa chỉ -->
        <div class="card mb-4">
    <div class="card-header">
        Thông tin địa chỉ
    </div>
    <div class="card-body">
        <form action="./app/Controller/Reservation.php" method="post">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" class="form-control " id="name"name="name" placeholder="Nhập họ và tên">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control " id="phone" name="phone" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <textarea class="form-control " id="address" rows="3" name="address" placeholder="Nhập địa chỉ" required></textarea>
            </div>

            
            <?php
            require_once "./db.conn.php";
            require_once "./app/Interface/IUsers.php";
            require_once "./app/Classes/Users.php";
            require_once "./app/Interface/IFood.php";
            require_once "./app/Classes/Food.php";
            require_once "./app/Interface/ICart.php";
            require_once "./app/Classes/Cart.php";
            require_once "./app/Interface/ICartDetails.php";
            require_once "./app/Classes/CartDetails.php";
            $user = new Users();
            $result = $user->GetUserById($_GET["id"])[0];
            echo '
            <script>
              document.getElementById("name").value = "'.$result["user_name"].'"
              document.getElementById("phone").value = "'.$result["phone_number"].'"
            </script>
            ';
             ?>
             
            <!-- Phương thức thanh toán -->
            <div class="card mt-4">
                <div class="card-header">
                    Phương thức thanh toán
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="payment-cash" name="payment-method">
                        <label class="form-check-label" for="payment-cash">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="payment-online" name="payment-method">
                        <label class="form-check-label" for="payment-online">Thanh toán trực tuyến</label>
                    </div>
                </div>
            </div>

            <!-- Tổng đơn hàng -->
            <div class="card mt-4">
                <div class="card-header">
                    Tổng đơn hàng
                </div>
                <div class="card-body">
                <ol class="list-group list-group-numbered list-ordered" style="text-align: center;">
                  <?php
                      $cart = new Cart();
                      $shopping_cart = $cart->getCartByID($_GET["id"])[0];
                      $cartDetails = new CartDetails();
                      $cartlstAll = $cartDetails->GetCartDetails($cart_id);
                    $cartlst = [];
                    foreach($cartlstAll as $item){
                      if($item["isPay"] == "N"){
                        array_push($cartlst, $item);
                      }
                    }
                      $sum = 0;
                      $numberFood = count($cartlst);
                      foreach($cartlst as $item){
                        $food = new Food();
                        $foodFind = $food->getById($item["food_id"])[0];
                        $sum = $sum + $foodFind["price_new"];
                          echo '
                          
                          <li class="list-group-item">'.$foodFind["food_name"].'</li>
                          ';
                      }
                   ?>
                    </ol>
                    <?php
                    echo '
                    <input type="text" class="form-check-input" id="total" name="total" value="'.$sum.'" style="display:none;">
                    <input type="text" class="form-check-input" id="total" name="number_of_food" value="'.$numberFood.'" style="display:none;">
                    <input type="text" class="form-check-input" id="cart_id" name="cart_id" value="'.$shopping_cart["cart_id"].'" style="display:none;">
                    <p>Tổng tiền: '.$sum.'</p>
                    '
                     ?>
                    <button type="submit" class="btn btn-primary">Xác nhận đơn hàng</button>
                </div>
            </div>
        </form>
    </div>
</div>


    </div>
      <!-- Page Footer-->
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
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
    <!-- coded by Ragnar-->
  </body>
</html>