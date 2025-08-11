<?php /*
Template Name: Archive Film
*/ get_header() ?>

<?php
// Vérifier si le paramètre de requête genre_id est défini
if (isset($_GET['genre_id'])) {
	$genre_id = intval($_GET['genre_id']);

	// Utiliser WP_Query pour récupérer les films filtrés par genre
	$args = array(
		'post_type' => 'film',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'categories',
				'field' => 'term_id',
				'terms' => $genre_id
			)
		)
	);
	$query = new WP_Query($args);
} else {
	// Utiliser la boucle principale pour récupérer tous les films
	$query = $wp_query;
} ?>

<div class="page-container">
	<h1>Filmographie</h1>
	<?php if ($query->have_posts()) : ?>
		<div class="cards-container">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<div class="col-sm-3">
					<div class="card">
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
				</div>
			<?php endwhile ?>
		</div>
		<?php themePagination() ?>
</div>

<?php else : ?>
	<h1>Pas d'articles dans cette catégorie</h1>
<?php endif; ?>

<?php
wp_reset_postdata();
?>



<?php get_footer() ?>