# config-advanced-user-roles

This module builds on WordPress and Modularity.

Extend the default user roles and improve the role system. 

---

Version: 1.1.0

Author: Matze @ https://modularity.group

License: MIT

---

- adds aditional role 'developer' as a copy of 'administrator' butwithout ability to update core or install/update plugins and themes
- grant 'editor' role additional caps by default: manage users, manage menus and manage privacy options
- disallows non-admins to create or to uplevel administrator-users
- register a custom capability 'manage_fields' to ACF for managing fields
- add specific capability 'manage_fields' to 'administrator' and 'developer' role

**changelog**

1.1.0
- improve developer role creation process

1.0.1
- disallow editors and developers to delete users
