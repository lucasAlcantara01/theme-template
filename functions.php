<?php

function theme_enqueue_script()
{
  $script_path = get_template_directory() . '/dist/bundle.js';
  $script_uri  = get_template_directory_uri() . '/dist/bundle.js';

  wp_enqueue_script(
    'bundle-script',
    $script_uri,
    array(),
    filemtime($script_path), // Versão baseada na modificação do arquivo
    true
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');

function theme_enqueue_styles()
{
  $style_path = get_template_directory() . '/dist/style.css';
  $style_uri  = get_template_directory_uri() . '/dist/style.css';

  wp_enqueue_style(
    'bundle-style',
    $style_uri,
    array(),
    filemtime($style_path)
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


// Funções para Limpar o Header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');


add_theme_support('post-thumbnails');
add_theme_support('menus');


function custom_excerpt_length($length)
{
  return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length');

function setPostViews($postID)
{
  $countKey = 'post_views_count';
  $count = get_post_meta($postID, $countKey, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $countKey);
    add_post_meta($postID, $countKey, '0');
  } else {
    $count++;
    update_post_meta($postID, $countKey, $count);
  }
}

//menus

function registrar_menu_principal()
{
  register_nav_menu('header-principal', __('Header Principal'));
}


function registrar_menu_mobile()
{
  register_nav_menu('menu-mobile', __('Menu Mobile'));
}

function registrar_menu_footer()
{
  register_nav_menu('menu-footer', __('Menu Footer'));
}

function registrar_menu_servicos()
{
  register_nav_menu('menu-servicos', __('Menu Serviços'));
}

function registrar_menu_categorias()
{
  register_nav_menu('menu-categorias', __('Menu Categorias'));
}

function registrar_menu_traducao()
{
  register_nav_menu('menu-traducao', __('Menu Tradução'));
}

add_action('init', 'registrar_menu_principal');
add_action('init', 'registrar_menu_mobile');
add_action('init', 'registrar_menu_footer');
add_action('init', 'registrar_menu_servicos');
add_action('init', 'registrar_menu_categorias');
add_action('init', 'registrar_menu_traducao');



// acf_add_options_page(array(
// 'page_title' 	=> 'Informações',
// 'menu_title'	=> 'Editar Informações',
// 'menu_slug' 	=> 'editar-informacoes',
// 'icon_url' => 'dashicons-align-center',
// 'redirect'		=> false
// ));

// acf_add_options_page(array(
// 'page_title' 	=> 'Rodapé',
// 'menu_title'	=> 'Editar Rodapé',
// 'menu_slug' 	=> 'editar-rodape',
// 'icon_url' => 'dashicons-align-center',
// 'redirect'		=> false
// ));








function theme_custom_logo_setup()
{
  $defaults = array(

    'width'                => 100,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array('site-title', 'site-description'),
    'unlink-homepage-logo' => true,
  );

  add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'theme_custom_logo_setup');
