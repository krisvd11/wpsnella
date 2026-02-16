



<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-top">
            <?php
            $footer_get  = function ( $key, $default = '' ) {
                if ( function_exists( 'test_footer_settings_get' ) ) {
                    return test_footer_settings_get( $key, $default );
                }
                return get_theme_mod( $key, $default );
            };

            $footer_logo = $footer_get( 'footer_logo' );
            if ( $footer_logo ) :
                ?>
                <div class="footer-logo">
                    <?php
                    if ( is_numeric( $footer_logo ) ) {
                        echo wp_get_attachment_image( (int) $footer_logo, 'full', false, [ 'class' => 'footer-logo-img' ] );
                    } else {
                        echo '<img class="footer-logo-img" src="' . esc_url( $footer_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
                    }
                    ?>
                </div>
            <?php elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                <div class="footer-logo">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <div class="footer-site-title">
                    <?php bloginfo( 'name' ); ?>
                </div>
            <?php endif; ?>

            <div class="footer-open-badge">
            <span class="footer-open-dot-bg" aria-hidden="true"></span>
                <span class="footer-open-dot" aria-hidden="true"></span>
                <span class="footer-open-text">
					<?php echo esc_html( $footer_get( 'footer_open_badge_text', __( 'Yes! Wij zijn open tot 18:00 uur', 'test' ) ) ); ?>
				</span>
            </div>
        </div>

        <div class="footer-columns">
            <div class="footer-column footer-column--hours">
                <h4 class="footer-heading">
					<?php echo esc_html( $footer_get( 'footer_hours_title', __( 'Openingstijden', 'test' ) ) ); ?>
				</h4>
                <ul class="footer-hours-list">
                    <?php
                    $default_hours = "Maandag|08:00 - 18:00\nDinsdag|08:00 - 18:00\nWoensdag|08:00 - 18:00\nDonderdag|08:00 - 18:00\nVrijdag|08:00 - 18:00\nZaterdag|08:00 - 18:00\nZondag|Gesloten";
                    $hours_raw     = $footer_get( 'footer_opening_hours', $default_hours );
                    $hours_lines   = array_filter( array_map( 'trim', explode( "\n", $hours_raw ) ) );

                    foreach ( $hours_lines as $line ) :
                        $parts = array_map( 'trim', explode( '|', $line ) );
                        $day   = $parts[0] ?? '';
                        $time  = $parts[1] ?? '';

                        if ( ! $day ) {
                            continue;
                        }
                        ?>
                        <li class="footer-hours-item">
                            <span class="footer-hours-day"><?php echo esc_html( $day ); ?></span>
                            <?php if ( $time ) : ?>
                                <span class="footer-hours-time"><?php echo esc_html( $time ); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-column footer-column--nav">
                <h4 class="footer-heading">
					<?php echo esc_html( $footer_get( 'footer_nav_title', __( 'Snel naar', 'test' ) ) ); ?>
				</h4>
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu( [
                        'theme_location' => 'footer',
                        'container'      => 'nav',
                        'container_class'=> 'footer-nav',
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => false,
                    ] );
                }
                ?>
            </div>

            <div class="footer-column footer-column--contact">
                <h4 class="footer-heading">
					<?php echo esc_html( $footer_get( 'footer_company_name', 'Snella Autowas' ) ); ?>
				</h4>

                <div class="footer-location">
                    <h5 class="footer-subheading">
						<?php echo esc_html( $footer_get( 'footer_location1_title', 'Snella Autowas N206' ) ); ?>
					</h5>
                    <p class="footer-text">
						<?php
						$location1_address = $footer_get(
							'footer_location1_address',
							"Lageweg 44\n2222 AG Katwijk aan Zee"
						);
						echo nl2br( esc_html( $location1_address ) );
						?>
					</p>
                </div>

                <div class="footer-location">
                    <h5 class="footer-subheading">
						<?php echo esc_html( $footer_get( 'footer_location2_title', 'Snella Autowas Katwijkerbroek' ) ); ?>
					</h5>
                    <p class="footer-text">
						<?php
						$location2_address = $footer_get(
							'footer_location2_address',
							"Valkenburgseweg 101\n2223 KC Katwijk"
						);
						echo nl2br( esc_html( $location2_address ) );
						?>
					</p>
                </div>

                <p class="footer-text footer-contact-line">
                    <?php esc_html_e( 'Telefoon:', 'test' ); ?>
                    <?php
                    $phone     = $footer_get( 'footer_phone', '(071) 407 79 99' );
                    $phone_tel = preg_replace( '/[^0-9+]/', '', $phone );
                    ?>
                    <a href="tel:<?php echo esc_attr( $phone_tel ); ?>">
						<?php echo esc_html( $phone ); ?>
					</a>
                </p>

                <p class="footer-text footer-contact-line">
                    <?php esc_html_e( 'Email:', 'test' ); ?>
                    <?php
                    $email = $footer_get( 'footer_email', 'info@snella.nl' );
                    ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>">
						<?php echo esc_html( $email ); ?>
					</a>
                </p>

                <div class="footer-social">
                    <span class="footer-text footer-social-label">
						<?php echo esc_html( $footer_get( 'footer_social_label', __( 'Volg Snella op', 'test' ) ) ); ?>
					</span>
                    <div class="footer-social-links">
                        <?php
                        $instagram_url = $footer_get( 'footer_instagram_url', '#' );
                        $facebook_url  = $footer_get( 'footer_facebook_url', '#' );
                        ?>
                        <?php if ( $instagram_url ) : ?>
                            <a href="<?php echo esc_url( $instagram_url ); ?>" class="footer-social-link footer-social-link--instagram" aria-label="<?php esc_attr_e( 'Instagram', 'test' ); ?>">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#0F0F0F"/>
<path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#0F0F0F"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#0F0F0F"/>
</svg>


                            </a>
                        <?php endif; ?>
                        <?php if ( $facebook_url ) : ?>
                            <a href="<?php echo esc_url( $facebook_url ); ?>" class="footer-social-link footer-social-link--facebook" aria-label="<?php esc_attr_e( 'Facebook', 'test' ); ?>">

                            <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="-337 273 123.5 256" xml:space="preserve">
<path d="M-260.9,327.8c0-10.3,9.2-14,19.5-14c10.3,0,21.3,3.2,21.3,3.2l6.6-39.2c0,0-14-4.8-47.4-4.8c-20.5,0-32.4,7.8-41.1,19.3
	c-8.2,10.9-8.5,28.4-8.5,39.7v25.7H-337V396h26.5v133h49.6V396h39.3l2.9-38.3h-42.2V327.8z"/>
</svg>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-text footer-bottom-text">
                &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
            </p>
        </div>
    </div>

</footer>

<div class="copyright">
<p class="footer-text footer-bottom-text">
                &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
            </p>

</div>
<?php wp_footer(); ?>
</body>
</html>
