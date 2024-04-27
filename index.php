<?php
$messages = $_GET['m'];
// รับข้อความจากฟอร์มหรือจากข้อมูลอื่น ๆ
$message = $messages;

// ส่วนของ Token ที่ได้จากการสร้าง Notify Service ใน Line Notify
$token = "bW7Tk4qkc7994qSNJ6v1D8Hqs2Ko9WWZA8CHIcuT5z8";

// URL ของ API Line Notify
$url = "https://notify-api.line.me/api/notify";

// ข้อมูลที่จะส่งไปยัง Line Notify
$data = array('message' => $message);

// Header สำหรับของ Content-Type เป็น application/x-www-form-urlencoded
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n" .
                     "Authorization: Bearer " . $token . "\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

// สร้าง Context สำหรับการเชื่อมต่อ HTTP
$context  = stream_context_create($options);

// ทำการเรียกใช้งาน API Line Notify
$result = file_get_contents($url, false, $context);

// แสดงผลลัพธ์
if ($result === FALSE) {
    echo "เกิดข้อผิดพลาดในการส่งข้อความไปยัง Line Notify";
} else {
    echo "ส่งข้อความไปยัง Line Notify สำเร็จแล้ว";
}

?>
