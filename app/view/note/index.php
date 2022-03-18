<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viết note</title>
    <link rel="stylesheet" href="./public/css/note-index.css">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="user pull-right">
                <div>
                <span>Chào <span class="user-name"><?php echo $_SESSION['user']->name; ?></span></span>
                <a href="index.php?controller=HomeController&action=logout" class="btn btn-logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="note-list">
                <h1>Danh sách ghi chú</h1>
                <div class="note-control">
                    <a href="index.php?controller=NoteController&action=create" class="btn btn-add">&plus; Thêm ghi chú</a>
                </div>
                <table>
                    <?php foreach ($notes as $note) { ?>
                        <tr>
                            <td class="note-title">
                                <a href="index.php?controller=NoteController&action=edit&id=<?php echo $note->id; ?>"><?php echo $note->title; ?></a>
                            </td>
                            <td class="note-content">
                                <?php
                                if (strlen($note->content) < 256) {
                                    echo $note->content;
                                } else {
                                    echo substr($note->content, 0, 255) . "...";
                                }
                                ?>
                            </td>
                            <td class="note-info">
                                <p>Ngày tạo: <?php echo $note->created_at; ?></p>
                                <p>Lần sửa gần nhất: <?php echo $note->updated_at; ?></p>
                            </td>
                            <td>
                                <a class="btn btn-delete" href="index.php?controller=NoteController&action=delete&id=<?php echo $note->id ?>">&times;</a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">

        </div>
    </div>

</body>

</html>