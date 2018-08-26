<?php
$_OPTIMIZATION["title"] = "Просмотр сайтов";

error_reporting(E_ALL);
ini_set('display_errors', 0);

define('TIME', time());

$db->Query("SELECT * FROM db_users_a WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchArray();

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

if (isset($_GET['delete']))
{
  $id = (int)$_GET['delete'];
  
  if (isset($_SESSION['admin']))
  {
    $db->query("SELECT money, user_name FROM db_serfing WHERE id = '".$id."' LIMIT 1");
 
    $result = $db->FetchArray();
  
    $db->query("UPDATE db_users_b SET money_b = money_b + '".$result['money']."' WHERE user = '".$result['user_name']."'");
  
    $db->query("DELETE FROM db_serfing WHERE id = '".$id."'");
    $db->query("DELETE FROM db_serfing_view WHERE ident = '".$id."'");
  }  
} 
?>

<p style="text-align: center;">Получайте деньги за просмотр сайтов: перейдите на сайт рекламодателя, дождитесь завершения таймера и введите капчу, оплата начисляется сразу на счет для вывода за каждый просмотр!</p>
<center>
<a href="/serfing/add" class="btn btn-success">Добавить ссылку</a>
<a href="/serfing/cabinet" class="btn btn-success">Мои ссылки</a></center>
<br>


<script>
 
function getHTTPRequest()
{
    var req = false;
    try {
        req = new XMLHttpRequest();
    } catch(err) {
        try {
            req = new ActiveXObject("MsXML2.XMLHTTP");
        } catch(err) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(err) {
                req = false;
            }
        }
    }
    return req;
}

jQuery(document).ready(function(){
    $(".normalm").click(function(e){
        var oLeft = 0, oTop = 0;
        element = this;
        if (element.className == 'normalm') {
            do {
                oLeft += element.offsetLeft;
                oTop  += element.offsetTop;
            } while (element = element.offsetParent);
            var sx = e.pageX - oLeft;
            var sy = e.pageY - oTop;
            var elid = $(this).attr("id");
            fixed(elid, sx, sy);
        }
    }); 
})                

function goserf(obj)
{
    obj.parentNode.innerHTML = "<span class='textgreen'>Спасибо за визит</span>";
    return false;
}

function fixed(p1, p2, p3)
{
    var myReq = getHTTPRequest();
    var params = "p1="+p1+"&p2="+p2+"&p3="+p3;
    function setstate()
    {
        if ((myReq.readyState == 4)&&(myReq.status == 200)) {
            var resvalue = myReq.responseText;
            if (resvalue != '') {
                if (resvalue.length > 12) {
                    if (elem = document.getElementById(p1)) {
                        elem.style.backgroundImage = 'none';
                        elem.className = 'goadvsite';
                        elem.innerHTML = '<div><a target="_blank" href="/'+resvalue+'" onclick="javascript:goserf(this);">Просмотреть сайт рекламодателя</a></div>';
                    }
                } else {
                    if (elem = document.getElementById(resvalue)) {
                        $(elem).fadeOut('low', function() {
                            elem.innerHTML = "<td colspan='3'></td>";
                        });
                    }
                }
            }
        }
    }
    myReq.open("POST", "/ajax/us-fixedserf.php", true);
    myReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myReq.setRequestHeader("Content-lenght", params.length);
    myReq.setRequestHeader("Connection", "close");
    myReq.onreadystatechange = setstate;
    myReq.send(params);
    return false;
}
</script> 

<link rel="stylesheet" href="/css/main.css" type="text/css" />


<table class="table work-serf" style="background: #fff; border: 1px solid #ddd;">

<?php
$db->query("SELECT ident, time_add FROM db_serfing_view WHERE user_id = '".$_SESSION['user_id']."' and time_add + INTERVAL 24*60*60 SECOND > NOW()");

while ($row_view = $db->FetchArray()) {
$visits[$row_view['ident']] = $row_view;    
}

$db->Query("SELECT * FROM db_serfing WHERE money >= price and status = '2' ORDER BY high DESC, time_add DESC");

if ($db->NumRows()) {  
while ($row = $db->FetchArray()) {

if (isset($visits[$row['id']])) continue;

if ($row['speed'] > 1) {             
if (mt_rand(1, $row['speed']) != 1) continue;
} 

$high = ($row['high']) ? 'serfimghigh' : 'serfimg';
$pay_user = number_format($row['price'] - $row['price'] * (30/100), 3); //оплата пользователю 

?>

<tr id="tr<?php echo $row['id']; ?>">

<td class="normal" width="40" valign="middle">
<span id="adstatus<?php echo $row['id']; ?>" class="<?php echo $high; ?>" title="Реклама: ID <?php echo $row['id']; ?>, Рекламодатель: <?php echo $row['user_name']; ?> | <?php echo $row['url']; ?>"></span>
</td>

<td id="<?php echo $row['id']; ?>" class="normalm" valign="middle">
<?php echo $row['title']; ?><br />

<span class="desctext"><?php echo $row['desc']; ?></span> 
</td>

<td class="normal" nowrap="nowrap" valign="middle" style="width: 60px; text-align: right; padding-right: 10px;">
<span class="badge" title="Осталось визитов"><?php echo (int)($row['money']/$row['price']); ?></span>&nbsp;<span style="font-size: 18px;" class="text-success"><?php echo $pay_user; ?> руб.</span><br />
<?php if (isset($_SESSION['admin'])) { ?><a class="workcomp" href="/serfing/delete/<?php echo $row['id']; ?>" title="Удалить ссылку и вернуть деньги"></a><?php } ?>
<a class="workevents" href="/wall/<?php echo $row['user_name']; ?>" title="Рекламодатель" target="_blank"></a>
<a class="workvir" href="http://online.us.drweb.com/result/?url=<?php echo $row['url']; ?>" title="Проверить ссылку на вирусы" target="_blank"></a>
</td>

</tr>

<?php
}
?>
<?
}
else
{
?>
<div class="alert alert-danger"><b>В серфинге пока нет рекламы!</b></div>
<?
} 
?>
</table>


<center>
<a href="/serfing/add" class="btn btn-success" style="margin:10px 0;">Разместить ссылку</a>
</center>
