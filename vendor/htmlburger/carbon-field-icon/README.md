# Carbon Field Icon

Provides the ability to select an icon or a glyph.

## Supported glyphs

- Font Awesome
- Dashicons
- Custom

## Usage

Font Awesome only (default):

    Field::make( 'icon', 'social_site_icon', __( 'Icon', 'crb' ) ),

Dashicons only:

    Field::make( 'icon', 'social_site_icon', __( 'Icon', 'crb' ) )
        ->add_dashicons_options(),

Dashicons and Font Awesome:

    Field::make( 'icon', 'social_site_icon', __( 'Icon', 'crb' ) )
        ->add_dashicons_options()
        ->add_fontawesome_options(),

Custom icon list:

    Field::make( 'icon', 'social_site_icon', __( 'Icon', 'crb' ) )
        ->set_options( function() {
            return array(
                // Minimal settings:
                'my-custom-icon-1' => array(
                    'name'        => 'My Custom Icon 1',
                ),

                // Full settings:
                'my-custom-icon-2' => array(
                    'name'        => 'My Custom Icon 2',
                    'id'          => 'my-custom-icon-2',
                    'class'       => 'my-custom-prefix-class',
                    'contents'    => '&nbsp;',
                    'categories'  => array( 'shop', 'checkout', 'product' ),
                ),
            );
        } ),
