<?php

##################################################################################################################
###### ОБЯЗАТЕЛЬНЫЕ НАСТРОЙКИ ####################################################################################
##################################################################################################################

$dbhost 		= "localhost";				# MySQL хост
$dbname 		= "";		 		# MySQL база
$dbuser 		= "";		 		# MySQL пользователь
$dbpass 		= "";				# MySQL пароль

$full_www_path 		= "";				# Полный WWW (http/https) путь к папке, где лежат скрипты биллинга с символом / в конце. Пример: http://www.myhost.net/
$admin_script 		= "";				# Имя файла скрипта админки. По умолчанию: admin.php
$PWD_ENCODE_KEY		= "";				# Ключ, используемый для кодирования паролей, хранимых в БД. Необходимо установить значение длиной не менее 20 символов и в дальнейшем не изменять его!!!

##################################################################################################################
###### Настройки внешнего вида клиентской части биллинга  ########################################################
##################################################################################################################

$CLIENT_TEMPLATE	= "default_web";				# Шаблон клиентской части. По умолчанию: default

$BILLING_START_PAGE	= "";				# ID страницы (значение переменной $do для billing.php), отображаемой клиенту после аутентификации в биллинге. Пример: domains
$TARIFS_ROWS_CNT 	= 5;				# Количество столбцов с тарифами в строке на странице тарифных планов billing.php?do=tarifs
$DOMAINSHOP_ROWS_CNT 	= 6;				# Количество столбцов с доменами в строке на странице магазина доменов billing.php?do=domainshop

$orderTableWidth	= "550";			# Ширина таблиц на странице оформления заказа (только для шаблона default).

##################################################################################################################
###### Дополнительные настройки ##################################################################################
##################################################################################################################

$_CFG['UPDATER_STRICT_MODE_DISABLED'] = false;		# Отключить строгий режим работы для Automatic Billing Updater.
$BILLING_DEBUG		= true;				# Вывод ошибок PHP в браузер. Рекомендуется включать только на этапе установки/настройки. По умолчанию: true (включено)
$BILLING_USAGE		= true;			# Отображение времени выполнения скриптов и используемой ими памяти.

$VALID_EMAIL_CHECKMX	= false;			# Проверка e-mail адреса клиента (при регистрации, сохранении настроек и сохранении профайла) с помощью попытки получить MX-записи для домена а, в случае неудачи, попытки подключиться на 25-й порт домена.
$DISABLE_MODAL_USERINFO = false;			# Отключить модальное окно с подробной информацией о клиенте при клике на стрелочку возле логина клиента.

$PHPPATH 			= "";			# Полный путь к компилятору PHP. По умолчанию: /usr/bin/php
$LOGIN_INCLUDE_SCRIPT		= "";			# Имя PHP-скрипта, включая полный путь к нему, который с помошью php-функции include будет подключен/выполнен в случае успешной авторизации клиента в биллинге.
$CREATESERVERACC_INCLUDE_SCRIPT	= "";			# Имя PHP-скрипта, включая полный путь к нему, который с помошью php-функции include будет подключен/выполнен в случае успешной обработки заказа (автоматическое создание аккаунта на сервере).

$HYPERVM_DEFAULT_OS 	= "altlinux-20060928-x86_64";	# OS по умолчанию (если клиент не указал OS при заказе) для HyperVM.
$SOLUSVM_DEFAULT_OS 	= "centos-5-x86_64-devel";	# OS по умолчанию (если клиент не указал OS при заказе) для SolusVM.
#$_CFG['SOLUSVM_HOSTNAME_TPL'] = "vps{id}.domain.com";	# Шаблон для hostname виртуальной машины, создаваемой в SolusVM.
#$_CFG['VMMANAGER_HOSTNAME_TPL'] = "{login}.{id}.vm";	# Шаблон для hostname виртуальной машины, создаваемой в VMManager.
$VMMANAGER_DEFAULT_OS 	= "Centos-6-amd64-ispmgr5";	# OS по умолчанию (если клиент не указал OS при заказе) для VMManager.
$VDSM_ADD_PREFIX_TO_OS	= false;			# Если включено, то к имени образа OS, который указан в текстовом идентификаторе соответствующей доп. услуги, добавляем префикс "-ispmanagerlite" или "-ispmanagerpro", если заказана Панель управления с текстовым идентификатором Lite или Prof.

$GAMECP_USE_LOGIN	= false;			# Если включено, то для входа в GameCP-аккаунт клиента используем логин, а не эмейл.
$FICORAFI_ENABLE 	= false;			# Поддержка регистратора Ficora.fi.
$PRIVATBANK_TEST	= false;			# Тестовый режим работы эквайринга от ПриватБанка.
$WEBPAY_TEST 		= false;			# Тестовый режим работы с платежной системой WebPay.by.

##################################################################################################################
###### Логирование запросов к биллингу ###########################################################################
##################################################################################################################

$BILLING_LOG_GET	= false;			# Логировать все GET-запросы к скриптам клиентской части биллинга.
$BILLING_LOG_POST	= false;			# Логировать все POST-запросы к скриптам клиентской части биллинга.
$BILLING_LOG_DIR	= "";				# Папка в которую складывать логи запросов (нужно указать полный путь к папке от корня сервера). Каждый день в папке будет создаваться отдельный лог-файл.

$BILLING_LOG_FILES	= false;			# Логировать все файлы, загружаемые на сервер через клиентскую часть биллинга. Логируется как факт загрузки, так и создается копия файла.
$BILLING_LOG_FILES_DIR	= "";				# Папка в которую складывать копии загружаемых файлов (нужно указать полный путь к папке от корня сервера).

##################################################################################################################
###### НЕ ИЗМЕНЯТЬ ###############################################################################################
##################################################################################################################

error_reporting(E_ALL ^ E_NOTICE); if ( $BILLING_DEBUG ) { ini_set('display_errors', 1); } else { ini_set('display_errors', 0); }
$full_home_path = dirname(__FILE__); require_once($full_home_path.'/_rootfuncs.php');

?>
