<?php
/**
 * GitHub-based theme update checker
 */

if (!function_exists('ebookgua_check_update')) {
    function ebookgua_check_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $remote_url = 'https://raw.githubusercontent.com/Satriajakaprayoga/ebookgua/main/style.css';
        $response = wp_remote_get($remote_url);

        if (!is_wp_error($response) && isset($response['response']['code']) && $response['response']['code'] == 200) {
            $remote_style = wp_remote_retrieve_body($response);
            if (preg_match('/Version:\s*(.*)/i', $remote_style, $matches)) {
                $remote_version = trim($matches[1]);
                $current_version = wp_get_theme()->get('Version');
                if (version_compare($remote_version, $current_version, '>')) {
                    $transient->response['ebookgua'] = [
                        'theme'       => 'ebookgua',
                        'new_version' => $remote_version,
                        'url'         => 'https://github.com/Satriajakaprayoga/ebookgua',
                        'package'     => 'https://github.com/Satriajakaprayoga/ebookgua/archive/refs/heads/main.zip',
                    ];
                }
            }
        }
        return $transient;
    }
    add_filter('pre_set_site_transient_update_themes', 'ebookgua_check_update');
}
