# MenuBuilder

A menu builder for the [Elefant CMS](http://www.elefantcms.com/)
based on using [YAML](http://www.yaml.org/) formatting to define
as many custom menus as you want.

MenuBuilder then provides a set of dynamic menu objects for
embedding your menus into your website through the WYSIWYG
editor's Dynamic Objects dialog.

## Formatting

Here is an example menu:

```yaml
# This file defines a menu structure in your website.
# For formatting info, visit:
# http://www.elefantcms.com/wiki/MenuBuilder

menu:
  - label: Home
    page: index
    class: menu-home
  - label: Blog
    link: /blog
    class: menu-blog
  - label: Services
    page: services
    menu:
      - label: Web Design
        page: web-design
      - label: Social Media
        page: social-media
      - label: Branding
        page: branding
  - label: Contact Us
    page: contact-us
```
