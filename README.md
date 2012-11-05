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
# https://github.com/jbroadway/menubuilder

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

Each menu starts with a top-level `menu:` section.

Each section contains one or more items with the following properties:

* label - The text to display in the link.
* page - The ID of the page in the site.
* link - An external link instead of specifying an internal page.
* class - A CSS class to assign to the item in HTML tags.
* menu - A list of sub-items.

The label and either page or link are required. The rest is optional.
