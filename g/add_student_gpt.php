<?php
require 'connectdb.php'; // เชื่อมต่อฐานข้อมูล

// ถ้ามีการ submit ฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST['s_id'];
    $s_name = $_POST['s_name'];
    $s_address = $_POST['s_address'];
    $s_gpax = $_POST['s_gpax'];
    $f_id = $_POST['f_id'];

    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูล
    $sql = "INSERT INTO student (s_id, s_name, s_address, s_gpax, f_id)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $s_id, $s_name, $s_address, $s_gpax, $f_id);

    if ($stmt->execute()) {
        $success = "เพิ่มข้อมูลนิสิตสำเร็จแล้ว";
    } else {
        $error = "เกิดข้อผิดพลาด: " . $conn->error;
    }

    $stmt->close();
}

// ดึงข้อมูลคณะมาแสดงใน select
$faculties = [];
$result = $conn->query("SELECT f_id, f_name FROM faculty ORDER BY f_name ASC");
while ($row = $result->fetch_assoc()) {
    $faculties[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลนิสิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>เพิ่มข้อมูลนิสิต</h4>
        </div>
        <div class="card-body">

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="s_id" class="form-label">รหัสนิสิต</label>
                    <input type="text" class="form-control" id="s_id" name="s_id" required>
                </div>

                <div class="mb-3">
                    <label for="s_name" class="form-label">ชื่อนิสิต</label>
                    <input type="text" class="form-control" id="s_name" name="s_name" required>
                </div>

                <div class="mb-3">
                    <label for="s_address" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" id="s_address" name="s_address" rows="2" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="s_gpax" class="form-label">GPAX</label>
                    <input type="number" step="0.01" class="form-control" id="s_gpax" name="s_gpax" required>
                </div>

                <div class="mb-3">
                    <label for="f_id" class="form-label">คณะ</label>
                    <select class="form-select" id="f_id" name="f_id" required>
                        <option value="" disabled selected>-- เลือกคณะ --</option>
                        <?php foreach ($faculties as $faculty): ?>
                            <option value="<?= $faculty['f_id'] ?>"><?= htmlspecialchars($faculty['f_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">บันทึก</button>
                <a href="" class="btn btn-secondary">ล้างฟอร์ม</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
