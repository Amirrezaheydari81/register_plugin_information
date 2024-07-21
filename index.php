<?php
/**
 * Plugin Name: Register plugin information
 * Description: On which site is the plug-in information registration enabled
 * Version: 1.0
 * Author: Amirreza heydari
 */
function plugin_activation_status() {
    $site_url = get_site_url();

    $data = array(
        'site_url' => $site_url,
        'plugin_status' => 'activated'
    );

    $url = 'https://yoursite.com/submit-status.php'; // آدرس سرور شما

    $args = array(
        'body' => json_encode($data),
        'headers' => array(
            'Content-Type' => 'application/json'
        )
    );

    $response = wp_remote_post($url, $args);
}

register_activation_hook(__FILE__, 'plugin_activation_status');
?>
