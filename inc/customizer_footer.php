<?php
/**
 * Customizer: Footer
 */

if (!function_exists('ebookgua_customize_footer')) {
    function ebookgua_customize_footer($wp_customize) {
        $DEFAULT_FOOTER = '© ' . date('Y') . ' | Powered by ebookgua';

        $wp_customize->add_section('footer_section', [
            'title' => __('Footer', 'ebookgua'),
            'priority' => 130,
        ]);

        $wp_customize->add_setting('footer_text', [
            'default' => $DEFAULT_FOOTER,
            'sanitize_callback' => 'wp_kses_post',
        ]);

        $wp_customize->add_control('footer_text', [
            'label' => __('Footer Text', 'ebookgua'),
            'section' => 'footer_section',
            'type' => 'textarea',
        ]);
    }
    add_action('customize_register', 'ebookgua_customize_footer');
}
