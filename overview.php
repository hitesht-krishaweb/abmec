<?php
/*
* Template Name: Occassions Pagina
*/
?>
<?php get_header(); ?>

<section class="section">
    <form action="" data-module-filter>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-9">
                    <div class="breadcrumbs">
                        <ol class="breadcrumbs__list" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList" >
                            <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                <a href="">
                                    <span itemprop="name">home</span>
                                    <meta itemprop="item" content=""> <!-- Zet de url binnen content="" -->
                                    <meta itemprop="position" content="1">
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                <a href=""><span itemprop="name">occassions</span></a>
                                <meta itemprop="item" content=""> <!-- Zet de url binnen content="" -->
                                <meta itemprop="position" content="2">
                            </li>
                            <li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
                                <span itemprop="name">tractoren</span>
                                <meta itemprop="item" content=""> <!--  Zet de url binnen content="" -->
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form__group form__group--inline">
                        <button type="button" class="button button--primary mr-4 d-block d-lg-none" data-module-filter-toggle>Toon filters</button>
                        <label for="sort">Sorteer op</label>
                        <select name="Sort" id="sort">
                            <option value="PriceAsc">Prijs oplopend</option>
                            <option value="PriceDesc">Prijs aflopend</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-none d-lg-block col-lg-3 col-xl-2" data-module-filter-filters>
                    <!-- Add 'data-collapsed' to filter__group to collapse group as default  -->
                    <div class="filter__group">
                        <h3 class="filter__group__title">Prijs</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <label for="pricefrom">van</label>
                                <select name="PriceFrom" id="pricefrom">
                                    <option value="10000">&euro; 10.000</option>
                                    <option value="15000">&euro; 15.000</option>
                                    <option value="20000">&euro; 20.000</option>
                                    <option value="25000">&euro; 25.000</option>
                                    <option value="30000">&euro; 30.000</option>
                                </select>
                            </div>
                            <div class="form__group">
                                <label for="pricetill">tot</label>
                                <select name="PriceTill" id="pricetill">
                                    <option value="10000">&euro; 10.000</option>
                                    <option value="15000">&euro; 15.000</option>
                                    <option value="20000">&euro; 20.000</option>
                                    <option value="25000">&euro; 25.000</option>
                                    <option value="30000">&euro; 30.000</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter__group">
                        <h3 class="filter__group__title">Draaiuren</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <label for="ophfrom">van</label>
                                <select name="OperatingHoursFrom" id="ophfrom">
                                    <option value="5000">5.000</option>
                                    <option value="6000">6.000</option>
                                    <option value="7000">7.000</option>
                                    <option value="8000">8.000</option>
                                    <option value="9000">9.000</option>
                                    <option value="10000">10.000</option>
                                </select>
                            </div>
                            <div class="form__group">
                                <label for="ophtill">tot</label>
                                <select name="OperatingHoursTill" id="ophtill">
                                    <option value="5000">5.000</option>
                                    <option value="6000">6.000</option>
                                    <option value="7000">7.000</option>
                                    <option value="8000">8.000</option>
                                    <option value="9000">9.000</option>
                                    <option value="10000">10.000</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter__group">
                        <h3 class="filter__group__title">Bouwjaar</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <label for="yearfrom">van</label>
                                <select name="YearFrom" id="yearfrom">
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                </select>
                            </div>
                            <div class="form__group">
                                <label for="yeartill">tot</label>
                                <select name="YearTill" id="yeartill">
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter__group">
                        <h3 class="filter__group__title">Locatie vestiging</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <label for="location">vestiging</label>
                                <select name="Location" id="location">
                                    <option value="ermelo">Ermelo</option>
                                    <option value="geldermalsen">Geldermalsen</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter__group">
                        <h3 class="filter__group__title">Aangeboden sinds</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <label class="radio">
                                    Vandaag
                                    <input type="radio" name="OfferDate" value="today" class="radio__input">
                                    <span class="radio__indicator"></span>
                                </label>
                                <label class="radio">
                                    Gisteren
                                    <input type="radio" name="OfferDate" value="yesterday" class="radio__input">
                                    <span class="radio__indicator"></span>
                                </label>
                                <label class="radio">
                                    Een week
                                    <input type="radio" name="OfferDate" value="week" class="radio__input">
                                    <span class="radio__indicator"></span>
                                </label>
                                <label class="radio">
                                    Altijd
                                    <input type="radio" name="OfferDate" value="always" class="radio__input">
                                    <span class="radio__indicator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-xl-10">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="product">
                                <picture class="product__picture">
                                    <source media="(min-width: 576px)" srcset="//placehold.it/460x308">
                                    <img src="//placehold.it/320x214" alt="">
                                </picture>
                                <div class="product__description">
                                    <h3 class="product__name">Fendt 309 C</h3>

                                    <div class="product__meta">
                                        <span class="product__meta__item">Prijs: &euro; 26.000 (btw)</span>
                                        <span class="product__meta__item">Locatie: Abemec Ermelo</span>
                                        <span class="product__meta__item">Bouwjaar: 2003</span>
                                        <span class="product__meta__item">Draaiuren: 6300</span>
                                    </div>

                                    <a href="<?php echo get_permalink(); ?>" class="product__link button button--primary">
                                        Meer info
                                        <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $args = array(
                            'post_type' => 'occasion',
                            'post_status' => 'publish',
                            'posts_per_page' => 8,
                            'orderby' => 'title',
                            'order' => 'ASC',
                        ); ?>

                        <?php $products = new WP_Query($args); ?>

                        <?php while($products->have_posts()): $products->the_post(); ?>

                        <div class="col-12 col-md-6">
                            <div class="product">
                                <picture class="product__picture">
                                    <source media="(min-width: 576px)" srcset="//placehold.it/460x308">
                                    <img src="//placehold.it/320x214" alt="">
                                </picture>
                                <div class="product__description">
                                    <h3 class="product__name"><?php echo the_title(); ?></h3>

                                    <div class="product__meta">
                                        <span class="product__meta__item">Prijs: &euro; <?php get_post_meta(get_the_ID(), 'prijsexcl') ?></span>
                                        <span class="product__meta__item">Locatie: Abemec Ermelo</span>
                                        <span class="product__meta__item">Bouwjaar: 2003</span>
                                        <span class="product__meta__item">Draaiuren: 6300</span>
                                    </div>

                                    <a href="<?php echo get_the_permalink(); ?>" class="product__link button button--primary">
                                        Meer info
                                        <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                        <?php endwhile; ?>
                        <div class="col-12 col-md-6">
                            <div class="product">
                                <picture class="product__picture">
                                    <source media="(min-width: 576px)" srcset="//placehold.it/460x308">
                                    <img src="//placehold.it/320x214" alt="">
                                </picture>
                                <div class="product__description">
                                    <h3 class="product__name">Fendt 309 C</h3>

                                    <div class="product__meta">
                                        <span class="product__meta__item">Prijs: &euro; 26.000 (btw)</span>
                                        <span class="product__meta__item">Locatie: Abemec Ermelo</span>
                                        <span class="product__meta__item">Bouwjaar: 2003</span>
                                        <span class="product__meta__item">Draaiuren: 6300</span>
                                    </div>

                                    <a href="" class="product__link button button--primary">
                                        Meer info
                                        <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php get_footer(); ?>