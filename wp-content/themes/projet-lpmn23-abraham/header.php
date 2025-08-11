<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head() ?>
	
</head>

<body>
	<header>
		<nav class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="logo mx-3">
				<?php if (function_exists('the_custom_logo')) {
					the_custom_logo();
				} ?>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php wp_nav_menu(['theme_location' => 'header','container' => false,'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0']); ?>
				<?= get_search_form() ?>
			</div>
		</nav>
	</header>
	<main>