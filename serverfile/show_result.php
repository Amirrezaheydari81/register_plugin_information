<?php
// مسیر فایل JSON
$json_file = './status.json';

// خواندن محتوای فایل JSON
if (file_exists($json_file)) {
    $json_data = json_decode(file_get_contents($json_file), true);
} else {
    $json_data = array();
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>نمایش وضعیت پلاگین</title>
    <link rel="stylesheet" href="https://cdn.clarotm.ir/bootstrap/bootstrap-5.0.2/css/bootstrap.min.css">
    <style>
    @font-face{
      font-family:iransansx;
      src: url("https://cdn.clarotm.ir/fonts/IRANSansX/IRANSansX-Regular.ttf");
    }
    *{
        font-family:iransansx !important;
    }
        body {
            direction: rtl;
        }
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-3">وضعیت پلاگین‌ها</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>آدرس سایت</th>
                    <th>وضعیت پلاگین</th>
                    <th>تاریخ و زمان</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($json_data)): ?>
                    <?php foreach ($json_data as $entry): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($entry['site_url'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo ($entry['plugin_status'] === 'activated' ? 'فعال' : 'غیرفعال'); ?></td>
                            <td><?php echo htmlspecialchars($entry['timestamp'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">هیچ داده‌ای موجود نیست</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
