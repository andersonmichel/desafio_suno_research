<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress_dsr_anderson_michel' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'g&JF`>+lh3!P+]dh O6W1Gb?@<0! e$sjC/X@Wvc8.Z8|{+wFb,A wEWD6yJ>67=' );
define( 'SECURE_AUTH_KEY',  'M`?!;SLk;n!~B-kvQ4+Xy3]E5WPBDx:2)[Dy<VRia-aQg1Z1pc4$f]5> ?|sI$D[' );
define( 'LOGGED_IN_KEY',    '`%e7lu!/e{_PxR?ui#_Zu6O*W!9[HcSfpw~{o^aVU3 ((W5!.=0i*9t|h~Wev7JJ' );
define( 'NONCE_KEY',        'h!1Dgcr$${OOYkS@0+YYW]{@!h!`hFN.?X3&/|Lve=ItKtI}Kj<AE&!AJAwF&*Yh' );
define( 'AUTH_SALT',        'vHUUeSl?D:Xr`#K8tQj0:.?dO^P&DZ|m+6R(W~dY#Ox<s,L/}uMhyJFdNX,9y@ P' );
define( 'SECURE_AUTH_SALT', 'k(l+[kDcS.cISPNBI *Z]gR1L`DR-.Z7Y_=)eW}v_xWz?)mJfVodl7R3NxzpBGx.' );
define( 'LOGGED_IN_SALT',   ']r>uy&nzG]]NOpN~$$x7yeJHnwEfB%8k4e=U.P-K)]#2a8mep)ZI#k%6s`?t9FUE' );
define( 'NONCE_SALT',       '3)u(TXMC4v7etAmr9%FT93CT5dYJc+]oHG]KFMNJ BLmh?R|AkF0}( %cqIcLrE9' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
