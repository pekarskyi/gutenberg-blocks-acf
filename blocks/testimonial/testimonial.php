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

            <img src="<?php echo esc_url($thumb); ?>" width="100" height="100"
                alt="<?php echo esc_attr($testimonial_author); ?>" />

            <div class="testimonial-item-name"><?php echo esc_attr($testimonial_author); ?></div>
            <div class="testimonial-item-position"><?php echo esc_attr($testimonial_position); ?></div>

            <div class="testimonial-item-stars">
                <?php wp_star_rating( ['rating'=>$testimonial_rating, 'type'=>'rating', 'number'=>5 ] );?>
            </div>

            <div class="testimonial-item-read-more" style="--line-clamp: 4">
                <input id="testimonial-item-read-more-checkbox-<?php echo esc_html( $unique_id ); ?>" type="checkbox"
                    class="testimonial-item-read-more__checkbox" aria-hidden="true">
                <p class="testimonial-item-read-more__text">
                    <?php echo esc_html( $testimonial_text ); ?>
                </p>
                <label for="testimonial-item-read-more-checkbox-<?php echo esc_html( $unique_id ); ?>"
                    class="testimonial-item-read-more__label" data-read-more="Показать все" data-read-less="Скрыть"
                    aria-hidden="true"></label>
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