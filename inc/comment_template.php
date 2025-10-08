<?php
/**
 * Custom comment callback for wp_list_comments
 */
if (! function_exists('ebookgua_comment_template')) {
    function ebookgua_comment_template($comment, $args, $depth)
    {
        $tag = ($args['style'] === 'div') ? 'div' : 'li'; ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('border border-gray-200 rounded-lg p-4'); ?>>
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full']); ?>
                </div>
                <div class="flex-1">
                    <div class="mb-1">
                        <strong class="text-sm text-gray-900"><?php comment_author(); ?></strong>
                        <span class="text-xs text-gray-500 ml-2"><?php comment_date(); ?></span>
                    </div>
                    <div class="text-sm text-gray-700">
                        <?php comment_text(); ?>
                    </div>
                    <div class="mt-2">
                        <?php
                        comment_reply_link(array_merge($args, [
                            'reply_text' => 'Balas',
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'class' => 'text-xs text-blue-600 hover:underline',
                        ])); ?>
                    </div>
                </div>
            </div>
        </<?php echo $tag; ?>>
        <?php
    }
}
