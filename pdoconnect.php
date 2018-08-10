<?php

/**

* PDO bilan ulanish + Sql inj himoya

* ---===Prolive===---

* 13.09.17

*/



$host = 'localhost'; // host

$db = 'database_name'; // baza nomi

$user = 'root'; // baza user

$password = 'password'; // parol



// baza bilan aloqa o'rnatamiz!

$db = new PDO("mysql:host=$host;dbname=$db", $user, $password,

array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));



//kod orqali tablitsa tuzamiz (id|user|time)

$q = $db->prepare("CREATE TABLE IF NOT EXISTS `test` (

`id` int(10) unsigned NOT NULL auto_increment,

`user` varchar(20) NOT NULL,

`time` timestamp NOT NULL default CURRENT_TIMESTAMP,

PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8; ");



// so'rovni bajaramiz

$q->execute();



// endi bazaga so'rov junatamiz

$q = $db->prepare("INSERT INTO test SET user=? ");

$q->execute(array('foydalanuvchi1'));



/*
Bazaga so'rov jo'natdik

Nazar bilan qarang hech qanday filter qo'yilmadi

(mysql_real_escape_string), endi bizga bu kerak emas

? Belgisi, va unga nima qo'yilishini execute da ko'rsatamiz

*/




//oxirgi idni aniqlash

$id = $db->lastInsertId();



// update so'rovi

$db->prepare("UPDATE test SET user=? WHERE id=? ")->execute(array("yangi nomi", $id));



/*

->()-> hozir men so'rovni ketma ketlikda bajardim bu qulayroq!

Agar yoqmasa yuqoridagidek $q dek ishlatsa xam buladi

Параметры в массиве должны идти в строгом порядке, как в запросе,

действительно, будет нелепо перепутать id и name местами ;)

Даже не смотря на то, что в параметре присутствует кавычка запрос выполянется нормально,

pdo все экранирует самостоятельно.

*/



// agar sizga ? Lar yoqmasa bunday ishlatsa xam buladi

$db->prepare("INSERT INTO test SET user=:user ")->execute(array(':user'=>'foydalanuvchi1'));

/*

Теперь массив с параметрами не такой безликий как раньше, какой способ задания параметров

выбрать решайте сами

*/



// agar ma'lumotni bazadan chiqarmoqchi bulsangiz mana:

$q = $db->prepare("SELECT * FROM test");

$q->execute();

$data = $q->fetchAll();



print_r($data);
