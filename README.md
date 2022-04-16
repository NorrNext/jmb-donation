JMB Donation Description
============

Using the JMB Donation content plugin you can enable bloggers and content writers on your website to raise funds via PayPal or Yandex.Money. The plugin allows you to specify an account to receive funds and set the default price for each author. JMB Donation can enrich personal blogs or portals who have multiple writers, enabling each content author to specify their own merchant ID to which they can receive the donations.
Version: 1.0.3
Compatibility: Joomla 3.9.*

**Русская версия:**
JMB Donation - плагин JMB Donation позволяет собирать пожертвования через различные платежные системы (Яндекс деньги, PayPal).




Documentation
============

## 1. Getting Started
JMB Tree is a multi-functional Joomla module that allows you to build custom menus by combining selected menu items or display list of cateogories in selectbox. There are lot of settings to customize the final layout. You can display plain menu, dropdown menu and selectbox. The Module support ARIA standards and comes with several pre-defined layouts.

## 2. Installation
The module can be installed as typical Joomla extension. Go to <b>Administrator Panel > Extensions > Manage > Install > Upload Package</b>.
JMB Tree has implementation of Joomla Update System, so you will be informed about new available versions and can update the module in a few clicks via Administrator Area.

## 3. Configuration
### Module tab
**Include CSS** - you can include in-built CSS to stylize the menu. It can be disabled if you have custom CSS styles for the menu.

**Module type** - here you can choose which type should be used: _Menu items_ or _Categories tree_. The list of items (menu items or categories tree) below depends on this param. If you select Menu tree, you can select menu and see list of its items which are all marked by default. So, you can mark preferable items and to be displayed at front-end as custom menu. 
![jmb-tree-menu-items](https://user-images.githubusercontent.com/3432048/163677007-e8e1d312-3f95-4103-8903-26991cfe4c9f.png)
	List of menu items

If you mark parent item then all child items will be marked too. In case if you need to exclude parent item and display only child items, just use the param **Exclude menu items (specify ID, comma separated)**. 
E.g. according to the screenshot above, we need to exclude **France** menu item (ID=127). So, type **127** value in the associated field and this item will be excluded.

**Module layout** - here you can select layout (theme) to be used. Available layots: _default_, _dark_, _dropdown_ and _menu_.

**First item title of the list** - Specify custom first item title. This will be displayed in the dropdown list. If empty default will be used. This param can be useful to uniqualize the title. 
![jmb-tree-selectbox-title](https://user-images.githubusercontent.com/3432048/163677027-5f2449ae-bc20-4212-835d-97e73895e50f.png)
Choose menu item is standard title which can be renamed via the param. E.g. "Select your destination" or "Choose news section".

**End Level** - Level to stop rendering the menu at. If you choose 'All' then all levels will be displayed.
Example: if you need to display 1st and 2nd level menu items only, just select 3. First two levels will be rendered and the process be stopped at 3rd level.

**Add nofollow** - This will add rel='nofollow' tag to the links of menu items. It can be used in case if you want specified menu items not not be followed by Search Engine robots. Available options: _No_, _All links_, _Internal links_ and _External links_.

**Exclude nofollow items** - These menu items will not include nofollow tag (specify ID comma separated).

**Use level separator** - If yes, you can specify level separator in the field below. It will visually separate the menu levels. Please note that it may not work in some layouts.
![jmb-tree-level-separator-example](https://user-images.githubusercontent.com/3432048/163677042-d0274128-a167-4e32-955e-1578cad3da50.png)
On left side: Level Separator is enabled. On Right side it is disabled.

**Level separator** - Specify custom separator character of the menu items levels. You can leave it empty then tag 'nbsp' will be used.

**Use menu images** - If for a menu items images are set you can force not to use them. This will work for all menu items.

### Advanced tab
**Show backlink** - Using this param you can enable or disable backlink.

**Module Class Suffix** - using the suffix you can change vertical submenu appearance. The menu can be appeared to the left or to the right side. Predefined suffix styles in built-in CSS:
 _jmb-tree-left_ and  _jmb-tree-right _ (there should be empty symbol before the suffix)

![jmb-tree-right-suffix](https://user-images.githubusercontent.com/3432048/163677068-f7d977ee-0eb5-435e-a181-6cb5b1deac32.png)
<em>jmb-tree-right</em> suffix to display submenu to left side.

![jmb-tree-left-suffix](https://user-images.githubusercontent.com/3432048/163677082-9d615c80-c5a7-410e-a06e-880c50cf18d2.png)
<em>jmb-tree-left</em> suffix to display submenu to left side.

The rest of params below are typical to Joomla Advanced tab:
* Caching
* Cache Time
* Module Tag
* Bootstrap Size
* Header Tag
* Header Class
* Module Style


Unresolved issues:
==================
- Voiceover does not working correctly
- PHP notice
