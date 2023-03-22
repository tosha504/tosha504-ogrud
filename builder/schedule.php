<?php 
/**
 * Schedule
 *
 * @package  ogrud_botamiczny
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$title_schedules = get_field( 'title_schedules', 'options' );
$schedules = get_field( 'schedule', 'options' );
echo schedule_creating( $title_schedules , $schedules); 



