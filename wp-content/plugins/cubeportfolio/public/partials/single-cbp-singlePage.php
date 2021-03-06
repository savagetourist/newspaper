<?php
/*
Template Name: Cube Portfolio default template
*/
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

//remove_filter( 'the_content', 'wpautop' );

get_header();
?>
<div class="cbp-popup-singlePage">
    <?php while ( have_posts() ) : the_post();
        $metadata = get_metadata( 'post', get_the_ID() ); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="cbp-l-project-title"><?php the_title(); ?></div>
            <div class="cbp-l-project-subtitle"><?php echo $metadata['cbp_project_subtitle'][0]; ?></div>

            <?php
            $images = json_decode( $metadata['cbp_project_images'][0] );

            $is_slider = ($metadata['cbp_project_images_slider'][0] == 'on')? 'class="cbp-slider"' : '';

            if (count($images)) :
                // include
                require_once CUBEPORTFOLIO_PATH . 'php/CubePortfolioProcessSliderItem.php';
            ?>
                <div <?php echo $is_slider; ?>>
                    <div class="cbp-slider-wrap">
                        <?php foreach ($images as $value) : ?>
                        <?php $obj = new CubePortfolioProcessSliderItem($value); ?>
                        <div class="cbp-slider-item">
                            <?php if ($value->type === 'image') : ?>
                                <?php if ($metadata['cbp_project_images_lightbox'][0] == 'on') : ?>
                                <a href="<?php echo wp_get_attachment_url($value->id) ?>" class="cbp-lightbox" data-cbp-lightbox="<?php echo 'gallery_' . get_the_ID(); ?>">
                                    <?php echo $obj->getHTML(); ?>
                                </a>
                                <?php else : ?>
                                    <?php echo $obj->getHTML(); ?>
                                <?php endif; ?>

                                <?php else : ?>
                                    <?php echo $obj->getHTML(); ?>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="cbp-l-project-container">

                <?php
                    $categories = get_the_terms( get_the_ID(), CubePortfolioMain::$settings['postType'] . '_category');
                    $hasDetailes = false;
                    if ( $metadata['cbp_project_details_client'][0] || $metadata['cbp_project_details_date'][0] || $categories != false ) {
                        $hasDetailes = true;
                    }
                ?>

                <div class="cbp-l-project-desc" <?php echo (!$hasDetailes)? 'style="width:100%;"' : '' ?>>
                    <div class="cbp-l-project-desc-title"><span><?php _e('Project Description', CUBEPORTFOLIO_TEXTDOMAIN); ?></span></div>
                    <div class="cbp-l-project-desc-text"><?php the_content(); ?></div>

                    <?php if ($metadata['cbp_project_social_fb'][0] == 'on' || $metadata['cbp_project_social_twitter'][0] == 'on' || $metadata['cbp_project_social_google'][0] == 'on') : ?>
                    <br>
                    <?php endif; ?>

                    <?php if ($metadata['cbp_project_social_fb'][0] == 'on') : ?>
                    <div class="cbp-l-project-social-wrapper">
                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo the_permalink(); ?>&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" height="25"></iframe>
                    </div>
                    <?php endif; ?>

                    <?php if ($metadata['cbp_project_social_twitter'][0] == 'on') : ?>
                    <div class="cbp-l-project-social-wrapper">
                        <iframe src="https://platform.twitter.com/widgets/tweet_button.html?url=<?php echo htmlentities(the_permalink()); ?>&text=Check%20out%20this%20site" height="25" title="Twitter Tweet Button" style="border: 0; overflow: hidden;"></iframe>
                    </div>
                    <?php endif; ?>

                    <?php if ($metadata['cbp_project_social_google'][0] == 'on') : ?>
                    <div class="cbp-l-project-social-wrapper" style="width: 71px">
                        <iframe src="https://plusone.google.com/_/+1/fastbutton?bsv&amp;size=medium&amp;hl=en-US&amp;url=<?php echo the_permalink(); ?>" allowtransparency="true" frameborder="0" scrolling="no" title="+1" height="25" style="border: 0; overflow: hidden;"></iframe>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($hasDetailes) : ?>
                <div class="cbp-l-project-details">
                    <div class="cbp-l-project-details-title"><span><?php _e('Project Details', CUBEPORTFOLIO_TEXTDOMAIN); ?></span></div>

                    <div class="cbp-l-project-details-list">
                        <?php if ($metadata['cbp_project_details_client'][0]) : ?>
                        <div><strong><?php _e('Client', CUBEPORTFOLIO_TEXTDOMAIN); ?></strong><?php echo $metadata['cbp_project_details_client'][0];?></div>
                        <?php endif; ?>

                        <?php if ($metadata['cbp_project_details_date'][0]) : ?>
                        <div><strong><?php _e('Date', CUBEPORTFOLIO_TEXTDOMAIN); ?></strong><?php echo $metadata['cbp_project_details_date'][0];?></div>
                        <?php endif; ?>

                        <?php if ($categories != false) : ?>
                        <div><strong><?php _e('Categories', CUBEPORTFOLIO_TEXTDOMAIN); ?></strong><?php the_terms( get_the_ID(), CubePortfolioMain::$settings['postType'] . '_category'); ?></div>
                        <?php endif; ?>

                    </div>
                </div>
                <?php endif; ?>

                <?php if ($metadata['cbp_project_link'][0]) : ?>
                <a href="<?php echo $metadata['cbp_project_link'][0];?>" target="<?php echo $metadata['cbp_project_link_target'][0];?>" class="cbp-l-project-details-visit"><?php _e('VIEW PROJECT', CUBEPORTFOLIO_TEXTDOMAIN); ?></a>
                <?php endif; ?>
            </div>

            <br>
            <br>
            <br>
        </article>
    <?php endwhile; // end of the loop. ?>

</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
