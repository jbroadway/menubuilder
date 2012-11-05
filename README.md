# Menu Builder

A menu builder for the [Elefant CMS](http://www.elefantcms.com/)
based on using [YAML](http://www.yaml.org/) formatting to define
as many custom menus as you want.

Menu Builder then provides a set of dynamic menu objects for
embedding your menus into your website through the WYSIWYG
editor's Dynamic Objects dialog.

Menu Builder works as an alternative to Elefant's built-in
single-tree navigation app. Editing menus as YAML files may
not be for everyone, but the added flexibility will hopefully
be useful to some.

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

## Integration

You can integrate menus into your site in one of two ways:

1. In the WYSIWYG editor's Dynamic Objects dialog, you'll see a number
of new objects like `Menu: Breadcrumb` and `Menu: Contextual`. These will
embed different kinds of menus into your page.

2. In your layout templates, you can include a menu directly with the
following tags:

    {! menubuilder/menu/breadcrumb?menu=Main !}
    
    {! menubuilder/menu/contextual?menu=Main !}
    
    {! menubuilder/menu/dropmenu?menu=Main !}
    
    {! menubuilder/menu/single?menu=Main !}
    
    {! menubuilder/menu/sitemap?menu=Main !}
