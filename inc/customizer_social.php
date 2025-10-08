<?php
/**
 * Customizer: Social media settings
 */

if (!function_exists('ebookgua_customize_register')) {
    function ebookgua_customize_register($wp_customize) {
        $wp_customize->add_section('ebookgua_social_media', [
            'title' => __('Social Media', 'ebookgua'),
            'priority' => 160,
        ]);

        $socials = [
            'facebook'  => ['label' => 'facebook',  'color' => '#1877F2', 'icon' => 'fab fa-facebook-f'],
            'twitter'   => ['label' => 'Twitter',   'color' => '#1DA1F2', 'icon' => 'fab fa-twitter'],
            'instagram' => ['label' => 'Instagram', 'color' => '#C13584', 'icon' => 'fab fa-instagram'],
            'linkedin'  => ['label' => 'LinkedIn',  'color' => '#0A66C2', 'icon' => 'fab fa-linkedin-in'],
            'youtube'   => ['label' => 'YouTube',   'color' => '#FF0000', 'icon' => 'fab fa-youtube'],
        ];

        foreach ($socials as $key => $data) {
            $wp_customize->add_setting("ebookgua_social_{$key}", [
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ]);
            $wp_customize->add_control("ebookgua_social_{$key}", [
                'label' => $data['label'] . ' URL',
                'section' => 'ebookgua_social_media',
                'type' => 'url',
            ]);

            $wp_customize->add_setting("ebookgua_social_{$key}_colors", [
                'default' => $data['color'],
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            ]);
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "ebookgua_social_{$key}_colors", [
                'label' => $data['color'] . ' Color',
                'section' => 'ebookgua_social_media',
            ]));
        }
    }
    add_action('customize_register', 'ebookgua_customize_register');
}
