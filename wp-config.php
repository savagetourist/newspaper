<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'newspaper' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'newspaper' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'qweasdzxc123' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '])L.lp}7e)/]3!k9Fy!$Ik}hYjc0B|BEjBj7*V?0?db,C /MK,FHu#tCGJr0<9xf' );
define( 'SECURE_AUTH_KEY',  ']{#Rggc$8U:R-9!6}5;;;cC@e_,<1Zkmc@ n8!h{.qb#XB~l{Y~Gn^fD$dqwo1G-' );
define( 'LOGGED_IN_KEY',    'B|G?hHxGD qZ>?V=xE}G4 3iEcFR?@N1M.#j u5vC7.xs1(aT2nFlL)V&l)d?uO*' );
define( 'NONCE_KEY',        '~DY4C$2LtuqK[QQ3:70SeKB3[c[V!bz5X3[)F+3D*@{|_:<,c^A^O:!{I0u.6cs(' );
define( 'AUTH_SALT',        '*k$`)|t@t8Vl)yV?|OmbVaJQi(Qa+c$:3Qr~Q$UP@RImc)9>8GaR{pg0C-yeY!v*' );
define( 'SECURE_AUTH_SALT', 'N)5oQE)B|:l3+%{8y&EI~BR/++Ue*MI{-/f__XhX:z[7K#d[]v2HDn?C:6{J zF5' );
define( 'LOGGED_IN_SALT',   ']w#-r>a)X>O3gpF -X}]3t;7I/PDQGEe2k7wJ|_hw[V9[=Q.0<tbmRcs5W<Am&)J' );
define( 'NONCE_SALT',       'Y]RVycUZd/c_5Va$3fp y4@~ei;[f=ITs11K`-BByLXF@pxN?[):bN-lk;&p }gl' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'la_';

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

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
