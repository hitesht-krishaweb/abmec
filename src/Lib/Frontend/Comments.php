<?php

namespace Custom_Theme\Frontend;

/**
 * Class Comments
 *
 * Comment functions
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage Custom_Theme\Frontend
 */
class Comments {
	/**
	 * Get comments by page
	 *
	 * @since 3.0
	 *
	 * @param array $comments          Array containing comments
	 * @param int   $comments_per_page The number of comments per page
	 * @param int   $page_number       The actual page number
	 *
	 * @return array
	 */
	public static function get_paged_comments( $comments, $comments_per_page, $page_number ) {
		$return_comments = [];

		$counter = 1;

		foreach ( $comments as $comment ) {
			if ( $page_number > 1 ) {
				if ( $counter > ( $comments_per_page * ( $page_number - 1 ) ) && $counter <= ( $comments_per_page * $page_number ) ) {
					$return_comments[] = $comment;
				}
			} else {
				if ( $counter <= ( $comments_per_page * $page_number ) ) {
					$return_comments[] = $comment;
				}
			}

			$counter ++;
		}

		return $return_comments;
	}

	/**
	 * Render comment
	 *
	 * @since 3.0
	 *
	 * @param \WP_Comment $comment          The comment
	 * @param array       $comment_children The children of the comment
	 *
	 * @return void
	 */
	public static function render_comment( $comment, $comment_children ) {
		require( locate_template( 'template-parts/loop-comment.php' ) );
	}
}
