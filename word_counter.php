<?php 

	/**

	 * Plugin Name:			Word Counter
	 * Plugin URI:			http://journeybyweb.com/
	 * Description:			Count your posts total number of word with this plugin.
	 * Version:				1.0.0
	 * Requires at least:	5.2
	 * Requires PHP:		7.2
	 * Author:				Abdul Hay
	 * Author URI:			http://abdulhay.journeybyweb.com/
	 * License:				GPL v2 or later
	 * License URI:			https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain:			Word_Counter
	 * Domain Path:			/languages

	*/

	/*function Word_Counter_activation_hook(){}
		register_activation_hook( __FILE__, 'Word_Counter_activation_hook' );

	function Word_Counter_deactivation_hook(){}
		register_deactivation_hook( __FILE__, 'Word_Counter_activation_hook' );*/


	function Word_Counter_load_textdomain(){
		load_plugin_textdomain( 'Word_Counter', false, dirname(__FILE__).'/languages' );
	}
	add_action( 'plugin_loaded', 'Word_Counter_load_textdomain');

	function Word_Counter_count_words($content){
		$stripped_content = strip_tags($content);
		$wordn = str_word_count($stripped_content);
		$label = __('Total Number of words', 'Word_Counter');
		$label = apply_filters( 'wordcount_heading', $label);
		$tag   = apply_filters( 'heading_tag', 'h2');
		$content .= sprintf('<%s> %s : %s all arround this post.</%s>', $tag, $label, $wordn, $tag);
		return $content;
	}
	add_filter( 'the_content','Word_Counter_count_words');

	function Word_Counter_reading_time($content){
		$stripped_content = strip_tags($content);
		$wordn = str_word_count($stripped_content);
		$reading_minutes = floor($wordn / 200);
		$reading_seconds = floor($wordn % 200 /(200/60));
		$is_visible = apply_filters( 'Word_Counter_display_readingtime', 1 );
		if ($is_visible) {
			$label = __('Total Reading Time', 'Word_Counter');
			$label = apply_filters( 'readingtime_heading', $label);
			$tag   = apply_filters( 'readingtime_heading_tag', 'h4');
			$content .= sprintf('<%s> %s : %s minutes %s seconds </%s>', $tag, $label, $reading_minutes, $reading_seconds, $tag);
		}
		return $content;

	}
	add_filter( 'the_content', 'Word_Counter_reading_time' )
?>