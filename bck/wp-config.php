<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'basmach_pm');

/** Имя пользователя MySQL */
define('DB_USER', 'basmach_pm');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'SY4vaeTn');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'E|Vr/&GAy2p jtmL~y8uYa=>?KDyap3BU+@;`):zuMG[@}UWU,}?|ZF+F8w9C:_+');
define('SECURE_AUTH_KEY',  'LcK%#rT:ov94?csc+P.A=#1;j.b[CLtCWTS*VPAwV!CU;mP.V.ymTw -4+9CWn,1');
define('LOGGED_IN_KEY',    '|OnPcuzhur*E{cF^vl3c_;2t$;qhjl`7-/$ji^;ijnfC&ZjHK!@(s-UeO)y|[O]p');
define('NONCE_KEY',        'I+5!=-V9i;C=;*Jn@1fh|&[V536!ddJkRD>4|otIfa-iAuulvBavj*$4^m$ow{la');
define('AUTH_SALT',        'KaM/gvFZQ`%%hwJQn>V]x*.>[OJ[+)mI$(mx%K|uk3e.c8{/F8^?OdGm{9)mNEL$');
define('SECURE_AUTH_SALT', 'awI(v+h.2GEewY?|kz~5h1Ag9qDj25-yam+fI^a/:5*_~KW7ErDjNB;i&,Qp8%,@');
define('LOGGED_IN_SALT',   '-.Z R),tryvI6TELV 0G8ft=RhHz.wMQDQD[+,~]3@.XsKt&Q/-MEZ6V=PihFnO=');
define('NONCE_SALT',       '6HK*|%L^a{nI-g:1-?>[*`7j$#pQN(UR8(Pw9ZCo#p~Mf>:}O6mEiF##< y|B -8');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
