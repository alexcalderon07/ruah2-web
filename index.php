<?php
@ob_start();
include 'include/functions/header.php';
?>
<!DOCTYPE html>
<html lang="<?php print $language_code; ?>">
<!--<![endif]-->

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8" />

	<title><?php print $site_title.' - '.$title; if($offline) print ' - '.$lang['server-offline']; ?></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel='stylesheet' href='<?php print $site_url; ?>css/style.css?v=0.33' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php print $site_url; ?>css/flag-icon.min.css' type='text/css' media='all' />
	<link rel="icon" href="<?php print $site_url; ?>images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-default.css" integrity="sha512-kMPqFnKueEwgQFzXLEEl671aHhQqrZLS5IP3HzqdfozaST/EgU+/wkM07JCmXFAt9GO810I//8DBonsJUzGQsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/odometer.min.js" integrity="sha512-v3fZyWIk7kh9yGNQZf1SnSjIxjAKsYbg6UQ+B+QxAZqJQLrN3jMjrdNwcxV6tis6S0s1xyVDZrDz9UoRLfRpWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<script>
	function downloadTxtFile(credentials){
		const fileContent = credentials;
		const fileName = "Ameria_Login_Details.txt";
		
		const blob = new Blob([fileContent], { type: "text/plain;charset=utf-8"});
		
		const url = window.URL.createObjectURL(blob);
		
		const link = document.createElement("a");
		link.href = url;
		link.download = fileName;
		
		link.click();
		
		document.body.removeChild(link);
		
		window.URL.revokeObjectURL(url);
		
}
</script>
</head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-585VRM67');</script>
<!-- End Google Tag Manager -->

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-585VRM67"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header style="">
	<video muted="" autoplay="" loop="" class="fvideo" style="width:100%;height:100%;" preload="metadata">
		<source src="<?php print $site_url; ?>images/header.mp4" type="video/mp4">

	</video>
</header>
<nav class="navbar navbar-dark navbar-expand-lg nav-top-center">
	<div class="container">

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler2"
				aria-controls="navbarToggler2" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarToggler2">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto d-lg-flex align-items-center">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="<?php print $site_url; ?>news"><?php print $lang['news']; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php print $site_url; ?>download"><?php print $lang['download']; ?></a>
				</li>
				<?php if(!$database->is_loggedin()) { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php print $site_url; ?>users/register"><?php print $lang['register']; ?></a>
				</li>
				<?php } else { ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php print $site_url; ?>users/logout"><?php print $lang['logout']; ?></a>
				</li>
				<?php } ?>
				<a class="navbar-brand" href="<?php print $site_url; ?>"><img src="<?php print $site_url; ?>images/logo.png" width="150px" alt="logo"
																			  class="img-fluid"></a>
				<li class="nav-item">
					<a class="nav-link" href="<?php print $social_links['presentation'];?>"><?php print $lang['presentation']; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php print $social_links['discord'];?>">Discord</a>
				</li>
				<?php if($item_shop!="" && $database->is_loggedin()) {?>
					<li class="nav-item">
						<a class="nav-link" href="https://ameria.to/gateway/?uid=<?=getAccountName($_SESSION['id']);?>&uem=<?=getAccountEmail($_SESSION['id']);?>"><?php print $lang['donate']; ?></a>
					</li>
				<?php } else { ?>
<li class="nav-item">
						<a class="nav-link" href="https://ameria.to/gateway/"><?php print $lang['donate']; ?></a>
					</li>
<?php } ?>

			</ul>

		</div>
	</div>

</nav>
<div class="container stat-container">
	<div class="row mb-5 stat-row">
		<div class="col-6 col-lg-3 d-flex justify-content-center">
			<div class="stat-large">
				<span class="stat-desc"><?php print $lang['players-online'];?></span>
				<div class="stat-number stat-odometer" data-stat-key="players-online">
					<span class="odometer" id="players-online">0</span>
				</div>
			</div>
		</div>
		<div class="col-6 col-lg-3 d-flex justify-content-center">
			<div class="stat-large">
				<span class="stat-desc"><?php print $lang['players-online-last-24h'];?></span>
				<div class="stat-number  stat-odometer" data-stat-key="players-online-last-24h">
					<span class="odometer" id="players-online">0</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container main-container">


	<div class="row">
		<div class="col-lg-3 mx-auto">
			<?php include 'include/sidebar/user.php'; ?>
			<?php include 'include/sidebar/guilds.php'; ?>
		</div>
		<div class="col-lg-6 mb-4">
			<?php if ($page == 'news' || 1==1){ ?>
				<div id="carouselNews" class="carousel slide">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="<?php print $site_url;?>images/slider/2.gif" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="<?php print $site_url;?>images/slider/2.gif" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="<?php print $site_url;?>images/slider/2.gif" class="d-block w-100" alt="...">
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselNews" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselNews" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			<?php } ?>
			<div class="main-page p-3">
				<?php include 'pages/'.$page.'.php'; ?>
			</div>
		</div>
		<div class="col-lg-3 mx-auto">
			<?php if(!$offline && $statistics) include 'include/sidebar/statistics.php'; ?>
			<?php include 'include/sidebar/players.php'; ?>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-4  p-0 pe-md-4">
			<a class="large-button" href="<?php print $site_url;?>users/register">
				<img src="<?php print $site_url; ?>images/register-icon.png" alt="register icon" class="img-fluid">
				<span class="large-button-title">CREATE ACCOUNT</span>
				<span class="large-button-subtitle">Join us now</span>
			</a>
		</div>

		<div class="col-md-4 p-0 px-md-2">
			<a class="large-button" href="<?php print $social_links['discord'];?>">
				<img src="<?php print $site_url; ?>images/discord-icon.png" alt="register icon" class="img-fluid">
				<span class="large-button-title">JOIN DISCORD</span>
				<span class="large-button-subtitle">Get in touch with us</span>
			</a>
		</div>
		<div class="col-md-4  p-0 ps-md-4">
			<a class="large-button" href="<?php print $site_url;?>download">
				<img src="<?php print $site_url; ?>images/download-icon.png" alt="register icon" class="img-fluid">
				<span class="large-button-title">DOWNLOAD CLIENT</span>
				<span class="large-button-subtitle">Start playing now</span>
			</a>
		</div>
	</div>
</div>
<div class="container">


<div class="row my-5">
	<nav class="navbar navbar-dark navbar-expand-lg">
		<div class="container">

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler2"
					aria-controls="navbarToggler2" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarToggler2">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto d-lg-flex align-items-center">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="<?php print $site_url; ?>news"><?php print $lang['news']; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php print $site_url; ?>download"><?php print $lang['download']; ?></a>
					</li>
					<?php if(!$database->is_loggedin()) { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php print $site_url; ?>users/register"><?php print $lang['register']; ?></a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php print $site_url; ?>users/logout"><?php print $lang['logout']; ?></a>
						</li>
					<?php } ?>

					<li class="nav-item">
						<a class="nav-link" href="<?php print $social_links['presentation'];?>"><?php print $lang['presentation']; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php print $social_links['discord'];?>">Discord</a>
					</li>
					<?php if($item_shop!="") {?>
						<li class="nav-item">
							<a class="nav-link" href="<?php print $item_shop;?>"><?php print $lang['donate']; ?></a>
						</li>
					<?php } ?>

				</ul>

			</div>
		</div>
	</nav>
</div>
</div>
<div class="footer mt-5">
<center><a target="_blank" href="https://metin2pserver.net/" title="Best Metin2 Pservers Toplist" data-id="2317"><img height="30" src="https://metin2pserver.net/assets/img/metin2-pserver-toplist-logo.png" alt="metin2pserver.net"></a></center>

	<div class="footer-copyright ">
		<div class="container">
			<div class="row py-4 justify-content-between">
				<div class="col-md-4 text-center">
					<p class="text-center mb-1">© <?php print date('Y'); ?> <span class="highlight">Ameria</span>. All rights reserved.</p>
					<div class="d-block">
						<a href="<?php print $site_url;?>tos" class="text-white mx-1">Terms Of Service</a>
						<a href="<?php print $site_url;?>privacy" class="text-white mx-1">Privacy Policy</a>
						<a href="<?php print $site_url;?>rules" class="text-white mx-1">Rules</a>
					</div>

				</div>
				<div class="col-md-4 text-center">
					<img src="<?php print $site_url;?>images/rating.png" alt="logo" class="img-fluid">
				</div>
				<div class="col-md-4 text-center">
					<div class="d-block mb-1">
						<a href="https://inforge.net/" title="Inforge"><img height="20" src="https://i.imgur.com/INGp6Mn.png" alt="Inforge"></a>
						<a href="https://www.metin2downloads.to/" title="Metin2Downloads"><img height="20" src="<?php print $site_url;?>images/m2.svg" alt="Metin2Downloads"></a>

					</div>
					<div class="d-block">
						<a href="https://www.diamwall.com/" title="DiamWall"><img height="20" src="https://lh3.googleusercontent.com/-SiIRQjYbWDA/AAAAAAAAAAI/AAAAAAAAAAA/-U17zPOmQZs/s55-p-k-no-ns-nd/photo.jpg" alt="metin2pserver.net"></a>
						<a href="https://www.elitepvpers.com/forum/"><img height="20" src="https://www.elitepvpers.com/images/logo_xmas.png"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="mini-icons">
	<div class="languagewrapper">
		<a class="current-language flag-icon flag-icon-<?php print $language_code;?>"
		   onmouseover="if (!window.__cfRLUnblockHandlers) return false; enlarge()"
		   onmouseout="if (!window.__cfRLUnblockHandlers) return false; dlarge()"
		   type="button" >
		</a>
		<div class="languages" id="languages" style="width: 0vw; left: -504px;">
			<?php foreach($json_languages['languages'] as $key => $value) { ?>
				<a href="<?php print $site_url;?>?lang=<?php print $key;?>" class="flag-icon flag-icon-<?php print $key;?>"
				   onmouseover="if (!window.__cfRLUnblockHandlers) return false; enlarge()"
				   onmouseout="if (!window.__cfRLUnblockHandlers) return false; dlarge()"
				   style="width: 56px;">
				</a>
			<?php } ?>
		</div>
	</div>

	<div class="youtube text-center">
		<a target="_blank" href="<?php print $social_links['youtube'];?>">
			<i class="bi bi-youtube"></i>
		</a>
	</div>
	<div class="facebook text-center">
		<a target="_blank" href="<?php print $social_links['facebook'];?>">
			<i class="bi bi-facebook"></i>
		</a>
	</div>
	<div class="instagram text-center">
		<a target="_blank" href="<?php print $social_links['instagram'];?>">
			<i class="bi bi-instagram"></i>
		</a>
	</div>
	<div class="discord text-center">
		<a target="_blank" href="<?php print $social_links['discord'];?>">
			<i class="bi bi-discord"></i>
		</a>
	</div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="<?php print $site_url;?>js/app.js" ></script>
<script src="https://kit.fontawesome.com/07a750e727.js" crossorigin="anonymous"></script>
<?php include 'include/functions/footer.php'; ?>
<script>

    function updateStatistics() {
        fetch('<?php echo $site_url; ?>api.php')
            .then(response => response.json())
            .then(data => {
                document.querySelectorAll('.stat-odometer').forEach(element => {
                    const key = element.getAttribute('data-stat-key');
                    const value = data[key] || 0;
                    const odometerElement = element.querySelector('.odometer');

                    if (odometerElement && odometerElement.odometer) {
                        odometerElement.odometer.update(value);
                    }
                });
            })
            .catch(error => console.error('Error fetching statistics:', error));
    }

    window.odometerOptions = {
        format: '(,ddd).dd', // Change how digit groups are formatted, and how many digits are shown after the decimal point
        duration: 2000, // Change how long the javascript expects the CSS animation to take

    };

    updateStatistics();

    setInterval(updateStatistics, 3000); // Update every
</script>
</body>
<a class="discord-widget" href="<?php print $social_links['discord'];?>" title="Join us on Discord">
<img src="https://discordapp.com/api/guilds/1257778421014990948/embed.png?style=banner2">
</a>
		<style>
		
.discord-widget {
   width:250px;
   transition-property: right;
   transition-duration: 2s;
   -webkit-transition-property: right; /* Safari */
   -webkit-transition-duration: 2s; /* Safari */
   position: fixed;
   bottom: 20px;
   left: 20px;
   z-index:10;
}
.discord-widget.active
{
   right: 20px;
}
</html>

