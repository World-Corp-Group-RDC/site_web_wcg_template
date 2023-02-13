<?php

use App\MODEL\Carousel;
use App\MODEL\HomeSection;
use App\MODEL\AlaUneActualite;

use App\Connection;

$titlePage = 'LittleContent';
$descriptionPage = 'World Corp Group est une société de consulting et de développement de projets innovants, spécialiste en solutions SMAC (Social, Mobile, Analytics, Cloud)';


$pdo = Connection::getPDO();
$carouselSlq = "SELECT media.MED_ID, media.MED_RESSOURCE ,sous_rubrique.SRU_ORDRE FROM  media Inner JOIN sous_rubrique ON sous_rubrique.SRU_IMG_ID = media.MED_ID Inner JOIN site ON sous_rubrique.SIT_ID = site.SIT_ID WHERE  sous_rubrique.SRU_UNE = 1 AND site.SIT_ID=1";
$query1 = $pdo->query($carouselSlq);
$carousels = $query1->fetchAll(PDO::FETCH_CLASS, Carousel::class);

$homeSectionlSlq = "SELECT  sous_rubrique.SRU_ID ,sous_rubrique.SRU_TITRE , sous_rubrique.SRU_CONTENU FROM  sous_rubrique WHERE sous_rubrique.SRU_LIBELLE = 'home'  AND STA_ID = 1 AND SIT_ID = 1 ";
$query2 = $pdo->query($homeSectionlSlq);
$homeSection = $query2->fetchAll(PDO::FETCH_CLASS, HomeSection::class);

// $homeActualitelSlq = "SELECT media.MED_RESSOURCE, sous_rubrique.SRU_LIBELLE, sous_rubrique.SRU_TITRE , sous_rubrique.SRU_CONTENU FROM sous_rubrique INNER JOIN media ON media.MED_ID = sous_rubrique.SRU_VIGNETTE_ID WHERE SRU_AVANT = 1 AND STA_ID = 1 ORDER BY SRU_ORDRE LIMIT 5";
// $query = $pdo->query($homeSectionlSlq);
// $homeSection = $query->fetchAll(PDO::FETCH_CLASS, HomeSection::class);


$homeActualitelSlq = "SELECT  sous_rubrique.SRU_ID ,media.MED_RESSOURCE  FROM  sous_rubrique INNER JOIN media ON media.MED_ID= sous_rubrique.SRU_IMG_ID WHERE sous_rubrique.SRU_LIBELLE = 'actualite'  AND STA_ID = 1 AND SIT_ID = 1 And SRU_AVANT =1 LIMIT 3";
$query3 = $pdo->query($homeActualitelSlq);
$homeActualite = $query3->fetchAll(PDO::FETCH_CLASS, AlaUneActualite::class);


$resultData = [];

// echo '<pre>';
// echo print_r($homeActualite);
// echo '<pre>';
?>
<main>
	<section class="home">
		<div class="home-slider swiper">
			<div class="swiper-wrapper">
				<?php foreach ($carousels as $image) : ?>
					<div class="slide swiper-slide" style="background:url(<?php echo ecrousel . $image->getCarouselNameRessource(); ?>) no-repeat">
						<div class="content">
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</section>
	<div class="container-home">
		<section class=" row description">
			<!-- <div class="col-xs-1 col-md-3  content-image"> -->
			<div class="col-xs-1 col-md-3  ">
				<img class="image-illustration" src="<?php  echo ephoto."image1.png" ?>" alt="illustration lampe" srcset="">
			</div>
			<div class=" col-xs-10 col-md-4 content-desc">
				<h1><?php echo $homeSection[0]->getTitle() ?> </h1>
				<p>
					<?php echo $homeSection[0]->getContenue() ?>
				</p>
			</div>
			<div class=" col-xs-10 col-md-4 contenaire-video">
				<video src="<?php  echo evideo.$homeActualite[0]->getRessource() ?>" controls></video>
			</div>
		</section>
		<!-- Présentation de service -->
		<div class="contenaire-service">
			<div class="service-element">
				<?php
				foreach ($resultData as $contentMiseEnAvant) : ?>
					<!-- <div class="service-content">
						<img src="./images/images_design_factory.png" alt="image titre" srcset="">
						<h1><?php echo $contentMiseEnAvant['SRU_TITRE'] ?></h1>
						<p><?php echo $contentMiseEnAvant['SRU_CONTENU'] ?> </p>
						<a class="btn" href="#">Pour en savoir plus ...</a>
					</div> -->
				<?php endforeach ?>

				<!-- 
				<div class="service-content">
					<img src="./images/image_ecran_projection.png" alt="image titre" srcset="">
					<h1>CONSULTING</h1>
					<p>Nous accompagnons, très en amont de projets, nos clients dans leurs démarches de
						transformation
						digitale
						et d’optimisation de leur stratégie numérique. </p>
					<a class="btn" href="#">Pour en savoir plus ...</a>
				</div>
				<div class="service-content">
					<img src="./images/image_consulting.png" alt="image titre" srcset="">
					<h1>CONSULTING</h1>
					<p>Nous accompagnons, très en amont de projets, nos clients dans leurs démarches de
						transformation
						digitale
						et d’optimisation de leur stratégie numérique. </p>
					<a class="btn" href="#">Pour en savoir plus ...</a>
				</div>
				<div class="service-content">
					<img src="./images/image_et_innovation.png" alt="image titre" srcset="">
					<h1>CONSULTING</h1>
					<p>Nous accompagnons, très en amont de projets, nos clients dans leurs démarches de
						transformation
						digitale
						et d’optimisation de leur stratégie numérique. </p>
					<a class="btn" href="#">Pour en savoir plus ...</a>
				</div>
				<div class="service-content">
					<img src="./images/image_telecom.png" alt="image titre" srcset="">
					<h1>CONSULTING</h1>
					<p>Nous accompagnons, très en amont de projets, nos clients dans leurs démarches de
						transformation
						digitale
						et d’optimisation de leur stratégie numérique. </p>
					<a class="btn" href="#">Pour en savoir plus ...</a>
				</div> -->

			</div>
		</div>
		<!-- slide nos partenaire -->
		<div class="container_partner_slide">
			<h2 class="text-center font-weight-bold">Nos Partenaires</h2>
			<div class="container_partner_display">
				<div class="partner_block">
					<div class="container-slide">
						<img class="" src="./images/left.png" alt="logo" />
					</div>
					<div class="partner_display_item ">
						<div class="item_slide"><img src="./images/partners/image_evolis.png" alt="logo"></div>
						<div class="item_slide"><img src="./images/partners/image_huawai.png" alt="logo"></div>
						<div class="item_slide"><img src="./images/partners/image_juris_consult.png" alt="logo">
						</div>
						<div class="item_slide"><img src="./images/partners/image_konnect.png" alt="logo"></div>
					</div>
					<div>
						<img class="" src="./images/rigth.png" alt="logo" />
					</div>
				</div>
			</div>
		</div>
	</div>
</main>