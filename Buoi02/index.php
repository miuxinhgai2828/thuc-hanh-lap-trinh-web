
<?php
function money($value) {
    return number_format($value, 0, ',', '.') . ' đ';
}

$name = '';
$qty = 0;
$price = 0;
$total = 0;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $qtyInput = $_POST['qty'] ?? '';
    $priceInput = $_POST['price'] ?? '';

    if ($name === '') {
        $error = 'Vui lòng nhập tên tài liệu.';
    } elseif (
        filter_var($qtyInput, FILTER_VALIDATE_INT) === false
        || (int)$qtyInput < 1
    ) {
        $error = 'Số lượng phải là số nguyên lớn hơn 0.';
    } elseif (
        !is_numeric($priceInput)
        || (float)$priceInput < 0
    ) {
        $error = 'Đơn giá phải là số không âm.';
    } else {
        $qty = (int)$qtyInput;
        $price = (float)$priceInput;
        $total = $qty * $price;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn học liệu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 35px;
            color: #222;
        }

        .container {
            max-width: 750px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        input {
            flex: 1 1 150px;
            min-width: 0;
            padding: 8px;
            font-size: 15px;
        }

        button {
            padding: 8px 16px;
            font-size: 15px;
            cursor: pointer;
        }

        .result {
            margin-top: 18px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post">
            <input
                type="text"
                name="name"
                placeholder="Tên tài liệu"
                value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
                required
            >

            <input
                type="number"
                name="qty"
                placeholder="Số lượng"
                min="1"
                step="1"
                value="<?= $qty > 0 ? $qty : '' ?>"
                required
            >

            <input
                type="number"
                name="price"
                placeholder="Đơn giá"
                min="0"
                step="any"
                value="<?= $price > 0 ? $price : '' ?>"
                required
            >

            <button type="submit">Tính</button>
        </form>

        <?php if ($error !== ''): ?>
            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="result">
                <p>
                    <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>:
                    <strong><?= money($total) ?></strong>
                </p>
            </div>
        <?php else: ?>
            <p class="result">Nhập thông tin tài liệu để tính thành tiền.</p>
        <?php endif; ?>
    </div>
</body>
</html>
