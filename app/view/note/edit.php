<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viết note</title>
    <link rel="stylesheet" href="./public/css/note-create.css">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class=" user pull-right">
                <span>Chào <span class="user-name"><?php echo $_SESSION['user']->name; ?></span></span>
                <a href="index.php?controller=HomeController&action=logout" class="btn btn-logout">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <a href="index.php?controller=NoteController&action=index" class="btn btn-back">&leftarrow; Trở về</a>
            <span id="success-alert" class="pull-right">

            </span>
            <h1>Chỉnh sửa ghi chú</h1>
            <div class="note-info">
                <p>Ngày tạo: <?php echo $note->created_at ?></p>
                <p>Sửa lần cuối: <?php echo $note->updated_at ?></p>
            </div>

            <div class="form-create">
                <form action="index.php?controller=NoteController&action=update" method="post">
                    <input type="hidden" name="id" value="<?php echo $note->id ?>">
                    <div class="form-group">
                        <?php if (!empty($_SESSION['errors']['title'])) { ?>
                            <p class="text-danger"><?php echo $_SESSION['errors']['title'] ?></p>
                        <?php
                        }
                        ?>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Tiêu đề ghi chú (tối đa 50 ký tự)..." value="<?php echo $_SESSION['old']['title'] ?? $note->title ?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"><?php echo $_SESSION['old']['content'] ?? $note->content ?></textarea>
                    </div>
                    <button class="btn btn-save" type="submit">Lưu</button>
                    <a class="btn btn-delete pull-right" href="index.php?controller=NoteController&action=delete&id=<?php echo $note->id ?>">Xóa</a>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">

        </div>
    </div>
    <?php
    if (!empty($_SESSION['success']['update'])) {
    ?>
        <script>
            var alert = document.getElementById("success-alert");
            alert.innerHTML = '<?php echo $_SESSION['success']['update'] ?>'
            alert.classList.add('show')
            setTimeout(() => {
                alert.classList.remove('show')
            }, 2000)
        </script>
    <?php
    }
    ?>
</body>

</html>