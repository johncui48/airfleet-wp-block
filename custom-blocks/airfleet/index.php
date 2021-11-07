<?php
/**
 * Airfleet Block Callback
 * 
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
function airfleet_block_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {

    // Create id attribute allowing for custom "anchor" value.
    $id = 'airfleet_gutenberg_'.$block['id'];
    
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }
    $className = 'afb-group';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    if( !empty($block['align_text']) ) {
        $className .=  $block['align_text'];
    }
    if( !empty($block['align_content']) ) {
        $className .=  $block['align_content'];
    }

    // Load values from ACF fields.
    $layout = get_field('content_layout');
    if( $layout == "Image Left Align" ){
        $enable = 'img-align-left';
    } else {
        $enable = '';
    }
    $heading = get_field('heading');
    $summary = get_field('summary');
    $body_text = get_field('body_text');
    $link_btn = get_field('button');
    $image = get_field('image');

?>
<section class="<?php echo esc_attr($className); ?>" id="<?php echo esc_attr($id); ?>">
    <div class="afb-row <?php echo $enable; ?>">
        <div class="afb-col-1"> 
            <div class="afb-content">
                <?php if(!empty($heading)):?>
                    <h2><?php echo $heading;?></h2>
                <?php endif;?>

                <?php if(!empty($summary)):?>
                    <p class="body-text">
                        <?php echo $summary;?>
                        <span class="readmore-btn">
                            Read more
                        </span>
                    </p>
                <?php endif;?>
                <!-- /.body-text -->

                <?php if(!empty($body_text)):?>
                    <p class="readmore-text">
                        <?php echo $body_text;?>
                    </p>
                <!-- /.readmore-text -->
                <?php endif; ?>

                <?php 
                if(!empty($link_btn)): 
                    $link_url = $link_btn['url'];
                    $link_title = $link_btn['title'];
                    $link_target = $link_btn['target'] ? $link_btn['target'] : '_self';
                ?>
                    <a class="link-btn text-uppercase" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <!-- /.airfleet-block-content -->
        </div>
        
        <div class="afb-col-2">
            <div class="afb-image">
                <?php if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </div>
            <!-- /.airfleet-block-image -->
        </div>
    </div>
    <!-- /.airfleet-block -->
</section>   
<?php } ?>