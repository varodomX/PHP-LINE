<?php
session_start();
// รับไฟล์รูปภาพที่อัปโหลด
    
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    $imagePath = $_FILES['image']['tmp_name'];

    // อัปโหลดรูปภาพไปยัง Line Notify
    $lineToken = 'jT9xYGroFm5n5yYVDufqVMWEgcgEP5PsqftxHyLrZpG';
    $message = "\n". $title ."\n"."\n" . $comment ;
    $imageData = file_get_contents($imagePath);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://notify-api.line.me/api/notify');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['message' => $message, 'imageFile' => new CURLFile($imagePath)]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $lineToken]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    // ตรวจสอบการส่ง Line Notify ว่าสำเร็จหรือไม่
    if ($result === false) {
        echo 'เกิดข้อผิดพลาดในการส่ง Line Notify';
    } else {
        $_SESSION['response'] = "สำเร็จ";
        $_SESSION['response'] = "ส่งข้อมูลสำเร็จ";
        header('Location: index.php');
    }
} else {
    echo 'เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ';
}
?>