# config-advanced-user-roles

This module builds on WordPress and Modularity.

Extend the default user roles and improve the role system. 

---

Version: 1.4.0

Author: Matze @ https://modularity.group

License: MIT

---

- adds additional role 'developer' as a copy of 'administrator' but without ability to install and theme update themes. Update core or install/update plugins and themes is only allowed if `wp_get_environment_type() == 'development'`
- adds additional role 'manager' as a copy of 'editor' but with additional caps: manage users, manage menus and manage privacy options
- disallows non-admins to create or to uplevel administrator-users
- register a custom capability 'manage_fields' to ACF for managing fields
- add specific capability 'manage_fields' to 'administrator' and 'developer' role
- delete contributor role
- add helper function `current_user_has_role($role)` to check if current user has specific role. WPs `current_user_can($role)` works also but is not ideal  

**changelog**

1.4.0
- allow role `developer` to update core, install and update plugins if `wp_get_environment_type() == 'development'`

1.3.0
- introduce helper-function `current_user_has_role()`

1.2.1
- set editor role to standard capabilities 
- introduce manager-role with capabilities to mangage users and nav menus

1.1.0
- improve developer role creation process

1.0.1
- disallow editors and developers to delete users
