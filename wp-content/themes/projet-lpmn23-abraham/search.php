<?php get_header() ?>
<div class="page-container">
	<h1>Résultats de la recherche <?= "\"" . get_search_query() . "\"" ?></h1>
	<?php if (have_posts()) : ?>
		<div class="cards-container">
			<?php while (have_posts()) : the_post(); ?>
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
		<div class="search-nav-options">
			<?php themePagination() ?>
			<?php add_filmography_button() ?>
		</div>
</div>

<?php else : ?>
	<h1>Pas d'articles dans cette catégorie</h1>
<?php endif; ?>
<?php get_footer() ?>