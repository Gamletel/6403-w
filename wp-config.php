<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', '6403.localhost' );

/** Имя пользователя базы данных */
define( 'DB_USER', '6403.localhost' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '6403.localhost' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nE~SDd-m.{7MaO]Z@5](|7+K*DySCm&rU_LUn8<[G:D=Hm:Pz=VDkI{hsv9b$M93' );
define( 'SECURE_AUTH_KEY',  'dPg,@9;|sDwJOfu7TVH^ggwh4BB+p4JSh1xf2tfpv}[,A#?x~YTIL`F6UG)%f r?' );
define( 'LOGGED_IN_KEY',    '%}{Lg.=XlJsk4D#|kGg{+4bs:>3frM>}_(v?udiu3WZTN?haC~}+,+{=Q<$LUFt>' );
define( 'NONCE_KEY',        'q@u9/><m,;c(R)U_-oyUc<HoNUARuJnb^_=I#C5TYNu![!Ulfy(@;WYS:_}Zi^R3' );
define( 'AUTH_SALT',        'phvH%VW[=[$WOL[O2yX_>At+d-V4J_(H&`PEep5+Ks)SuS-9>wnporvpvBU7!{T ' );
define( 'SECURE_AUTH_SALT', '3N%^rb(3aJ!$qJza0)ag!^ n<^_B?RseqquhMa4s/wFWld5bS*a:Q@m^?5;&KpVF' );
define( 'LOGGED_IN_SALT',   'N56Tx0|WQ3<$_B!l7%m)o}m[n>TB?Pc!(%3N$OdfIPvq5&y=aJB-23Y7zLkx.@B6' );
define( 'NONCE_SALT',       'FO*Y{@-2?C6?Uj6ql]y_c$zv*[W|T;e_GI=:,DLOJL6r<uXSn!DY/h?K-O7gmf(*' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
