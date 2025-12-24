<?php
/**
 * Case Study custom post type.
 *
 * @package Tekbyte_Task_1
 */

namespace TekbyteTask1\PostTypes;

use TekbyteTask1\Support\Singleton;

final class CaseStudy {
	use Singleton;

	/**
	 * Register WP hooks.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'init', array( $this, 'register' ) );
		add_filter( 'post_updated_messages', array( $this, 'updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_updated_messages' ), 10, 2 );
	}

	/**
	 * Registers the `case-study` post type.
	 *
	 * @return void
	 */
	public function register() {
		register_post_type(
			'case-study',
			array(
				'labels'                => array(
					'name'                  => __( 'Case Studies', 'tekbyte-task-1' ),
					'singular_name'         => __( 'Case Study', 'tekbyte-task-1' ),
					'all_items'             => __( 'All Case Studies', 'tekbyte-task-1' ),
					'archives'              => __( 'Case Studies Archives', 'tekbyte-task-1' ),
					'attributes'            => __( 'Case Studies Attributes', 'tekbyte-task-1' ),
					'insert_into_item'      => __( 'Insert into Case Studies', 'tekbyte-task-1' ),
					'uploaded_to_this_item' => __( 'Uploaded to this Case Studies', 'tekbyte-task-1' ),
					'featured_image'        => _x( 'Featured Image', 'case-study', 'tekbyte-task-1' ),
					'set_featured_image'    => _x( 'Set featured image', 'case-study', 'tekbyte-task-1' ),
					'remove_featured_image' => _x( 'Remove featured image', 'case-study', 'tekbyte-task-1' ),
					'use_featured_image'    => _x( 'Use as featured image', 'case-study', 'tekbyte-task-1' ),
					'filter_items_list'     => __( 'Filter Case Studies list', 'tekbyte-task-1' ),
					'items_list_navigation' => __( 'Case Studies list navigation', 'tekbyte-task-1' ),
					'items_list'            => __( 'Case Studies list', 'tekbyte-task-1' ),
					'new_item'              => __( 'New Case Studies', 'tekbyte-task-1' ),
					'add_new'               => __( 'Add New', 'tekbyte-task-1' ),
					'add_new_item'          => __( 'Add New Case Studies', 'tekbyte-task-1' ),
					'edit_item'             => __( 'Edit Case Studies', 'tekbyte-task-1' ),
					'view_item'             => __( 'View Case Studies', 'tekbyte-task-1' ),
					'view_items'            => __( 'View Case Studies', 'tekbyte-task-1' ),
					'search_items'          => __( 'Search Case Studies', 'tekbyte-task-1' ),
					'not_found'             => __( 'No Case Studies found', 'tekbyte-task-1' ),
					'not_found_in_trash'    => __( 'No Case Studies found in trash', 'tekbyte-task-1' ),
					'parent_item_colon'     => __( 'Parent Case Studies:', 'tekbyte-task-1' ),
					'menu_name'             => __( 'Case Studies', 'tekbyte-task-1' ),
				),
				'public'                => true,
				'hierarchical'          => false,
				'show_ui'               => true,
				'show_in_nav_menus'     => true,
				'supports'              => array( 'title', 'editor', 'author', 'yoast-seo' ),
				'has_archive'           => true,
				'rewrite'               => true,
				'query_var'             => true,
				'menu_position'         => null,
				'menu_icon'             => 'dashicons-book-alt',
				'show_in_rest'          => false,
				// WPGraphQL.
				'show_in_graphql'       => true,
				'graphql_single_name'   => 'caseStudy',
				'graphql_plural_name'   => 'caseStudies',
			)
		);
	}

	/**
	 * @param array $messages Post updated messages.
	 * @return array
	 */
	public function updated_messages( $messages ) {
		global $post;

		$permalink = $post ? get_permalink( $post ) : '';

		$messages['case-study'] = array(
			0  => '',
			/* translators: %s: post permalink */
			1  => sprintf( __( 'Case Studies updated. <a target="_blank" href="%s">View Case Studies</a>', 'tekbyte-task-1' ), esc_url( $permalink ) ),
			2  => __( 'Custom field updated.', 'tekbyte-task-1' ),
			3  => __( 'Custom field deleted.', 'tekbyte-task-1' ),
			4  => __( 'Case Studies updated.', 'tekbyte-task-1' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Case Studies restored to revision from %s', 'tekbyte-task-1' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			/* translators: %s: post permalink */
			6  => sprintf( __( 'Case Studies published. <a href="%s">View Case Studies</a>', 'tekbyte-task-1' ), esc_url( $permalink ) ),
			7  => __( 'Case Studies saved.', 'tekbyte-task-1' ),
			/* translators: %s: post permalink */
			8  => sprintf( __( 'Case Studies submitted. <a target="_blank" href="%s">Preview Case Studies</a>', 'tekbyte-task-1' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
			/* translators: 1: Publish box date format 2: Post permalink */
			9  => sprintf( __( 'Case Studies scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Case Studies</a>', 'tekbyte-task-1' ), date_i18n( __( 'M j, Y @ G:i', 'tekbyte-task-1' ), strtotime( $post ? $post->post_date : '' ) ), esc_url( $permalink ) ),
			/* translators: %s: post permalink */
			10 => sprintf( __( 'Case Studies draft updated. <a target="_blank" href="%s">Preview Case Studies</a>', 'tekbyte-task-1' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		);

		return $messages;
	}

	/**
	 * @param array $bulk_messages Bulk messages.
	 * @param array $bulk_counts   Bulk counts.
	 * @return array
	 */
	public function bulk_updated_messages( $bulk_messages, $bulk_counts ) {
		$bulk_messages['case-study'] = array(
			/* translators: %s: Number of Case Studies. */
			'updated'   => _n( '%s Case Studies updated.', '%s Case Studies updated.', $bulk_counts['updated'], 'tekbyte-task-1' ),
			'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Case Studies not updated, somebody is editing it.', 'tekbyte-task-1' ) :
							/* translators: %s: Number of Case Studies. */
							_n( '%s Case Studies not updated, somebody is editing it.', '%s Case Studies not updated, somebody is editing them.', $bulk_counts['locked'], 'tekbyte-task-1' ),
			/* translators: %s: Number of Case Studies. */
			'deleted'   => _n( '%s Case Studies permanently deleted.', '%s Case Studies permanently deleted.', $bulk_counts['deleted'], 'tekbyte-task-1' ),
			/* translators: %s: Number of Case Studies. */
			'trashed'   => _n( '%s Case Studies moved to the Trash.', '%s Case Studies moved to the Trash.', $bulk_counts['trashed'], 'tekbyte-task-1' ),
			/* translators: %s: Number of Case Studies. */
			'untrashed' => _n( '%s Case Studies restored from the Trash.', '%s Case Studies restored from the Trash.', $bulk_counts['untrashed'], 'tekbyte-task-1' ),
		);

		return $bulk_messages;
	}
}