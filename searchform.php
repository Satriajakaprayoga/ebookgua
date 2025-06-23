<form role="search" method="get" action="<?php echo esc_url(home_url('/')) ?>">
  <input type="hidden" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
  <div class="relative">
    <Input
      type="search"
      placeholder="<?php echo esc_attr( apply_filters( 'generate_search_placeholder', _x( 'Search &hellip;', 'placeholder', 'ebookgua' ) ) ); ?>"
      value="<?php echo get_search_query() ?>"
      name="s"
      title="<?php echo esc_attr( apply_filters( 'generate_search_label', _x( 'Search for:', 'label', 'ebookgua' ) ) ); ?>"
      class="w-full pl-4 pr-12 py-3 text-lg rounded-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-md" />
    <Button
      size="icon"
      type="submit"
      class="absolute right-2 top-1/2 transform -translate-y-1/2 rounded-full">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500 hover:text-blue-600" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor" fill-rule="evenodd" d="M10.44 2.75a7.69 7.69 0 1 0 4.615 13.842c.058.17.154.329.29.464l3.84 3.84a1.21 1.21 0 0 0 1.71-1.712l-3.84-3.84a1.2 1.2 0 0 0-.463-.289A7.69 7.69 0 0 0 10.44 2.75m-5.75 7.69a5.75 5.75 0 1 1 11.5 0a5.75 5.75 0 0 1-11.5 0" clip-rule="evenodd" />
      </svg>
    </Button>
  </div>
</form>