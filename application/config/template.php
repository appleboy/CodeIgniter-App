<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * default layout
 * Location: application/views/
 */
$config['template_layout'] = 'template/layout';

/**
 * default css
 */
$config['template_css'] = array(
    '/assets/css/bootstrap.min.css' => 'screen',
    '/assets/css/bootstrap-theme.min.css' => 'screen'
);

/**
 * default javascript
 * load javascript on header: FALSE
 * load javascript on footer: TRUE
 */
$config['template_js'] = array(
    '/assets/js/jquery.min.js' => true,
    '/assets/js/bootstrap.min.js' => true
);

/**
 * default variable
 */
$config['template_vars'] = array(
    'site_description' => 'CodeIgniter App',
    'site_keywords' => 'CodeIgniter App'
);

/**
 * default site title
 */
$config['base_title'] = 'CodeIgniter App';

/**
 * default title separator
 */
$config['title_separator'] = ' | ';
