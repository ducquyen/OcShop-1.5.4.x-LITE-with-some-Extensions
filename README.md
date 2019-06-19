Changes made:

     changed header
     The 3rd category category output has been added to the header menu.
     in the administrative part of the system -> settings -> images: added the ability to download images with contacts and organized output on the site
     in the administrative part added auto filling seo url \ cnc
     in the administrative part of the catalog -> goods: added filter by category and manufacturer of goods
     in the administrative part of the system -> settings -> showcase: added input keywords and organized output on the site
     in the administrative part of the category \ products \ information \ reviews: buttons on / off added
     in the administrative part of the category \ manufacturers \ products \ information \ reviews \ options \ attributes: the menu under the list is duplicated
     minor edits made to language files
     removed English
     module manufacturers module logic is added: only those manufacturers whose products are presented in this category are displayed in the category, when switching to the manufacturer, the products are displayed taking into account the category / manufacturer.
     Fixed H1 output in the category \ manufacturer \ product ...
     changed sorting type in category \ manufacturer
     pagination view changed
     Added sorting by views \ product popularity
     The name of the catalog has been added in the administrative part -> Goods \ Categories \ Manufacturers in Header
     Date format has been changed in the administrative part - hours and minutes for creating an order / user registration have been added ...
     in the administrative part added highlighting of the active line
     in the user part in the product card, the construction of the breadcrumbs is changed when the main category is selected by the last link instead of the product name, the manufacturer is now displayed and when clicking on the link, the products are displayed taking into account the main category \ manufacturer
     in the administrative part of the listing of goods added image editing \ name \ model \ price \ quantity and status change enabled \ disabled
     changes in the design of the administrative part
         reduced header.tpl
         a script showing / hiding statistics has been added to the dashboard
         Added buttons to quickly jump to products \ categories \ manufacturers \ orders \ buyers
     ckeditor version 4 is installed in the administrative part
     image manager pro is installed in the administrative part
     in the administrative part, the cache manager is installed, deleting the system cache and images
     in the administrative part, the SEO Manager is installed in the request; the SEO Keyword is added during the installation:
         specials
         brands
         contact-us
         sitemap
     Integrated sora product filter
     Added a short description in the categories \ manufacturers \ search \ promotions
     Added Tab Video in the product card
     Images of 2nd level categories and links to 3rd level categories
     Module Categories \ Subcategories for Home Page
     Ajax reviews removed in reviews are now indexed
     Added noindex follow tags for filter sorting pagination pages and manufacturers robots.txt adjustment
     Sort by default price
     Number of Reviews in categories \ manufacturers \ search \ promotions
     Product availability in categories \ manufacturers \ search \ promotions
     Added script AddToCopy add link when copying content
     Added status 404 for disabled products \ categories \ manufacturers \ articles \ error pages
     Removed h1 on the main page which was hidden in display: none;
     Added script scroll page up
     Added promo stickers Promotion and Sold in products \ categories \ manufacturers \ promotions \ search
     Added HTML module added condition to display block style when there is no title
     Added Taba 4 Module in one New \ Shares \ Recommended \ Bestsellers
     Added Store Feedback Module
     Added module latest reviews
     Added Module Cart Recycle \ Compare \ Notes
     Added yaSlider Pro (displays description text \ short description \ text from the Slider field in the product)
     Detailed notification of the order to the store administrator
     Modification seo_pro
         slash added in categories / manufacturers (left for manufacturers .html left)
         redirect from pages without seo url to pages with it
         correct multilanguage for additional languages ​​is added / ua / en and so on
     Payment method added Cash on delivery
     Added delivery method New Mail
     Added courier delivery method for the city depending on the amount of the order
