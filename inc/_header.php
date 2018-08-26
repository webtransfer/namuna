<?
$start_counter = microtime(); 
$start_counter_array = explode(" ",$start_counter); 
$start_counter = $start_counter_array[1] + $start_counter_array[0]; 
?>

<?PHP
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>

<html>
	<head>
		<title>24Invest.Biz | {!TITLE!}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
		<meta name="description" content="{!DESCRIPTION!}">
		<meta name="keywords" content="{!KEYWORDS!}">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Exo+2:300,400,500&amp;subset=cyrillic,latin-ext" rel="stylesheet"> 
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/css/common.css" rel="stylesheet" type="text/css" />
		
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/js/functions.js"></script>
		<link rel="icon" href="./favicon.png">
	</head>
	<body>
<?
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();

$newsus = $user_data["news"];

$numnews = 0;
$db->Query("SELECT * FROM db_news ORDER BY id DESC");
while($newses = $db->FetchArray()){
$numnews = $numnews+1;
}
?>
<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment,
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();
?>

<style>
#blink {
	color: #bf4f8f;
	font-size: 14px;
}
</style>

<div class="container fone">
<header>
		<div class="header-top">
			Мы выплатили: <span style="display: inline;"><?=sprintf("%.2f",($stats_data["all_payment"])); ?> РУБ.</span>
			Старт проекта: <span>01.09.2018 года.</span>		
		</div>
		<div class="headerContainer">
			<div class="headerInner">
				<a href="/" id="logo"></a>
				<div class="mainNavRight">
					<div class="navbar">
						<div class="navbar-inner">
							<ul class="nav">
					<?php if($numnews == $newsus){ ?>
					<li><a href="/news">Новости</a></li>
					<?php } else if($numnews > $newsus) { $newsplus = $numnews-$newsus; ?>
					<li><a href="/news"><font id="blink">Новости</font></a></li>
					<?php } ?>
					<li><a href="/about">О нас</a></li>

	<?php if ($_SESSION["user_id"]) : ?>
		<li><a href="/serfing">Букс</a></li>
	<?php endif;?>
	<?php if (!$_SESSION["user_id"]) : ?>
		<li><a href="/serfing_guest">Букс</a></li>
	<?php endif;?>

					<li><a href="/rules">Правила</a></li>
					<li><a href="/help">Контакты</a></li>
	<?php if ($_SESSION["user_id"]) : ?>
<li><a class="signup" href="/profile">Аккаунт</a></li>
<li><a class="login" href="/output">Выход</a></li>
	<?php endif;?>
	<?php if (!$_SESSION["user_id"]) : ?>
<li><a  class="signup" href="/signup">Регистрация</a></li>
<li><a class="login" href=".login" data-toggle="modal">Вход</a></li>
<?php endif;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end headerContainer -->

<?php if($_SERVER['REQUEST_URI']=='/' && $_SERVER['REQUEST_URI']!='/index') {  ?>
	<div>
        		<div class="bannerContainer">
			<div class="bannerInner">
				<div class="ctn-banner bannerLeft">
					<h3>ИНВЕСТ ПЛАН</h3>
					<p> <strong>11%-13%</strong> день <span>|</span> <strong>330%-390% </strong> месяц</p>
					<p>Окупаемость за 9 дней</p>
					<p>Инвестиции от 100 до 50.000 рублей </p>
				</div>
				<div class="ctn-banner bannerRight">
					<h3>БЕЗ РИСКА</h3>
					<p>Инвестиции на <strong> 30 дней </strong></p>
					<p>Индивидуальные тарифные планы</p>
					<p>Продуманный маркетинг. </p>
				</div>
			</div>
		</div><!-- end bannerContainer -->
	</div>
<div class="balanceInner">
	<h3>бонус <strong>10 РУБ.</strong> НА БАЛАНС ДЛЯ ПОКУПОК ЗА РЕГИСТРАЦИЮ. </h3>
	<a href="/signup">УЖЕ РЕГИСТРИРУЮСЬ</a>
</div>

<div class="commissionContainer">
  <div class="commissionInner">
    <div class="cms-left">
      <div class="cms-left-row cms-left-row1">
        <p>баннеры</p>
      </div>
      <div class="cms-left-row cms-left-row2">
        <p>рефералы</p>
      </div>
      <div class="cms-left-row cms-left-row3">
        <p>заработок</p>
      </div>
    </div>
    <div class="cms-right">
      <h3>Реферальная программа</h3>
      <span></span>
      <h4>1-уровень = 10%, 2-уровень = 5%, 3-уровень = 1%</h4>
    </div>
    <div class="clear-fix"> </div>
  </div>
</div>
<?php
 } // Главная страница
?>

<?php if($_SERVER['REQUEST_URI']!='/' && $_SERVER['REQUEST_URI']!='/index') {  ?>
<center>
	<h2 style="text-transform: uppercase;color: #ffe5fd;">{!TITLE!}</h2><br/><br/>
</center>
<?PHP 
} // Остальные страницы
 ?>
 
</header>


<div class="container">

	<div class="row">
<?PHP
	include("inc/_menu_left.php"); 
?>

	<div class="col-md-12">
