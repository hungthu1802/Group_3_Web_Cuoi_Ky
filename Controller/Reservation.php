<?php
session_start();
    const Confirm = "C";//Đang chờ xác nhận
    const Delivery = "D";//Đang giao hàng
    const Receive = "R";//Đã nhận
    require_once "../../db.conn.php";
    require_once "../Interface/IReservation.php";
    require_once "../Classes/Reservations.php";
    require_once "../Interface/IContact.php";
    require_once "../Classes/Contact.php";
    require_once "../Interface/ICartDetails.php";
    require_once "../Classes/CartDetails.php";
    require_once "../Interface/IHistory.php";
    require_once "../Classes/History.php";
    $user_id = $_SESSION["user_id"];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_name = $_POST["name"];
        $phone_number = $_POST["phone"];
        $address = $_POST["address"];
        $order_date = date('Y-m-d');
        $order_time= date('Y-m-d', strtotime($order_date . ' +3 days'));
        $num_of_food = $_POST["number_of_food"];
        $order_status = Confirm;
        $cart_id = $_POST["cart_id"];
        $total = $_POST["total"];

        $contact= new Contact();
        $contact->setContact($user_id, $phone_number,$address);
        $reservation = new Reservations();
        $reservation->add($user_id, $order_date, $order_time,$num_of_food,$order_status,$cart_id,$total);
        $reservation_id = $reservation->getNewRe()[0]["reservation_id"];
        $cartDeatils = new CartDetails();
        $history = new History();
        $cartlst = $_SESSION["cart_item_id"];
        foreach($cartlst as $item){
            $history->Create($reservation_id, $item);
            $cartDeatils->Update($item, "Y", $reservation_id);
        }
        header("Location: ../../lstSp.php?id=$user_id");
    }
    if(isset($_GET["reservation_id"])&& isset($_GET["delete"])){
        $reservation = new Reservations();
        $reservation_id = $_GET["reservation_id"];
        $cart_id = $reservation->getById($user_id)[0]["cart_id"];
        $reservation->delete($reservation_id);
        $cartDeatils = new CartDetails();
        $history = new History();
        $cartlst =$history->getByID($reservation_id);
        foreach($cartlst as $item){
            $cartDeatils->UpdateState($item["cart_item_id"], "N", $reservation_id);
        }
        header("Location: ../../lstSp.php?id=$user_id");
    }
    if(isset($_GET["reservation_id"])&& isset($_GET["confirm"])){
        $reservation = new Reservations();
        $reservation_id = $_GET["reservation_id"];
        $cart_id = $reservation->getById($user_id)[0]["cart_id"];
        $reservation->upDateState($reservation_id,"D");
        header("Location: ../../admin/Order.php?id=$user_id");
    }
    if(isset($_GET["reservation_id"])&& isset($_GET["receive"])){
        $reservation = new Reservations();
        $reservation_id = $_GET["reservation_id"];
        $cart_id = $reservation->getById($user_id)[0]["cart_id"];
        $reservation->upDateState($reservation_id,"R");
        header("Location: ../../lstSp.php?id=$user_id");
    }

 ?>