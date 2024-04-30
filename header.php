<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); wp_title('|'); ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#007a3d">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css">
    <meta name="msapplication-TileColor" content="#007a3d">
    <meta name="theme-color" content="#ffffff">


    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800&display=swap" rel="stylesheet"> -->
	<link href="https://www.abemec.nl/wp-content/themes/abemec/assets/css/flexslider.css" rel="stylesheet">
	<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
	</style>
    <?php wp_head(); ?>
</head>
<body>

<svg style="position:absolute;height:0;width:0;" aria-hidden="true" aria-focusable="false">
    <defs>
        <symbol id="logo-white" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 242 43">
            <path fill="#FFFFFF" d="M23.259 9.7l7.833 17.958H15.426L23.259 9.7zM18.92.843L0 43.023h8.617l3.615-7.955h22.054l3.555 7.955h8.676L27.597.843H18.92zM50.896.988h18.845c4.84 0 8.502 1.241 10.983 3.721 1.88 1.881 2.821 4.201 2.821 6.962v.12c0 1.281-.171 2.411-.511 3.391-.34.981-.78 1.841-1.32 2.581a9.342 9.342 0 0 1-1.92 1.951c-.742.56-1.491 1.04-2.251 1.44 1.24.441 2.37.951 3.391 1.53 1.02.581 1.9 1.271 2.64 2.071.741.8 1.31 1.741 1.711 2.821.4 1.08.6 2.34.6 3.78v.12c0 1.882-.37 3.541-1.11 4.982a9.912 9.912 0 0 1-3.151 3.6c-1.361.961-3.001 1.691-4.921 2.191-1.921.5-4.042.75-6.362.75H50.896V.988zm25.266 11.883c0-1.68-.63-2.99-1.89-3.93C73.012 8 71.181 7.53 68.78 7.53H58.158v11.164H68.24c2.401 0 4.321-.471 5.762-1.411 1.44-.94 2.16-2.371 2.16-4.291v-.121zm2.341 17.705c0-1.8-.71-3.189-2.131-4.17-1.42-.98-3.591-1.471-6.512-1.471H58.158v11.523h12.243c2.521 0 4.501-.48 5.942-1.441 1.44-.96 2.16-2.4 2.16-4.321v-.12zM199.389 43.023h-31.574V.843h31.574v7.714h-23.681v9.701h22.837v7.411h-22.837v9.521h23.681zM122.824 43.023H91.25V.843h31.574v7.714H99.143v9.701h22.838v7.411H99.143v9.521h23.681zM242.713 37.72c-4.338 4.277-9.942 6.267-16.027 6.267-15.666 0-22.295-10.786-22.354-21.752C204.27 11.207 211.441 0 226.686 0c5.725 0 11.146 2.169 15.485 6.447l-5.302 5.122c-2.772-2.711-6.509-3.977-10.184-3.977-10.183 0-14.582 7.592-14.521 14.642.061 6.99 4.097 14.28 14.521 14.28 3.675 0 7.834-1.506 10.605-4.277l5.423 5.483z"/>
            <path fill="#FFE100" d="M131.12 43.083v-30.67l14.4 18.378 14.341-18.318v30.61z"/>
            <path fill="#FFFFFF" d="M132.325.904l13.195 18.137L158.717.904z"/>
        </symbol>
        <symbol id="chevron" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 26 18">
            <path d="M0 0l13.196 18.138L26.393 0z"/>
        </symbol>
        <symbol id="arrow" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 26 18">
            <path d="M0 0l13.196 18.138L26.393 0z"/>
        </symbol>
        <symbol id="search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 18 18">
            <defs><path id="a" d="M0 0h18v18H0z"/></defs>
            <clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath>
            <path clip-path="url(#b)" d="M6.363 2.32a3.894 3.894 0 0 0-2.796 1.083.498.498 0 1 0 .688.72 2.925 2.925 0 0 1 4.13.095.495.495 0 0 0 .704.016.499.499 0 0 0 .017-.705A3.898 3.898 0 0 0 6.363 2.32"/><path clip-path="url(#b)" d="M13.356 11.916c-.192-.192-.527-.185-.82-.003l-1.807-1.807c.369-.46.836-1.137 1.059-1.687a6.084 6.084 0 0 0 .448-2.302 6.084 6.084 0 0 0-1.792-4.326A6.086 6.086 0 0 0 8.42.448 6.08 6.08 0 0 0 6.118 0a6.084 6.084 0 0 0-4.326 1.792A6.104 6.104 0 0 0 0 6.118a6.104 6.104 0 0 0 1.792 4.326 6.083 6.083 0 0 0 4.326 1.792 6.1 6.1 0 0 0 2.302-.448c.55-.223 1.227-.689 1.688-1.059l1.806 1.807c-.181.293-.189.627.003.819l4.297 4.537c.238.239.815.049 1.142-.277l.262-.262c.325-.325.516-.902.276-1.141l-4.538-4.296zM9.485 9.485c-.899.899-2.095 1.396-3.367 1.396S3.65 10.385 2.75 9.485a4.767 4.767 0 0 1 0-6.735c.899-.9 2.096-1.395 3.368-1.395s2.468.496 3.367 1.395a4.729 4.729 0 0 1 1.396 3.368 4.724 4.724 0 0 1-1.396 3.367"/>
        </symbol>
        <symbol id="search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 18 18">
            <defs><path id="a" d="M0 0h18v18H0z"/></defs>
            <clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath>
            <path clip-path="url(#b)" d="M6.363 2.32a3.894 3.894 0 0 0-2.796 1.083.498.498 0 1 0 .688.72 2.925 2.925 0 0 1 4.13.095.495.495 0 0 0 .704.016.499.499 0 0 0 .017-.705A3.898 3.898 0 0 0 6.363 2.32"/><path clip-path="url(#b)" d="M13.356 11.916c-.192-.192-.527-.185-.82-.003l-1.807-1.807c.369-.46.836-1.137 1.059-1.687a6.084 6.084 0 0 0 .448-2.302 6.084 6.084 0 0 0-1.792-4.326A6.086 6.086 0 0 0 8.42.448 6.08 6.08 0 0 0 6.118 0a6.084 6.084 0 0 0-4.326 1.792A6.104 6.104 0 0 0 0 6.118a6.104 6.104 0 0 0 1.792 4.326 6.083 6.083 0 0 0 4.326 1.792 6.1 6.1 0 0 0 2.302-.448c.55-.223 1.227-.689 1.688-1.059l1.806 1.807c-.181.293-.189.627.003.819l4.297 4.537c.238.239.815.049 1.142-.277l.262-.262c.325-.325.516-.902.276-1.141l-4.538-4.296zM9.485 9.485c-.899.899-2.095 1.396-3.367 1.396S3.65 10.385 2.75 9.485a4.767 4.767 0 0 1 0-6.735c.899-.9 2.096-1.395 3.368-1.395s2.468.496 3.367 1.395a4.729 4.729 0 0 1 1.396 3.368 4.724 4.724 0 0 1-1.396 3.367"/>
        </symbol>        <symbol id="facebook" width="100%" height="100%" viewBox="0 0 12 25" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.845 24.73V12.488h3.38l.447-4.218H7.845l.006-2.111c0-1.1.104-1.69 1.685-1.69h2.112V.25h-3.38C4.21.25 2.78 2.296 2.78 5.738V8.27H.25v4.219h2.53v12.24h5.065z" fill="#FFFFFF" fill-rule="nonzero"/>
        </symbol>
        <symbol id="twitter" width="100%" height="100%" viewBox="0 0 22 19" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.826 5.288l.047.779-.787-.096C7.222 5.606 4.72 4.367 2.595 2.285L1.556 1.253l-.267.762c-.567 1.7-.205 3.496.976 4.703.629.668.487.763-.599.366-.377-.127-.708-.223-.74-.175-.11.111.268 1.557.567 2.129.41.794 1.244 1.573 2.156 2.034l.772.365-.913.016c-.882 0-.913.016-.819.35.315 1.032 1.559 2.129 2.943 2.605l.976.334-.85.509a8.86 8.86 0 0 1-4.217 1.175c-.709.016-1.291.08-1.291.127 0 .16 1.92 1.05 3.037 1.399 3.353 1.032 7.335.588 10.325-1.176 2.124-1.255 4.25-3.75 5.24-6.165.536-1.287 1.07-3.639 1.07-4.767 0-.73.048-.826.93-1.7.519-.508 1.007-1.064 1.101-1.223.157-.302.142-.302-.66-.032-1.339.477-1.528.413-.867-.302.488-.508 1.07-1.43 1.07-1.7 0-.048-.235.032-.503.175-.283.159-.913.397-1.385.54l-.85.27-.771-.524c-.425-.286-1.023-.604-1.338-.7-.802-.222-2.03-.19-2.754.064-1.967.715-3.21 2.558-3.069 4.576z" fill="#FFFFFF" fill-rule="nonzero"/>
        </symbol>
        <symbol id="instagram" width="100%" height="100%" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(.313 .313)" fill-rule="nonzero" fill="none">
                <path d="M16.82 0H7.138A7.145 7.145 0 0 0 0 7.137v9.684a7.145 7.145 0 0 0 7.137 7.137h9.684a7.145 7.145 0 0 0 7.137-7.137V7.137C23.958 3.202 20.756 0 16.821 0zm4.728 16.82a4.727 4.727 0 0 1-4.727 4.728H7.137A4.727 4.727 0 0 1 2.41 16.82V7.137A4.727 4.727 0 0 1 7.137 2.41h9.684a4.727 4.727 0 0 1 4.727 4.727v9.684z" fill="#FFFFFF"/>
                <path d="M11.979 5.783a6.203 6.203 0 0 0-6.196 6.196 6.203 6.203 0 0 0 6.196 6.196 6.203 6.203 0 0 0 6.196-6.196 6.203 6.203 0 0 0-6.196-6.196zm0 9.982a3.786 3.786 0 1 1 0-7.572 3.786 3.786 0 0 1 0 7.572z" fill="#FFFFFF"/>
                <circle fill="#FFFFFF" cx="18.187" cy="5.829" r="1.485"/>
            </g>
        </symbol>
        <symbol id="youtube" width="100%" height="100%" viewBox="0 0 25 18" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.998 2.944c.502 1.921.502 5.931.502 5.931s0 4.01-.502 5.931a3.047 3.047 0 0 1-2.122 2.18c-1.871.514-9.376.514-9.376.514s-7.505 0-9.377-.515a3.047 3.047 0 0 1-2.122-2.179C.5 12.885.5 8.875.5 8.875s0-4.01.501-5.931A3.047 3.047 0 0 1 3.123.765C4.995.25 12.5.25 12.5.25s7.505 0 9.377.515a3.047 3.047 0 0 1 2.121 2.179zM10.25 13l6-3.75-6-3.75V13z" fill="#FFFFFF" fill-rule="nonzero"/>
        </symbol>
    </defs>
</svg>

<header class="header">
    <div class="header__main">
        <div class="container d-flex header__main__container">
            <a href="<?php bloginfo('url'); ?>" class="header__logo">
                <?php $logo = get_field('logo', 'options'); ?>
                <img src="<?php echo $logo['sizes']['thumbnail']; ?>">

                <span class="header__logo__slogan"><?php echo get_field('slogan', 'options'); ?></span>
            </a>
            <!-- <a href="https://www.abemec.nl" class="sponsor_logo">
                <img src="https://www.abemec.nl/wp-content/uploads/innoverenipvsaneren-abemec.png">
            </a> -->

            <?php get_template_part('template-parts/menu', 'top-menu'); ?>
        </div>
    </div>

    <?php get_template_part('template-parts/menu', 'main-menu'); ?>
</header>

<main>