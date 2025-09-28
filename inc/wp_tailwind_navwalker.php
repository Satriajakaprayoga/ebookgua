<?php
class Tailwind_Navwalker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-lg hidden group-hover:block z-50\">\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $is_dropdown = in_array('menu-item-has-children', $classes);

        $class_names = join( ' ', array_filter( $classes ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = ' id="menu-item-' . $item->ID . '"';

        // Set li class
        $li_classes = 'relative';
        if ( $is_dropdown ) $li_classes .= ' group';

        $output .= $indent . '<li' . $id . ' class="' . esc_attr( $li_classes ) . '">';

        // Link attributes
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $link_classes = 'block px-4 py-2 text-gray-700 dark:text-gray-200 hover:text-blue-600';
        if ( $depth > 0 ) {
            $link_classes .= ' hover:bg-blue-100 dark:hover:bg-gray-700';
        }

        $atts['class'] = $link_classes;

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output  = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}
?>
