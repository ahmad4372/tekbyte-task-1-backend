<?php
/**
 * Custom taxonomy
 *
 * @package tekbyte_task_1
 */

/**
 * Registers the `industry` taxonomy,
 * for use with 'case-study'.
 */
function tekbyte_task_1_init() {
	register_taxonomy(
		'industry',
		array( 'case-study' ),
		array(
			'hierarchical'          => false,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_admin_column'     => false,
			'query_var'             => true,
			'rewrite'               => true,
			'capabilities'          => array(
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			),
			'labels'                => array(
				'name'                       => __( 'Industries', 'tekbyte-task-1' ),
				'singular_name'              => _x( 'Industry', 'taxonomy general name', 'tekbyte-task-1' ),
				'search_items'               => __( 'Search Industries', 'tekbyte-task-1' ),
				'popular_items'              => __( 'Popular Industries', 'tekbyte-task-1' ),
				'all_items'                  => __( 'All Industries', 'tekbyte-task-1' ),
				'parent_item'                => __( 'Parent Industry', 'tekbyte-task-1' ),
				'parent_item_colon'          => __( 'Parent Industry:', 'tekbyte-task-1' ),
				'edit_item'                  => __( 'Edit Industry', 'tekbyte-task-1' ),
				'update_item'                => __( 'Update Industry', 'tekbyte-task-1' ),
				'view_item'                  => __( 'View Industry', 'tekbyte-task-1' ),
				'add_new_item'               => __( 'Add New Industry', 'tekbyte-task-1' ),
				'new_item_name'              => __( 'New Industry', 'tekbyte-task-1' ),
				'separate_items_with_commas' => __( 'Separate Industries with commas', 'tekbyte-task-1' ),
				'add_or_remove_items'        => __( 'Add or remove Industries', 'tekbyte-task-1' ),
				'choose_from_most_used'      => __( 'Choose from the most used Industries', 'tekbyte-task-1' ),
				'not_found'                  => __( 'No Industries found.', 'tekbyte-task-1' ),
				'no_terms'                   => __( 'No Industries', 'tekbyte-task-1' ),
				'menu_name'                  => __( 'Industries', 'tekbyte-task-1' ),
				'items_list_navigation'      => __( 'Industries list navigation', 'tekbyte-task-1' ),
				'items_list'                 => __( 'Industries list', 'tekbyte-task-1' ),
				'most_used'                  => _x( 'Most Used', 'industry', 'tekbyte-task-1' ),
				'back_to_items'              => __( '&larr; Back to Industries', 'tekbyte-task-1' ),
			),
			'show_in_rest'          => true,
			'rest_base'             => 'industry',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		)
	);
}

add_action( 'init', 'tekbyte_task_1_init' );

/**
 * Sets the post updated messages for the `industry` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `industry` taxonomy.
 */
function tekbyte_task_1_updated_messages( $messages ) {

	$messages['industry'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Industry added.', 'tekbyte-task-1' ),
		2 => __( 'Industry deleted.', 'tekbyte-task-1' ),
		3 => __( 'Industry updated.', 'tekbyte-task-1' ),
		4 => __( 'Industry not added.', 'tekbyte-task-1' ),
		5 => __( 'Industry not updated.', 'tekbyte-task-1' ),
		6 => __( 'Industries deleted.', 'tekbyte-task-1' ),
	);

	return $messages;
}

add_filter( 'term_updated_messages', 'tekbyte_task_1_updated_messages' );
