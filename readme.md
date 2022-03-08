# config-advanced-user-roles

This module builds on WordPress and Modularity.

Extend the default user roles and improve the role system. 

---

Version: 1.2.1

Author: Matze @ https://modularity.group

License: MIT

---

- adds additional role 'developer' as a copy of 'administrator' but without ability to update core or install/update plugins and themes. jusr activate
- adds additional role 'manager' as a copy of 'editor' but with additional caps: manage users, manage menus and manage privacy options
- disallows non-admins to create or to uplevel administrator-users
- register a custom capability 'manage_fields' to ACF for managing fields
- add specific capability 'manage_fields' to 'administrator' and 'developer' role
- delete contributor role

**changelog**

1.2.1
- set editor role to standard capabilities 
- introduce manager-role with capabilities to mangage users and nav menus

1.1.0
- improve developer role creation process

1.0.1
- disallow editors and developers to delete users
