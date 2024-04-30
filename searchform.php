<svg style="position:absolute;height:0;width:0;" aria-hidden="true" aria-focusable="false">
    <defs>
        <symbol id="search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 18 18">
            <defs><path id="a" d="M0 0h18v18H0z"/></defs>
            <clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath>
            <path clip-path="url(#b)" d="M6.363 2.32a3.894 3.894 0 0 0-2.796 1.083.498.498 0 1 0 .688.72 2.925 2.925 0 0 1 4.13.095.495.495 0 0 0 .704.016.499.499 0 0 0 .017-.705A3.898 3.898 0 0 0 6.363 2.32"/><path clip-path="url(#b)" d="M13.356 11.916c-.192-.192-.527-.185-.82-.003l-1.807-1.807c.369-.46.836-1.137 1.059-1.687a6.084 6.084 0 0 0 .448-2.302 6.084 6.084 0 0 0-1.792-4.326A6.086 6.086 0 0 0 8.42.448 6.08 6.08 0 0 0 6.118 0a6.084 6.084 0 0 0-4.326 1.792A6.104 6.104 0 0 0 0 6.118a6.104 6.104 0 0 0 1.792 4.326 6.083 6.083 0 0 0 4.326 1.792 6.1 6.1 0 0 0 2.302-.448c.55-.223 1.227-.689 1.688-1.059l1.806 1.807c-.181.293-.189.627.003.819l4.297 4.537c.238.239.815.049 1.142-.277l.262-.262c.325-.325.516-.902.276-1.141l-4.538-4.296zM9.485 9.485c-.899.899-2.095 1.396-3.367 1.396S3.65 10.385 2.75 9.485a4.767 4.767 0 0 1 0-6.735c.899-.9 2.096-1.395 3.368-1.395s2.468.496 3.367 1.395a4.729 4.729 0 0 1 1.396 3.368 4.724 4.724 0 0 1-1.396 3.367"/>
        </symbol>
    </defs>
</svg>
<form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="header__search" autocomplete="off">
    <input type="text" name="s" id="s" class="header__search__input" placeholder="Waar bent u naar op zoek?" value="<?php the_search_query() ?>">
    <button aria-label="Zoeken" class="header__search__submit">
        <svg><use xlink:href="#search"></use></svg>
    </button>
</form>