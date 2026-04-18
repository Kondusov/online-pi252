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
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'o#oaZQy *NUp(,?M6~vC_hy@gmI$t}%uTfNBh9$-~q4<[:0;L-8CF@~+1$8Y$8x0' );
define( 'SECURE_AUTH_KEY',  'Fm]RF90-}6OKP^Ml&qU#i|i:jDQOp]O):].SM{itp^(  h$`.C$vT&>[`moCocDZ' );
define( 'LOGGED_IN_KEY',    'E_7z[o}.QLf=:Aa]h#wAlPtqUCSA_g`n{|!B .zd1GfuE-K,}BNAL@Kb-o^}U3g%' );
define( 'NONCE_KEY',        'rn=(}rgA><2GH:IIew%[yfuO0heLp,Z!,eIh; U.k$2_8>H7:U%g@j!IdH<t{{2.' );
define( 'AUTH_SALT',        '/E%P0A]Bs@AGHKKW(qO`sAzuXNu[r^p/1FY)_0GlFQCIXHQ-bH-J/Rj]upxD.|9H' );
define( 'SECURE_AUTH_SALT', '253[6phh@V82`CDQ5|3L^|>#O 1+X%A:N7rBZcn,)j&_j-IXhXY3;_i{C/FpwZV5' );
define( 'LOGGED_IN_SALT',   'xJS@-ogBsMCN{Z>w7@5?qYQXsvCG$Y8a]AMB04_!9S^>)vD-sq|U*uRs]o9y1[6I' );
define( 'NONCE_SALT',       'vFGO6$AhUo<+VgS@:5hW(gRJbi5K$pc,/!$IOzc3kS5//C>D:lKE_3QxJ}pEa^q:' );

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

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
