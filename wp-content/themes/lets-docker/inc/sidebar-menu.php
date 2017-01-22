<?php
                        $defaults = array(
                            'theme_location'  => 'sidebar-menu',
                            'container'       => 'div',
                            'container_class' => 'sidebar-wrapper',
                            'menu_class'      => 'nav navbar-nav',
                            'echo'            => true,
                            'items_wrap'      => '<ul class="nav">%3$s</ul>',
                        );

                        wp_nav_menu( $defaults );

                        ?>