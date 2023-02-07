<?php
$db->sql("SET NAMES 'utf8'");
$sql = "SELECT * FROM `V_Menu_Princepal`";
$db->sql($sql);
$result = $db->getResult();


$menus = $result;

/* echo '<pre>';
var_export($menus);
echo '</pre>'; */
?>

<header class="header_container">
	<div class="header_image">
		<img src="./images/logo/logo_wcg.png" srcset="./images/icons/logo_smal_mobile.png 450w," alt="logo wcg" />
	</div>
	<nav class="header_nav_container">
		<?php
		foreach ($menus as $menu) {
		?>
			<a class="menu" href="#" style="background-color:<?php echo $menu['RUB_BACKGROUND']; ?>; color:<?= $menu['RUB_FONT_COLOR'] ?>">
				<img class="logo-menu" src="./images/logo/<?php echo $menu['med_ressource']; ?>" alt="logo" />
				<?php echo $menu['RUB_LIBELLE']; ?>
			</a>
		<?php
		}
		?>
	</nav>
	<div class="fas fa-bars" id="menu-btn">
	</div>
	<style>
	</style>
</header>