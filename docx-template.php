<?php
/**
 * @package Docx Template Plugin
 * @version 1.0.0
 */
/*
Plugin Name: Docx Template Plugin
Plugin URI: NA
Description: For docx file template auto processing of data.
Author: Kim Ramirez
Version: 1.0.0
Author URI: NA
*/

add_shortcode( 'docx_template_form', 'docx_template_form_callback' );

function docx_template_form_callback() {
	$returnurl = get_site_url();
  return
  "
  <input type='hidden' id='prevvalue' value='-1'>
	<input type='hidden' id='nextvalue' value='1'>
	<form id='regForm'>
	  <div id='tabarea'>
	  	<div class='tab'>
		    <input type='file' class='load-file'><br>
		</div>
	  </div>
	  <br>
	  <div style='overflow:auto;'>
	    <div style='float:right;'>
	      <button id='otherBtn' type='button'>Upload Another Document</button>
	      <button id='prevBtn' type='button'>Previous</button>
	      <button id='get-parameters' type='button'>Next</button>
	      <button id='nextBtn' type='button'>Next</button>
	      <button id='done-button' type='button' style='display: none;'>Process & Download DOCX</button>
	      <button id='new-button' type='button' style='display: none;'>Upload New Document</button>
	    </div>
	  </div>
	  <div style='text-align:center;margin-top:40px;' id='steparea'>
	    <span class='step'></span>
	  </div>
	</form>
  ";
}
wp_docxtemplate_style_render();
wp_bundle_easy_template_script_render();
wp_pizzip_utils_script_render();
wp_pizzip_script_render();
wp_docxtemplater_script_render();
wp_canvas_to_blob_script_render();


function wp_docxtemplate_style_render() {
  $file_url = get_site_url()."/wp-content/plugins/docx-template-plugin/style.css";
  wp_enqueue_style('xbulk_style', $file_url);
}

function wp_canvas_to_blob_script_render() {
  $file_url = "https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.4.0/js/canvas-to-blob.min.js";
  wp_enqueue_script('canvas_to_blob', $file_url, array(), NULL, true);
}

function wp_docxtemplater_script_render() {
  $file_url = "https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.26.2/docxtemplater.js";
  wp_enqueue_script('docxtemplater', $file_url, array(), NULL, false);
}

function wp_pizzip_script_render() {
  $file_url = "https://unpkg.com/pizzip@3.1.1/dist/pizzip.js";
  wp_enqueue_script('pizzip', $file_url, array(), NULL, true);
}

function wp_pizzip_utils_script_render() {
  $file_url = "https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js";
  wp_enqueue_script('pizzip_utils', $file_url, array(), NULL, false);
}

function wp_bundle_easy_template_script_render() {
  $file_url = get_site_url()."/wp-content/plugins/docx-template-plugin/bundle.easy-template.js";
  wp_enqueue_script('bundle_easy_template', $file_url, array(), NULL, true);
}

add_action('admin_menu', 'docx_template_setup');

function docx_template_setup() {
    add_menu_page('Docx Template Setup', 'Docx Template Setup', 'manage_options', 'docx-template-setup', 'docxtemplatemenu');
}

function docxtemplatemenu() {
    echo "<h1>Docx Template Processor Setup</h1>";
    echo "<p>To apply the DOCX template processor, create a new WP page and put this tag <b>[docx_template_form]</b> as <b>shortcode</b>.</p>";
}