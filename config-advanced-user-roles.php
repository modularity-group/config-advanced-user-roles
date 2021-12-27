<?php defined("ABSPATH") or die;

add_filter('acf/settings/capability', function( $path ) {
  return 'manage_fields';
});

add_action( 'admin_init', function() {
  global $wp_roles;

  $wp_roles->add_cap( 'administrator', 'manage_fields' );

  add_role( 'developer', 'Developer', get_role( 'administrator' )->capabilities );

  $wp_roles->remove_cap( 'developer', 'install_plugins' );
  $wp_roles->remove_cap( 'developer', 'update_plugins' );
  $wp_roles->remove_cap( 'developer', 'install_themes' );
  $wp_roles->remove_cap( 'developer', 'update_themes' );
  $wp_roles->remove_cap( 'developer', 'update_core' );

  $wp_roles->add_cap( 'editor', 'edit_theme_options' );
  $wp_roles->add_cap( 'editor', 'create_users' );
  $wp_roles->add_cap( 'editor', 'edit_users' );
  $wp_roles->add_cap( 'editor', 'list_users' );
  $wp_roles->add_cap( 'editor', 'promote_users' );
  $wp_roles->add_cap( 'editor', 'manage_privacy_options' );
  $wp_roles->add_cap( 'editor', 'delete_users' );
  $wp_roles->add_cap( 'editor', 'remove_users' );

});

add_action('map_meta_cap', function( $caps, $cap, $user_id, $args ) {
  if ( !is_user_logged_in() ) return $caps;

  $target_roles = array('editor', 'developer', 'administrator');
  $user_meta = get_userdata($user_id);
  $user_roles = ( array ) $user_meta->roles;

  if ( array_intersect($target_roles, $user_roles) ) {
    if ('manage_privacy_options' === $cap) {
      $manage_name = is_multisite() ? 'manage_network' : 'manage_options';
      $caps = array_diff($caps, [ $manage_name ]);
    }
  }

  return $caps;
}, 1, 4);

add_filter( 'editable_roles', function( $roles ){
  if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
    unset( $roles['administrator']);
  }
  return $roles;
});

add_filter( 'map_meta_cap', function( $caps, $cap, $user_id, $args ){
  switch( $cap ){
    case 'edit_user':
    case 'remove_user':
    case 'promote_user':
      if( isset($args[0]) && $args[0] == $user_id )
        break;
      elseif( !isset($args[0]) )
        $caps[] = 'do_not_allow';
        $other = new WP_User( absint($args[0]) );
        if( $other->has_cap( 'administrator' ) ){
          if(!current_user_can('administrator')){
            $caps[] = 'do_not_allow';
          }
        }
      break;
    case 'delete_user':
    case 'delete_users':
      if( !isset($args[0]) )
        break;
      $other = new WP_User( absint($args[0]) );
      if( $other->has_cap( 'administrator' ) ){
        if(!current_user_can('administrator')){
          $caps[] = 'do_not_allow';
        }
      }
      break;
    default:
      break;
  }
  return $caps;
}, 10, 4);
