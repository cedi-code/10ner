<article class="hreview open special">
	<?php if (empty($benutzer)): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Keine Benutzer gefunden.</h2>
		</div>
	<?php else: ?>
		<?php foreach ($benutzer as $ben): ?>
			<div class="panel panel-default">
				<div class="panel-heading"><?= $ben->benutzername; ?> <?= $ben->email; ?></div>
				<div class="panel-body">
					<p class="description">In der Datenbank existiert ein Benutzer mit dem Namen <?= $ben->benutzername; ?> <?= $ben->email; ?>. Dieser hat die EMail-Adresse: <a href="mailto:<?= $ben->email; ?>"><?= $ben->email; ?></a></p>
					<p>
						<a title="Löschen" href="/user/delete?id=<?= $user->id ?>">Löschen</a>
					</p>
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</article>
