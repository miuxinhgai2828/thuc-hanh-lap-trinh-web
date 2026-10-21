
<?php
// 1. Tạo mảng gồm 3 sinh viên
$students = [
    [
        'name' => 'Nguyễn Văn An',
        'midterm' => 7,
        'final' => 8
    ],
    [
        'name' => 'Trần Thị Bình',
        'midterm' => 4,
        'final' => 5
    ],
    [
        'name' => 'Lê Minh Cường',
        'midterm' => 6,
        'final' => 7
    ]
];

// 2. Hàm tính điểm trung bình
function calculateAverage($midterm, $final) {
    return ($midterm + $final) / 2;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm 3 sinh viên</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #263238;
        }

        h2 {
            color: #008f50;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #00b050;
            color: white;
        }

        td:nth-child(2) {
            text-align: left;
        }

        .pass {
            color: green;
            font-weight: bold;
        }

        .fail {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Bảng điểm 3 sinh viên</h2>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Điểm giữa kỳ</th>
                <th>Điểm cuối kỳ</th>
                <th>Điểm trung bình</th>
                <th>Kết quả</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($students as $index => $student): ?>
                <?php
                $average = calculateAverage(
                    $student['midterm'],
                    $student['final']
                );

                $result = $average >= 5 ? 'Đạt' : 'Chưa đạt';
                ?>

                <tr>
                    <td><?= $index + 1 ?></td>

                    <td>
                        <?= htmlspecialchars(
                            $student['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </td>

                    <td><?= $student['midterm'] ?></td>
                    <td><?= $student['final'] ?></td>
                    <td><?= number_format($average, 2) ?></td>

                    <td class="<?= $average >= 5 ? 'pass' : 'fail' ?>">
                        <?= $result ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
