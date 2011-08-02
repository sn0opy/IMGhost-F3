IMGhost-f3 by Sascha Ohms
============================

INFO
----

This version of IMGhost is highly improved. It uses the Fat Free Framework as  base, has a
new design and the code is better arranged

### Thanks to
* Bong Cosca for Fat Free Framework (http://fatfree.sf.net)

INSTALLATION
------------

Simply edit the .htacces to fit your RewriteBase (Apache)

Note: you **SHOULD** change the filename of your db on line 8 of the index.php!

### Lighttpd User?
Use the following snippet instead of .htaccess

    url.rewrite-once = ("^/([^.]+)$" => "/index.php?$1")

REQUIREMENTS
------------

You need the following to run ToothPaste

* PHP 5.3
* SQLite
* PDO (and / or PDO SQLite)

LICENCE
-------

This product is licensed under the GNU Lesser General Public License (LGPL)
