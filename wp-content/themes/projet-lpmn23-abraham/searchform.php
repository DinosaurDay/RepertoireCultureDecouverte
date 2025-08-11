<form class="d-flex" action="<?php esc_url(home_url('/')) ?>">
    <input class="form-control me-2" name="s" type="search" placeholder="Rechercher" aria-label="Search" value="<?= get_search_query() ?>">
    <button class="btn btn-outline-light" type="submit">Rechercher</button>
    <?php if (is_archive() && get_query_var('paged') > 1) : ?>
        <input type="hidden" name="paged" value="<?php echo get_query_var('page'); ?>">
    <?php endif; ?>
</form>