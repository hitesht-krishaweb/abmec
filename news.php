<?php include("header.php") ?>

<div class="banner">
    <div class="banner__content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-8 col-xl-5 offset-xl-7">
                    <div class="banner__content__inner">
                        <h1 class="banner__title">Mechanisatie op maat. Titel over twee regels</h1>
                        <p class="banner__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum officia dolores pariatur atque ullam rerum adipisci, assumenda ipsa officiis?</p>
                        <a href="" class="button button--white">
                            <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                            Lees verder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <picture>
        <source media="(min-width: 1200px)" srcset="//placehold.it/1920x540">
        <source media="(min-width: 992px)" srcset="//placehold.it/1200x338">
        <source media="(min-width: 576px)" srcset="//placehold.it/1024x288">
        <img src="//placehold.it/640x180" alt="">
    </picture>
</div>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumbs__list" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" >
            <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                <a href="">
                    <span itemprop="name">home</span>
                    <meta itemprop="item" content=""> <!-- Zet de url binnen content="" -->
                    <meta itemprop="position" content="1">
                </a>
            </li>
            <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                <span itemprop="name">nieuws</span>
                <meta itemprop="item" content=""> <!--  Zet de url binnen content="" -->
                <meta itemprop="position" content="2">
            </li>
        </ol>
    </div>
</div>

<div class="news-list">
    <div class="container">
        <div class="row">
            <article class="news-item col-12">
                <a href="" class="news-item__link">
                    <picture>
                        <source media="(min-width: 992px)" srcset="//placehold.it/363x252">
                        <img src="//placehold.it/263x152" alt="">
                    </picture>
                    <div class="news-item__content">
                        <h2>Lemken start met verkoop kunstmeststrooiers</h2>
                        <time datetime="2019-08-15">maandag 15 augustos 2019</time>
                    </div>
                </a>
            </article>
            <article class="news-item col-12">
                <a href="" class="news-item__link">
                    <picture>
                        <source media="(min-width: 992px)" srcset="//placehold.it/363x252">
                        <img src="//placehold.it/263x152" alt="">
                    </picture>
                    <div class="news-item__content">
                        <h2>Gratis trekkercheck bij Abemec</h2>
                        <time datetime="2019-07-12">donderdag 12 juli 2019</time>
                    </div>
                </a>
            </article>
        </div>
        <div class="row justify-content-center">
            <button class="button button--primary">
                Toon meer
                <svg class="icon-chevron icon-chevron--down icon-chevron--white" ><use xlink:href="#chevron"></use></svg>
            </button>
        </div>
    </div>
</div>

<?php include("footer.php") ?>