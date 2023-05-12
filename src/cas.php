<?php

namespace YourVendor\WP_Cohort_Members;

class WP_Cohort_Members {
    // Class implementation goes here

    public function add_menu() {
        add_menu_page(
            'Cohort Members',
            'Cohort Members',
            'manage_options',
            'cohort-members',
            array( $this, 'render_cohort_members_page' ),
            'dashicons-groups',
            25
        );
    }
}
