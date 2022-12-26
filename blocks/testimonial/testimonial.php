<?php
/**
 * Testimonial Block Template
 */
?>

<div class="row">
    <?php
        if( have_rows('otzyvy') ):
        // loop through the rows of data
        while ( have_rows('otzyvy') ) : the_row(); 
        
            $tekst = get_sub_field( 'tekst' ) ?: 'Your testimonial here...';
            $avtor = get_sub_field( 'avtor' ) ?: 'Author name';
            $dolzhnost = get_sub_field( 'dolzhnost' ) ?: 'Author role';

            $foto = get_sub_field( 'foto' ) ?: 295;
            $url = $foto['url'];
            $size = 'large';
            $thumb = $foto['sizes'][ $size ];
            $width = $foto['sizes'][ $size . '-width' ];
            $height = $foto['sizes'][ $size . '-height' ];
            $rejting = get_sub_field('rejting');
            $unique_id = get_sub_field( 'unique_id' );
    ?>

    <div class="col">
        <div class="testimonial">

            <img src="<?php echo esc_url($thumb); ?>" width="100" height="100" alt="<?php echo esc_attr($avtor); ?>" />

            <div class="name"><?php echo esc_attr($avtor); ?></div>
            <div class="position"><?php echo esc_attr($dolzhnost); ?></div>

            <div class="stars">
                <?php wp_star_rating( ['rating'=>$rejting, 'type'=>'rating', 'number'=>5 ] );?>
            </div>

            <div class="read-more" style="--line-clamp: 4">
                <input id="read-more-checkbox-<?php echo esc_html( $unique_id ); ?>" type="checkbox"
                    class="read-more__checkbox" aria-hidden="true">
                <p class="read-more__text">
                    <?php echo esc_html( $tekst ); ?>
                </p>
                <label for="read-more-checkbox-<?php echo esc_html( $unique_id ); ?>" class="read-more__label"
                    data-read-more="Показать все" data-read-less="Скрыть" aria-hidden="true"></label>
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