
<?php
$hoTen = '';
$chuyenCan = '';
$giuaKy = '';
$cuoiKy = '';

$diemTongKet = null;
$xepLoai = '';
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoTen = trim($_POST['hoTen'] ?? '');
    $chuyenCan = trim($_POST['chuyenCan'] ?? '');
    $giuaKy = trim($_POST['giuaKy'] ?? '');
    $cuoiKy = trim($_POST['cuoiKy'] ?? '');

    if ($hoTen === '') {
        $loi = 'Vui lòng nhập họ tên sinh viên.';
    } else {
        $cacDiem = [
            'Điểm chuyên cần' => $chuyenCan,
            'Điểm giữa kỳ' => $giuaKy,
            'Điểm cuối kỳ' => $cuoiKy
        ];

        foreach ($cacDiem as $tenDiem => $diem) {
            if ($diem === '' || !is_numeric($diem)) {
                $loi = $tenDiem . ' phải là một số hợp lệ.';
                break;
            }

            if ((float)$diem < 0 || (float)$diem > 10) {
                $loi = $tenDiem . ' phải nằm trong khoảng từ 0 đến 10.';
                break;
            }
        }
    }

    if ($loi === '') {
        $chuyenCan = (float)$chuyenCan;
        $giuaKy = (float)$giuaKy;
        $cuoiKy = (float)$cuoiKy;

        // Tính điểm tổng kết theo tỷ trọng
        $diemTongKet = $chuyenCan * 0.1
                     + $giuaKy * 0.3
                     + $cuoiKy * 0.6;

        // Xếp loại theo các ngưỡng điểm quy ước
        if ($diemTongKet >= 8) {
            $xepLoai = 'Giỏi';
        } elseif ($diemTongKet >= 6.5) {
            $xepLoai = 'Khá';
        } elseif ($diemTongKet >= 5) {
            $xepLoai = 'Trung bình';
        } else {
            $xepLoai = 'Chưa đạt';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy tính điểm học phần</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            color: #263238;
            background-color: #f2f7f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            color: #008f50;
            text-align: center;
            font-size: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #00a650;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #008f45;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            color: #b00020;
            background-color: #fff0f0;
            border-radius: 5px;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #eaf7ef;
            border-radius: 5px;
            line-height: 1.8;
        }

        @media (max-width: 480px) {
            .container {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Máy tính điểm học phần</h1>

        <form method="post">
            <label for="hoTen">Họ tên sinh viên</label>
            <input
                type="text"
                id="hoTen"
                name="hoTen"
                value="<?= htmlspecialchars($hoTen, ENT_QUOTES, 'UTF-8') ?>"
                required
            >

            <label for="chuyenCan">Điểm chuyên cần (10%)</label>
            <input
                type="number"
                id="chuyenCan"
                name="chuyenCan"
                min="0"
                max="10"
                step="any"
                value="<?= htmlspecialchars((string)$chuyenCan, ENT_QUOTES, 'UTF-8') ?>"
                required
            >

            <label for="giuaKy">Điểm giữa kỳ (30%)</label>
            <input
                type="number"
                id="giuaKy"
                name="giuaKy"
                min="0"
                max="10"
                step="any"
                value="<?= htmlspecialchars((string)$giuaKy, ENT_QUOTES, 'UTF-8') ?>"
                required
            >

            <label for="cuoiKy">Điểm cuối kỳ (60%)</label>
            <input
                type="number"
                id="cuoiKy"
                name="cuoiKy"
                min="0"
                max="10"
                step="any"
                value="<?= htmlspecialchars((string)$cuoiKy, ENT_QUOTES, 'UTF-8') ?>"
                required
            >

            <button type="submit">Tính điểm</button>
        </form>

        <?php if ($loi !== ''): ?>
            <div class="error">
                <?= htmlspecialchars($loi, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($diemTongKet !== null): ?>
            <div class="result">
                <h2>Kết quả học phần</h2>

                <p>
                    <strong>Họ tên:</strong>
                    <?= htmlspecialchars($hoTen, ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <strong>Điểm tổng kết:</strong>
                    <?= number_format($diemTongKet, 2) ?>
                </p>

                <p>
                    <strong>Xếp loại:</strong>
                    <?= htmlspecialchars($xepLoai, ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
