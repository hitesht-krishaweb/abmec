<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/*
 * Template Name: Import
 */

get_header();
?>

    <form method="post">
        <input type="submit" name="sync_occasions" value="Synchroniseer OC">
        <input type="submit" name="sync_categories" value="Synchroniseer CAT">
    </form>
<?php if (have_posts()): ?>
    <section class="section">
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">

                        <?php while (have_posts()): the_post(); ?>
                            <h1><?php echo the_title(); ?></h1>
                            <p>Hier komt de content van de pagina <?php echo the_title(); ?></p>

                            <?php the_content(); ?>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed porttitor dolor.
                                Curabitur ut lorem erat. Nulla condimentum ac metus sit amet varius. Aliquam pretium
                                consequat justo, ut venenatis neque dapibus a. Nunc et dapibus eros. Suspendisse vel
                                magna augue. Nullam id arcu lacus. Ut rutrum, diam a convallis males</p>

                            <h3>En dit is een sub kop op de pagina <?php echo the_title(); ?></h3>

                            <p>Etiam facilisis ex eu est mollis maximus. Duis quis consectetur nunc. Vestibulum eget
                                nisi vulputate, imperdiet arcu sodales, semper diam. Nunc placerat nunc erat, et
                                interdum erat tincidunt non. Proin arcu magna, fringilla aliquet lacus vitae, lobortis
                                faucibus nulla. Phasellus suscipit nisi metus, in porttitor lectus ullamcorper et.
                                Pellentesque et rutrum mi. Donec nec massa vitae nulla congue molestie. Quisque egestas
                                pharetra sapien, a laoreet est auctor a. Proin pulvinar lorem vestibulum, porttitor
                                dolor eget, posuere magna. Sed bibendum tortor id velit consectetur vestibulum. Vivamus
                                ultrices mauris mi, ut ornare libero mollis ut. Curabitur erat sapien, pulvinar id urna
                                in, bibendum interdum magna. Pellentesque commodo dui ut pretium faucibus. Nulla
                                pulvinar nisl ut dui finibus, iaculis pretium erat condimentum. Ut tincidunt ut ante id
                                iaculis.</p>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-lg-4">
                        <aside>
                            <div class="widget widget--image">
                                <h3 class="widget__title">Heeft u meer informatie nodig?</h3>
                                <p>Bel naar +31 (0)413 38 29 11 of stuur een e-mail naar <a href="mailto:sales@abemec.nl">sales@abemec.nl</a>
                                </p>
                                <img src="/assets/images/widget-info.png" alt="">
                            </div>
                            <div class="widget">
                                <h3 class="widget__title">Dit product is verkrijgbaar bij onze vestigen:</h3>
                                <ul>
                                    <li>
                                        <span>Goes</span>
                                        <span>+31 (0)113 22 12 00</span>
                                    </li>
                                    <li>
                                        <span>Onderdendam</span>
                                        <span>+31 (0)50 30 49 141</span>
                                    </li>
                                    <li>
                                        <span>Sevenum</span>
                                        <span>+31 (0)77 32 41 030</span>
                                    </li>
                                    <li>
                                        <span>Waalwijk</span>
                                        <span>+31 (0)416 65 28 00</span>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>

                </div>
            </div>



        </article>
    </section>
<?php endif; ?>

<?php
get_footer();
