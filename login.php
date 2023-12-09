<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Herber</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
<h2>Đăng nhập/Đăng ký</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="./app/Controller/Signup.php" method="post">
                <h1>Đăng ký</h1>
                <input type="text" name="user_name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <input type="number" name="phone_number" placeholder="Phone number" />
                <button>Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="./app/Controller/Login.php" method="post">
                <h1>Đăng nhập</h1>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password" />
                <a href="#">Quên mật khẩu?</a>
                <button>Đăng nhập</button>
                <a href="./admin/Login.php?isAdmin=true">Đăng nhập tài khoản admin</a>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng <br> trở lại!</h1>
                    <p>Để duy trì kết nối với chúng tôi vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
</body>
</html>