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
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="{!DESCRIPTION!}">
		<meta name="keywords" content="{!KEYWORDS!}">
		
		<title>24Invest.Biz | {!TITLE!}</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="/css/ionicons.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/demo.css" />
    <!--Google Webfont-->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
    <!--Favicon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="icon" href="./favicon.png">
	</head>
	<body>

    <!-- Header
    ================================================= -->
		<header id="header" class="lazy-load">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <?php if($numnews == $newsus){ ?>
					<li class="dropdown"><a href="/news">Новости</a></li>
					<?php } else if($numnews > $newsus) { $newsplus = $numnews-$newsus; ?>
					<li class="dropdown"><a href="/news"><font id="blink">Новости</font></a></li>
					<?php } ?>
                <li class="dropdown"><a href="/about">О нас</a></li>

	<?php if ($_SESSION["user_id"]) : ?>
		<li class="dropdown"><a href="/serfing">Букс</a></li>
	<?php endif;?>
	<?php if (!$_SESSION["user_id"]) : ?>
		<li class="dropdown"><a href="/serfing_guest">Букс</a></li>
	<?php endif;?>

					<li class="dropdown"><a href="/rules">Правила</a></li>
					<li class="dropdown"><a href="/help">Контакты</a></li>
	<?php if ($_SESSION["user_id"]) : ?>
<li class="dropdown"><a class="signup" href="/profile">Аккаунт</a></li>
<li class="dropdown"><a class="login" href="/output">Выход</a></li>
	<?php endif;?>
	<?php if (!$_SESSION["user_id"]) : ?>
<li class="dropdown"><a  class="signup" href="/signup">Регистрация</a></li>
<li class="dropdown"><a class="login" href=".login" data-toggle="modal">Вход</a></li>
<?php endif;?>
            </ul>
           
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->
      <section id="demo-banner">
    <div class="container">
     
    	<div class="row">
        <div class="logo"><a href="/"><img src="/images/logo.png" alt="" /></a></div>
        <h1 class="text-white"> Мы выплатили: </h1><div id="incremental-counter" data-value="<?=sprintf("%.2f",($stats_data["all_payment"])); ?>"></div> <h1> РУБ. </h1> <br>
            
        <div class="preview-img">
         
        </div>
      </div>
     
    </div>
  </section>





  <div id="page-contents">
    	<div class="container">
    		<div class="row">

<?php if($_SERVER['REQUEST_URI']=='/' && $_SERVER['REQUEST_URI']!='/index') {  ?>
                    <div class="col-lg-12">
					<div class="feature-item col-md-6">
					<center><i class="fa fa-bank" style="font-size: 45px;"></i>
					<h3>ИНВЕСТ ПЛАН</h3>
					<h4 style="color: #333;"> <p><strong>11%-13%</strong> день <span>|</span> <strong>330%-390% </strong> месяц</p>
					<p>Окупаемость за 9 дней</p>
					<p>Инвестиции от 100 до 50.000 рублей </p></h4>
                    </center>
					</div>
					<div class="feature-item col-md-6">
                    <center><i class="fa fa-industry" style="font-size: 45px;"></i>
						<h3>БЕЗ РИСКА</h3>
					<h4 style="color: #333;"><p>Инвестиции на <strong> 30 дней </strong></p>
					<p>Индивидуальные тарифные планы</p>
					<p>Продуманный маркетинг. </p></h4>
                      </center>
					</div>
                   
					</div>
				
        		
				
			

<div class="col-lg-12">
	<h3>Бонус <strong>10 РУБ.</strong> НА БАЛАНС ДЛЯ ПОКУПОК ЗА РЕГИСТРАЦИЮ.
	<a class="btn btn-primary" href="/signup">УЖЕ РЕГИСТРИРУЮСЬ</a> </h3>

</div>


<div class="col-lg-12">
      <div class="col-lg-4"><center>
      <p><img src="/img/baner.png"></p>
        <h3>Баннеры</h3>
        </center></div>
       <div class="col-lg-4"><center>
        <p><img src="/img/ref.png"></p>
        <p><h3>Рефералы</h3></p>
           </center></div>
       <div class="col-lg-4"><center>
        <p><img src="/img/money.png"></p>
        <p><h3>Заработок</h3></p>
         </center></div>
         <div class="line-divider"></div>
         <br><br>
</div>
    <div class="col-lg-12">
    <center><img src="/img/referal.png"><center><br>
      <h3>Реферальная программа</h3>
       
      <span></span>
      <h3>1-уровень = <font style="color: red">10%</font>, 2-уровень = <font style="color: red">5%</font>, 3-уровень = <font style="color: red">1%</font></h3>
        <div class="line-divider"></div>
    </div>
 

<?php
 } // Главная страница
?>

<?php if($_SERVER['REQUEST_URI']!='/' && $_SERVER['REQUEST_URI']!='/index') {  ?>
<center>
	<h2>{!TITLE!}</h2><br/><br/>
</center>
<?PHP 
} // Остальные страницы
 ?>

<?PHP
	include("inc/_menu_left.php"); 
?>

