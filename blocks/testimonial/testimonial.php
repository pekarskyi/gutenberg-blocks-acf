<?php
/**
 * Testimonial Block Template
 */
?>

<div class="row-testimonial-grid">
    <?php
        if( have_rows('otzyvy') ):
        // loop through the rows of data
        while ( have_rows('otzyvy') ) : the_row(); 
        
            $main_path = get_stylesheet_directory_uri(); //http://domain.com/wp-content/themes/theme-child
            $testimonial_text = get_sub_field( 'tekst' ) ?: 'Your testimonial here...';
            $testimonial_author = get_sub_field( 'avtor' ) ?: 'Author name';
            $testimonial_position = get_sub_field( 'dolzhnost' ) ?: 'Author role';

            $testimonial_photo = get_sub_field( 'foto' ) ?: 295;
            $url = $testimonial_photo['url'];
            $size = 'large';
            $thumb = $testimonial_photo['sizes'][ $size ];
            $width = $testimonial_photo['sizes'][ $size . '-width' ];
            $height = $testimonial_photo['sizes'][ $size . '-height' ];
            $testimonial_rating = get_sub_field('rejting');
            $unique_id = get_sub_field( 'unique_id' );
    ?>

    <div class="col-testimonial-grid">
        <div class="testimonial-item">
		
		<div class="testimonila-col">
		<div class="left">

            <div class="testimonial-item-name"><?php echo esc_attr($testimonial_author); ?></div>
            <div class="testimonial-item-position"><?php echo esc_attr($testimonial_position); ?></div>

            <div class="testimonial-item-stars">
                <?php wp_star_rating( ['rating'=>$testimonial_rating, 'type'=>'rating', 'number'=>0 ] );?>
            </div>
			
			</div>
			
			<div class="right">
			
			<?php if($thumb == '') { ?>
            <img src="<?php echo $main_path; ?>/blocks/testimonial/images/star.png"
                alt="<?php echo esc_attr($testimonial_author); ?>" />
            <?php } else { ?>
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($testimonial_author); ?>" />
            <?php }  ?>
			
			</div>
			</div>

            <div class="testimonial-item-read-more" style="--line-clamp: 4">
                <input id="testimonial-item-read-more-checkbox-<?php echo esc_html( $unique_id ); ?>" type="checkbox"
                    class="testimonial-item-read-more__checkbox" aria-hidden="true">
                <p class="testimonial-item-read-more__text">
                    <?php echo esc_html( $testimonial_text ); ?>
                </p>

                <!-- Expand+Polylang -->
                <?php if(ICL_LANGUAGE_CODE=='ru'): ?>
                <label for="testimonial-item-read-more-checkbox-<?php echo esc_html( $unique_id ); ?>"
                    class="testimonial-item-read-more__label" data-read-more="Развернуть" data-read-less="Свернуть"
                    aria-hidden="true"></label>
                <?php elseif(ICL_LANGUAGE_CODE=='uk'): ?>
                <label for="testimonial-item-read-more-checkbox-<?php echo esc_html( $unique_id ); ?>"
                    class="testimonial-item-read-more__label" data-read-more="Розгорнути" data-read-less="Згорнути"
                    aria-hidden="true"></label>
                <?php endif; ?>

            </div>
        </div>

    </div>


    <?php
        endwhile;

        else :
        // no rows found
        endif;
    ?>
</div>