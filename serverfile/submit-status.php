<?php
// مسیر فایل JSON
$json_file = 'status.json';

// دریافت داده‌ها از درخواست
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $site_url = $data['site_url'];
    $plugin_status = $data['plugin_status'];

    // خواندن محتوای فایل JSON
    if (file_exists($json_file)) {
        $json_data = json_decode(file_get_contents($json_file), true);
    } else {
        $json_data = array();
    }

    // بررسی وجود سایت تکراری
    $site_exists = false;
    foreach ($json_data as $entry) {
        if ($entry['site_url'] == $site_url) {
            $site_exists = true;
            break;
        }
    }

    // اگر سایت تکراری نیست، اطلاعات جدید را اضافه کنید
    if (!$site_exists) {
        $new_entry = array(
            'site_url' => $site_url,
            'plugin_status' => $plugin_status,
            'timestamp' => date('Y')
        );
        $json_data[] = $new_entry;

        // نوشتن داده‌ها در فایل JSON
        if (file_put_contents($json_file, json_encode($json_data, JSON_PRETTY_PRINT))) {
            echo "New record created successfully";
        } else {
            echo "Error writing to JSON file";
        }
    } else {
        echo "Site already exists";
    }
}
?>