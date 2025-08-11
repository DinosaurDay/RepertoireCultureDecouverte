<?php get_header() ?>

<div class="page-container">
    <h1><?php the_title() ?></h1>
    <h2>Bienvenue !</h2>
    <div class="home-welcome-content">
        <div class="welcome-content">
            <?= get_the_post_thumbnail() ?>
            <p>Le <span>RCD (Répertoire de la Culture et des Découvertes)</span>, est la plateforme de référence pour les passionnés de films, séries et jeux vidéo ! Nous sommes fiers de vous proposer une liste exhaustive de titres, accompagnés de leur année de sortie, leur synopsis, leur réalisateur, leur genre et bien plus encore.</p>
        </div>
        <div class="btn-dark">
            <a href="<?= get_permalink(27) ?>">En savoir +</a>
        </div>
    </div>

    <div class="separator"></div>

    <div class="home-films-container">
        <div class="articles">
            <div class="home-articles">
                <h2>Nouveaux sur le site</h2>
                <?php
                $args = array(
                    'post_type' => 'film',
                    'posts_per_page' => 3
                );
                $recent_posts = new WP_Query($args);
                if ($recent_posts->have_posts()) : ?>
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                <div class="card carousel-item">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img', 'alt' => 'Affiche film', 'style' => 'object-fit:contain']) ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php the_title() ?></h5>
                                        <p class="card-text"><?php echo substr(get_field('synopsis'), 0, 100) . '...'; ?></p>
                                    </div>
                                    <ul class="list-group w-100">
                                        <li class="list-group-item text-center"><?php $terms = wp_get_post_terms(get_the_ID(), 'categories');
                                                                                $count = count($terms);
                                                                                foreach ($terms as $index => $term) {
                                                                                    echo $term->name;
                                                                                    if ($index < $count - 1) {
                                                                                        echo ' / ';
                                                                                    }
                                                                                }; ?>
                                        </li>
                                        <li class="list-group-item list-group-item-action d-flex flex-row justify-content-between">
                                            <div class="flex-fill text-center card-info">
                                                <?= get_field('duree') . ' min'; ?>
                                            </div>
                                            <div class="flex-fill text-center border-left">
                                                <?= get_field('annee'); ?>
                                            </div>
                                        </li>
                                    </ul>
                                    <div>
                                        <a href="<?php the_permalink() ?>" class="btn btn-dark col-sm-12">Découvrir</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="home-articles">
                <h2>Les classiques</h2>
                <?php
                $args = [
                    'post_type' => 'film',
                    'meta_key' => 'annee',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'posts_per_page' => 3,
                    'meta_query' => [
                        [
                            'key' => 'annee',
                            'value' => 2000,
                            'compare' => '<',
                            'type' => 'NUMERIC',
                        ]
                    ]
                ];
                $films = new WP_Query($args);

                if ($films->have_posts()) { ?>
                    <div id="carouselExampleSlidesOnlyBis" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php while ($films->have_posts()) {
                                $films->the_post(); ?>

                                <div class="card carousel-item">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img', 'alt' => 'Affiche film', 'style' => 'object-fit:contain']) ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php the_title() ?></h5>
                                        <p class="card-text"><?php echo substr(get_field('synopsis'), 0, 100) . '...'; ?></p>
                                    </div>
                                    <ul class="list-group w-100">
                                        <li class="list-group-item text-center"><?php $terms = wp_get_post_terms(get_the_ID(), 'categories');
                                                                                $count = count($terms);
                                                                                foreach ($terms as $index => $term) {
                                                                                    echo $term->name;
                                                                                    if ($index < $count - 1) {
                                                                                        echo ' / ';
                                                                                    }
                                                                                }; ?>
                                        </li>
                                        <li class="list-group-item list-group-item-action d-flex flex-row justify-content-between">
                                            <div class="flex-fill text-center card-info">
                                                <?= get_field('duree') . ' min'; ?>
                                            </div>
                                            <div class="flex-fill text-center border-left">
                                                <?= get_field('annee'); ?>
                                            </div>
                                        </li>
                                    </ul>
                                    <div>
                                        <a href="<?php the_permalink() ?>" class="btn btn-dark col-sm-12">Découvrir</a>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                <?php }
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <div class="btn-dark">
            <a href="<?= get_post_type_archive_link('film') ?>">Voir la liste des films</a>
        </div>
    </div>

    <div class="separator"></div>

    <div class="home-genres-container">
        <h2>Pour tous les goûts !</h2>
        <p>Que vous soyez film d'action à la James Bond, ou plutôt film culte comme les Incorruptibles ou alors que vous préfériez un bon film d'humour à regarder pour décompresser en sortant du travail, il ne fait aucun doute que vous trouvez votre bonheur ici !</p>
        <ul class="home-genres-list">
            <li>Action</li>
            <li>Aventure</li>
            <li>Comédie</li>
            <li>Drame</li>
            <li>Espionnage</li>
            <li>Fantastique</li>
            <li>Jeunesse</li>
            <li>Policier</li>
            <li>Romance</li>
            <li>SiFi</li>
            <li>Thriller</li>
            <li>Western</li>
        </ul>
        <img src=https://wordpress.noah-abraham.fr/wp-content/uploads/couv-genres-cinematographiques.png>
        <div class="btn-dark">
            <a href="<?= get_permalink(131) ?>">Voir les genres</a>
        </div>
    </div>

    <div class="separator"></div>

    <div class="home-visite">
        <h2>Bonne visite !</h2>
        <p>Si vous êtes un passionné de l'univers cinématographique, nul doute que vous êtes au bon endroit ! Nous vous souhaitons un agréable moment sur notre site, en espérant que vous trouviez votre bonheur !</p>
    </div>
</div>

<?php get_footer() ?>