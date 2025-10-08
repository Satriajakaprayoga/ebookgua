<?php
$comment_args = [
    'class_form' => 'space-y-4',
    'title_reply' => '<span class="text-xl font-bold">Tinggalkan komentar</span>',
    'comment_field' => '
        <textarea id="comment" name="comment" rows="6" required
            class="w-full p-3 border rounded bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Tulis komentar Anda di sini..."></textarea>',
    'fields' => [
        'author' => '
            <input id="author" name="author" type="text"
                class="w-full p-3 border rounded bg-gray-50 focus:outline-none"
                placeholder="Nama *" required />',
        'email' => '
            <input id="email" name="email" type="email"
                class="w-full p-3 border rounded bg-gray-50 focus:outline-none"
                placeholder="Surel *" required />',
        'url' => '
            <input id="url" name="url" type="url"
                class="w-full p-3 border rounded bg-gray-50 focus:outline-none"
                placeholder="Situs web" />',
        'cookies' => '
            <p class="text-sm">
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="wp-comment-cookies-consent" value="yes"
                        class="mr-2" />
                    Simpan nama, email, dan situs web saya pada peramban ini untuk komentar saya berikutnya.
                </label>
            </p>',
    ],
    'submit_button' => '<button type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Kirim Komentar</button>',
    'submit_field' => '<p class="form-submit">%1$s %2$s</p>',
];

comment_form($comment_args);
?>

<?php if (have_comments()) { ?>
    <div class="mt-10 border-t pt-6">
        <h2 class="text-xl font-semibold mb-4">
            <?php echo get_comments_number().' Komentar'; ?>
        </h2>

        <ul class="space-y-6">
            <?php
            wp_list_comments([
                'style' => 'ul',
                'avatar_size' => 48,
                'short_ping' => true,
                'callback' => function ($comment, $args, $depth) {
                    ?>
                    <li <?php comment_class('border rounded-lg p-4'); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full']); ?>
                            </div>
                            <div>
                                <p class="font-semibold"><?php comment_author(); ?></p>
                                <p class="text-sm text-gray-500"><?php comment_date(); ?> at <?php comment_time(); ?></p>
                                <div class="mt-2 text-gray-800">
                                    <?php comment_text(); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                },
            ]);
    ?>
        </ul>
    </div>
<?php } ?>
