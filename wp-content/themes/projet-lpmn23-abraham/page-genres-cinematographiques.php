<?php get_header() ?>

<div class="page-container">
    <h1><?php the_title() ?></h1>

    <?php
    $genres = getMovieGenres();

    if (!empty($genres) && !is_wp_error($genres)) {
        echo '<div class="cards-container">';

        $card_index = 1;

        foreach ($genres as $genre) {
            $genre_link = get_term_link($genre);

            if (!is_wp_error($genre_link)) {
                $genre_query_args = array(
                    'post_type' => 'film',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categories',
                            'field'    => 'term_id',
                            'terms'    => $genre->term_id,
                        ),
                    ),
                );
                $genre_search_link = esc_url(add_query_arg(array('genre_id' => $genre->term_id), get_post_type_archive_link( 'film' )));
                echo '<a href="' . $genre_search_link . '" class="cat-card">';
                echo '<div class="cat-card-body">';
                echo '<img src="https://wordpress.noah-abraham.fr/wp-content/uploads/' . $card_index . '.jpg" alt="' . $genre->name . '">';
                echo '<h5 class="card-title">' . $genre->name . '</h5>';
                echo '</div>';
                echo '</a>';

                $card_index++;
            }
        }

        echo '</div>';
    } else {
        echo '<p>Aucun genre trouvé.</p>';
    }
    ?>
</div>

<?php get_footer() ?>