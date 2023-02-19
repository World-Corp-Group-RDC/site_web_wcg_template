<?php
$newPathCss = pathCss;
$newPathJs = pathJs;
$newPathIcons = icons;

if ($_SERVER['REQUEST_URI'] != '/') {
	$newPathCss = "." . pathCss;
	$newPathIcons = "." . icons;
	$newPathJs = "." . pathJs;
}
//"../css/header.css" content
//../public/css
// ./css/header.css racine
//./pulic/media
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta name="description" content=<?= $descritionPage ?? " " ?> />
	<meta name="autheur" content="jacobit,kashala,serge kashala,jacobit kashala " />
	<meta name="keywords" content="World Corp Group, WorldGroupCorp,WorldCorpGroup" />
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>

	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta property="og:title" content="World Corp Group" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.example.com/" />
	<meta property="og:image" content="http://example.com/image.jpg" />
	<meta property="og:description" content="World Corp Group est une société de consulting et de développement de projets innovants, spécialiste en solutions SMAC (Social, Mobile, Analytics, Cloud)" />

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@publisher_handle">
	<meta name="twitter:<?= $titlePage ?? "World Corp Group" ?></" content="Page Title">
	<meta name="twitter:description" content="World Corp Group est une société de consulting et de développement de projets innovants, spécialiste en solutions SMAC (Social, Mobile, Analytics, Cloud)">
	<meta name="twitter:creator" content="jacobitkashala">
	<!-- Twitter Summary card images must be at least 200x200px -->
	<meta name="twitter:image" content="http://www.example.com/image.jpg">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- swiper -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link rel='stylesheet' type='text/css' media='screen' href="<?= $newPathCss . "header.css" ?>">
	<link rel='stylesheet' type='text/css' media='screen' href='<?= $newPathCss . "util.css" ?>'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/util.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/home.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/home.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/actualite.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/actualite.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/detail_recrutement.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/detail_recrutement.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/expertise.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/expertise.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/formulaire_recrutement.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/formulaire_recrutement.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/innovation.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/innovation.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/recrutement.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/recrutement.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/ressource.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/ressource.css'> -->
	<link rel='stylesheet' type='text/css' media='screen' href='css/footer.css'>
	<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/footer.css'> -->
	<link rel="shortcut icon" href="<?= $newPathIcons . 'favico.ico' ?>" alt="logo wcg" />
	<title><?= $titlePage ?? "World Corp Group" ?></title>
</head>

<body>
	<?php require  'header.php' ?>
	<h1>404	</h1>
	<?php require  'footer.php' ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
	<script src='<?= $newPathJs . "main.js" ?>'></script>
</body>

</html>