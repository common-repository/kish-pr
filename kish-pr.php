<?php
/*
Plugin Name: Kish PR
Plugin URI: http://kish.in/ajax-wordpress-pagerank-plugin/
Description: This plugin is a simple plugin to display the pagerank of your blog page. You can also have a PR checking tool on your blog. After activatng the plugin, all you need is to add one line to your template <?php if (function_exists('printPR')) printPRBox($width=200, $bgcolor = 'CC0000', $forecolor); ?>. The parameters for the funtions can be used to modify the looks of the PR Checking tool according to your Theme. For printing the PR of the exisiting page and printPRWithURL($url) for displaying the PR of a particular URL And the other option to print the PR Checking Tool <?php if (function_exists('printPRBox')) printPRBox(); ?> or you can enable the widgets to show on your blog sidebar. Please note that you should have the curl library enabled for this to work and I have tested this only on PHP 5.2
Version:1.0
Author: Kishore Asokan
Author URI: http://kisaso.com 
*/

/*  Copyright 2008  Kishore Asokan  (email : kishore@asokans.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
$root = dirname(dirname(dirname(dirname(__FILE__))));
file_exists($root.'/wp-load.php') ? require_once($root.'/wp-load.php') : require_once($root.'/wp-config.php');
$kproot = str_replace("\\", "/", dirname(__FILE__));
include_once($kproot.'/functions.php');
include_once($kproot.'/class.googlepr.php');
if($_POST['req']=='pr') {
	printPRBox();
}
else if($_POST['req']=='prurl') {
	printPRWithURL($_POST['url']);
}
if( function_exists('add_action') ) {
		add_action("plugins_loaded", "kishPRWidget_init");
		add_action('wp_head', 'kish_pr_js');
}
?>