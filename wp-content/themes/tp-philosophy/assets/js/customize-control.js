/**
 * Scripts within the customizer controls window.
 *
 */

/**
 * Add a listener to update other controls to new values/defaults.
 */

( function( api ) {
    wp.customize( 'tp_philosophy_theme_options[reset_options]', function( setting ) {
        setting.bind( function( value ) {
            var code = 'needs_refresh';
            if ( value ) {
                setting.notifications.add( code, new wp.customize.Notification(
                    code,
                    {
                        type: 'info',
                        message: tp_philosophy_cusomizer_control_data.reset_message
                    }
                ) );
            } else {
                setting.notifications.remove( code );
            }
        } );
    } );
} )( wp.customize );