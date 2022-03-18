<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - note</title>
    <link rel="stylesheet" href="./public/css/register.css">
</head>

<body>

    <div class="container">
        <div class="form-register">
            <form action="index.php?controller=UserController&action=store" method="post">
                <div class="form-group">
                    <label for="name">Họ tên: </label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $_SESSION['old']['name']??"" ?>">
                    <?php
                    if(!empty($_SESSION['errors']['name'])){
                    ?>
                        <p class="text-danger">
                            <?php echo $_SESSION['errors']['name']; ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['old']['email']??"" ?>">
                    <?php
                    if(!empty($_SESSION['errors']['email'])){
                    ?>
                        <p class="text-danger">
                            <?php echo $_SESSION['errors']['email']; ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input onkeypress="return event.keyCode != 32" class="form-control" type="password" name="password" id="password" value="<?php echo $_SESSION['old']['password']??"" ?>">
                    <?php
                    if(!empty($_SESSION['errors']['password'])){
                    ?>
                        <p class="text-danger">
                            <?php echo $_SESSION['errors']['password']; ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="retype_password">Xác nhận mật khẩu:</label>
                    <input onkeypress="return event.keyCode != 32" class="form-control" type="password" name="retype_password" id="retype_password">
                </div>
                <div class="form-button">
                <button class="btn btn-register" type="submit">Đăng ký</button>
                </div>
                <div class="form-link">
                    <a href="index.php">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>