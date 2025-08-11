<?php get_header() ?>
	<h1>Erreur 404 - Page introuvable</h1>

	<p>Cette page n'existe pas.</p>

	<h2>Raisons les plus fréquentes :</h2>

	<ul>
		<li>L'URL a mal été orthographiée</li>
		<li>La page n'existe pas</li>
		<li>La page a été déplacée</li>
		<li>La page a été supprimée</li>
	</ul>

	<p>Vérifiez la validité de l'URL. Si vous aimeriez que cet article voit le jour, demandez sa création à un modérateur.
		Vous pouvez utiliser la barre de navigation pour retourner sur le site</p>
<a href="<?php echo home_url(); ?>" class="btn btn-dark">Retourner à la page d'accueil</a>
<?php get_footer() ?>