<?php get_header() ?>

<div class="page-container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="single-film-container gap-4 mt-5">
                    <div class="print-container">
                        <img src="<?php the_post_thumbnail_url() ?>" alt="Movie print">
                    </div>
                    <div class="content-container">
                        <div class="bg-offset">
                        </div>
                        <h1><?php the_title() ?></h1>
                        <h5><?= get_field('annee') . ' | ' . get_field('duree') . 'min' . ' | ' . 'De ' . get_field('realisateur') . ' | ';
                            $terms = wp_get_post_terms(get_the_ID(), 'categories');
                            $count = count($terms);
                            foreach ($terms as $index => $term) {
                                echo $term->name;
                                if ($index < $count - 1) {
                                    echo ' / ';
                                }
                            }; ?></h5>
                        <p class="film-text"><?= get_field('synopsis') ?></p>
                    </div>
                </div>
            <?php endwhile ?>
        <?php else : ?>
            <h1>Pas d'articles dans cette catégorie</h1>
        <?php endif; ?>
    <div class="films-nav-options">
        <ul class="pagination">
            <li class="btn-dark">
                <?= previous_post_link() ?>
            </li>
            <li>
                <?php add_filmography_button() ?>
            </li>
            <li class="btn-dark">
                <?= next_post_link() ?>
            </li>
        </ul>
    </div>
</div>
<?php get_footer() ?>