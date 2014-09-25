<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Lang extends CI_Lang
{
    /*
     * default language list form config file
     */
    private $_language_list;
    /*
     * default language field form $_POST or $_GET or $_SESSION
     */
    private $_language_field;
    /*
     * default language
     */
    private $_language_key;
    /*
     * default language folder
     */
    private $_language_folder;
    /*
     * default prefix on language array key
     */
    private $_language_prefix;

    public function __construct()
    {
        parent::__construct();
    }

    public function load($langfile = '', $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
    {
        $this->_set_language();
        $CI =& get_instance();

        $langfile = str_replace('.php', '', $langfile);
        // add prefix on language key
        $this->_language_prefix = $langfile;

        if ($add_suffix == TRUE) {
            $langfile = str_replace('_lang.', '', $langfile).'_lang';
        }

        $langfile .= '.php';

        if (in_array($langfile, $this->is_loaded, TRUE)) {
            return;
        }

        $config =& get_config();

        if ($idiom == '') {
            $deft_lang = $this->_language_folder;
            $idiom = ($deft_lang == '') ? 'english' : $deft_lang;
        }

        // Determine where the language file is and load it
        if ($alt_path != '' && file_exists($alt_path.'language/'.$idiom.'/'.$langfile)) {
            include($alt_path.'language/'.$idiom.'/'.$langfile);
        } else {
            $found = FALSE;

            foreach (get_instance()->load->get_package_paths(TRUE) as $package_path) {
                if (file_exists($package_path.'language/'.$idiom.'/'.$langfile)) {
                    include($package_path.'language/'.$idiom.'/'.$langfile);
                    $found = TRUE;
                    break;
                }
            }

            if ($found !== TRUE) {
                show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
            }
        }

        if ( ! isset($lang)) {
            log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);

            return;
        }

        if ($return == TRUE) {
            return $lang;
        }

        $this->is_loaded[] = $langfile;
        // add prefix value of array key
        $lang = $this->_set_prefix($lang);
        $this->language = array_merge($this->language, $lang);
        unset($lang);

        log_message('debug', 'Language file loaded: language/'.$idiom.'/'.$langfile);

        return TRUE;
    }

    private function _set_prefix($lang = array())
    {
        $output = array();
        foreach ($lang as $key => $val) {
            // legacy support
            $output[$key] = $val;
            // add prefix key
            $key = $this->_language_prefix . "." . $key;
            $output[$key] = $val;
        }

        return $output;
    }

    private function _set_language()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->config->load('language');

        $this->_language_list = $CI->config->item('language_list');
        $this->_language_field = $CI->config->item('language_field');
        $this->_language_key = $CI->config->item('language_key');

        if ($CI->input->get_post($this->_language_field) != FALSE) {
            $lang = strtolower($CI->input->get_post($this->_language_field));

            // check lang is exist in group
            if (array_key_exists($lang, $this->_language_list)) {
                $CI->session->set_userdata($this->_language_field, $lang);
            }
        }

        // set default browser language
        if (!$CI->session->userdata($this->_language_field)) {
            $CI->session->set_userdata($this->_language_field, $this->_default_lang());
        }

        $this->_language_folder = $this->_language_list[$CI->session->userdata($this->_language_field)];

        return $this;
    }

    private function _default_lang()
    {
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtolower(strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',')) : '';

        return (!empty($browser_lang) and array_key_exists($browser_lang, $this->_language_list)) ? strtolower($browser_lang) : $this->_language_key;
    }
}
