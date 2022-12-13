<?php

get_header();

while ( have_posts() ) :
	the_post();

	$car_meta = array(
		'color' => get_post_meta( get_the_ID(), 'car_color' ),
		'fuel'  => get_post_meta( get_the_ID(), 'car_fuel' ),
		'power' => get_post_meta( get_the_ID(), 'car_power' ),
		'price' => get_post_meta( get_the_ID(), 'car_price' ),
	);

	$marks   = wp_get_post_terms( get_the_ID(), 'marks' );
	$country = wp_get_post_terms( get_the_ID(), 'countries' )[0];

?>

<div class="single-car-content-wrapper">

	<div class="single-car-description"><?php the_content(); ?></div>
    <div class="single-car-thumbnail"><?php echo get_the_post_thumbnail(); ?></div>
	<table class="single-car-info">
        <tr>
            <th>mark:</th>
            <td>
                <?php
                foreach ( $marks as $mark ):
                    echo $mark->name . ' ';
                endforeach;
                ?>
            </td>
        </tr>
        <tr>
            <th>country:</th>
            <td><?php echo $country->name; ?></td>
        </tr>
		<?php foreach ( $car_meta as $meta_label => $meta_value ): ?>
		<tr>
			<th><?php echo $meta_label; ?>:</th>
			<td><?php echo $meta_value[0]; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>

</div>

<?php
endwhile; // End of the loop.

get_footer();

?>
