
<?php
$hoTen = "Bùi Mai Phương";
$nganhHoc = "Lập trình web";
$msv = "224001743"
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu bản thân</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background-color: #f2f7f5;
            color: #263238;
            line-height: 1.7;
        }

        .container {
            max-width: 750px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #176650;
        }

        h1 {
            text-align: center;
        }

        .project {
            margin: 15px 0;
            padding: 15px;
            border-left: 4px solid #176650;
            background-color: #f7faf9;
        }

        a {
            color: #176650;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Giới thiệu bản thân</h1>

        <h2>1. Thông tin cá nhân</h2>
        <p><strong>Họ và tên:</strong>
            <?php echo htmlspecialchars($hoTen); ?>
        </p>
        <p><strong>Mã sinh viên:</strong>
        <?php echo htmlspecialchars($msv);?>
</p>
        <p><strong>Học phần:</strong>
            <?php echo htmlspecialchars($nganhHoc); ?>
        </p>
</div>
</body>
</html>
