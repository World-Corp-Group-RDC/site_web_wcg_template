<?php

use App\MODEL\Ressources;

use App\Connection;

$pdo = Connection::getPDO(db_host, db_user, db_pass, db_name);

//On passe a la variable page 1 s'il n'existe pas et 1 s'il contient ne porte quoi
$currentPage = (int)($_GET['page'] ?? 1) ?: 1;

if ($currentPage <= 0) {
	throw new Exception("Numéro de page invalide");
}
$slqRessourcesCount = "SELECT COUNT(*) FROM  media m inner join type_media tm ON tm.TYM_ID=m.TYM_ID LIMIT 10;";
$countRessources = (int)$pdo->query($slqRessources)->fetch(PDO::FETCH_NUM)[0];
$nbreElment = 10;
$page = ceil($countRessources / $nbreElment);

if($currentPage> $page){
	throw new Exception("Cette page n'existe pas");
}
$offset = $nbreElment * ($currentPage -1);
$slqRessources = "SELECT m.MED_LIBELLE as libelle, m.MED_RESSOURCE ressources,m.MED_INFOBULLE  as infobulle ,m.MED_META as metadesc ,tm.TYM_LIBELLE as nomtype FROM  media m inner join type_media tm ON tm.TYM_ID=m.TYM_ID LIMIT $nbreElment OFFSET  $offset";

$queryRessources = $pdo->query($slqRessources);
$ressources = $queryRessources->fetchAll(PDO::FETCH_CLASS, Ressources::class);
// echo '<pre>';
// var_dump($ressources);
// echo '</pre>';
// exit();
?>
<main>
	<div class="head-title">
		<div class="left">
			<h1>Resources</h1>
			<ul class="breadcrumb">
				<li>
					<a class="active" href="<?= $router->url("admin") ?>">Dashboard</a>
				</li>
				<li><i class='bx bx-chevron-right'></i></li>
				<li>
					<a href="#">ressources</a>
				</li>
			</ul>
		</div>
		<a href="<?= $router->url("form_add_ressource") ?>" class="btn-download">
			<i class='bx bxs-cloud-download'></i>
			<span class="text">Ajouter une ressource</span>
		</a>
	</div>

	<div class="table-data">
		<div class="order">
			<div class="head">
				<h3>Liste de ressources</h3>
				<i class='bx bx-search'></i>
				<i class='bx bx-filter'></i>
			</div>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Type </th>
						<th>Ressources</th>
						<th>Libeller</th>
						<th>Infobulle</th>
						<th>Description</th>
						<th>Visualisation</th>
						<th>actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($ressources as $ressource) : ?>
						<tr>
							<td>
								<?= $i++ ?></td>
							</td>
							<td>
								<?= $ressource->getNomtype() ?? "Manque info" ?></td>
							</td>
							<td>
								<?= $ressource->getRessources() ?? "Manque info" ?></td>
							</td>
							<td>
								<?= $ressource->getLibelle() ?? "Manque info" ?></td>
							</td>
							<td>
								<?= $ressource->getInfobulle() ?? "Manque info" ?></td>
							</td>
							<td>
								<?= $ressource->getMetadesc() ?? "Manque info" ?></td>
							</td>
							<td>
								<img src="<?= ephoto . $ressource->getRessources() ?>">
							</td>
							<td>
								<a class="btn btn-primary m-1" href="#">Modifier</a>
								<a class="btn btn-danger m-1" href="#">Supprimer</a>
							</td>
						<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="d-flex justify-content-betwen my-4">
			<?php if ($currentPage > 1) : ?>
				<a class="btn btn-primary" href="<?= $router->url('ressources') ?>?page<?= $currentPage - 1 ?>"> Page précédente </a>
			<?php endif ?>
			<?php if ($currentPage < $page) : ?>
				<a class="btn btn-primary" href="<?= $router->url('ressources') ?>?page<?= $currentPage + 1 ?>"> Page suivant </a>
			<?php endif ?>
		</div>
	</div>
</main>

</section>
<!-- CONTENT -->