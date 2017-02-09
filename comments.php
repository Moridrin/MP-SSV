<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Moridrin
 * @subpackage SSV
 * @since SSV 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
            printf(_x('Thoughts on &ldquo;%1$s&rdquo;', 'comments title', 'ssv'), get_the_title());
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<div class="comment-list">
			<?php
				$comments = wp_list_comments( array(
                                                  'style'       => 'div',
                                                  'short_ping'  => true,
                                                  'avatar_size' => 42,
                                                  'callback'    => "ssv_format_comment"
				) );
			echo "<xmp>".$comments."</xmp>";
			?>
		</div><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
            <p class="no-comments"><?php _e('Comments are closed.', 'ssv'); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'class_submit'       => 'btn',
		) );
	?>

</div><!-- .comments-area -->
<?php
function ssv_format_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<div <?php comment_class('panel panel-comment'); ?> id="li-comment-<?php comment_ID() ?>">
		<div class="comment-intro">
			<?php
			$author = get_user_by("email", $comment->comment_author_email);
			if ($author != null) {
			?><h5><a href="<?php echo esc_url(get_author_posts_url($author->ID)); ?>"><?php echo $author->display_name; ?>:</a></h5><?php
			} else {
				echo "<h5>".$comment->comment_author.":</h5>";
			}
			?>
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.'); ?></em><br/>
		<?php endif; ?>
		
		<?php comment_text(); ?>
		
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
<?php } ?>
