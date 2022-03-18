<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>

<body>
    <div class="container">
        <div class="form-login">
            <form action="index.php?controller=HomeController&action=login" method="post">
                <div class="form-message">
                    <?php
                    if (!empty($_SESSION['errors']['login'])) {
                    ?>
                        <p class="text-danger"><?php echo $_SESSION['errors']['login'] ?></p>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email:
                    </label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-check">
                    <label for="remember"><input type="checkbox" name="remember" id="remember"> Ghi nhớ đăng nhập</label>
                </div>
                <div class="form-button">
                    <button class="btn btn-login" type="submit">Đăng nhập</button>
                </div>
                <div class="form-link"><a href="index.php?controller=HomeController&action=register">Đăng ký tài khoản</a></div>

            </form>
        </div>
    </div>

</body>

</html>