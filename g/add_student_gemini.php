<?php
// ไฟล์นี้จะเชื่อมต่อกับฐานข้อมูลโดยใช้ไฟล์ connectdb.php
// โปรดตรวจสอบให้แน่ใจว่าไฟล์ connectdb.php อยู่ในไดเรกทอรีเดียวกันและสามารถใช้งานได้
include_once 'connectdb.php';

$message = '';

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s_id = $_POST['s_id'];
    $s_name = $_POST['s_name'];
    $s_address = $_POST['s_address'];
    $s_gpax = $_POST['s_gpax'];
    $f_id = $_POST['f_id'];

    // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("INSERT INTO student (s_id, s_name, s_address, s_gpax, f_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssid", $s_id, $s_name, $s_address, $s_gpax, $f_id);

    if ($stmt->execute()) {
        $message = "บันทึกข้อมูลนิสิตสำเร็จ!";
    } else {
        $message = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->error;
    }

    $stmt->close();
}

// ดึงข้อมูลคณะจากฐานข้อมูลเพื่อนำไปแสดงใน dropdown
$faculties = [];
$result = $conn->query("SELECT f_id, f_name FROM faculty ORDER BY f_name ASC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $faculties[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มเพิ่มข้อมูลนิสิต</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">ฟอร์มเพิ่มข้อมูลนิสิต</h2>
        
        <?php if ($message): ?>
            <div class="alert alert-<?php echo strpos($message, 'สำเร็จ') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="mb-3">
                <label for="s_id" class="form-label">รหัสนิสิต</label>
                <input type="text" class="form-control" id="s_id" name="s_id" required pattern="\d{11}" title="กรุณากรอกรหัสนิสิต 11 หลัก">
            </div>
            <div class="mb-3">
                <label for="s_name" class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" class="form-control" id="s_name" name="s_name" required>
            </div>
            <div class="mb-3">
                <label for="s_address" class="form-label">ที่อยู่</label>
                <textarea class="form-control" id="s_address" name="s_address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="s_gpax" class="form-label">เกรดเฉลี่ย (GPAX)</label>
                <input type="number" step="0.01" min="0.00" max="4.00" class="form-control" id="s_gpax" name="s_gpax" required>
            </div>
            <div class="mb-3">
                <label for="f_id" class="form-label">คณะ</label>
                <select class="form-select" id="f_id" name="f_id" required>
                    <option value="" selected disabled>เลือกคณะ</option>
                    <?php foreach ($faculties as $faculty): ?>
                        <option value="<?php echo htmlspecialchars($faculty['f_id']); ?>">
                            <?php echo htmlspecialchars($faculty['f_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>
            <button type="submit" class="btn btn-primary w-100">บันทึกข้อมูล</button>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
