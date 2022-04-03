# php-opcache
Demonstration of PHP's opcache feature for pre-loading files. This makes requests quicker to handle as there's less digging around in the filesystem looking for files on each request

## files

`docker-compose.yml`

Entry point for Docker to load the example environment.

Points to note here: Database credentials added as environment variables for PHP to use, also specified in the Mysql server section for ease of setup.


`setup/PHP.Dockerfile`

This is an image built for running the PHP 8.1 in "fast-cgi" mode to work with Nginx.
This needs to be a separate image for enabling opcache and providing the config for it.


`setup/opcache.ini`

This is where we configure the pre-loading script.  `opcache.preload` must point to a php script that can do pretty much anything, but the obvious use is to include/require other files.  Seems this doesn't work for defining constants in the global space (but does work for a class with static const members).


`src/preload.php`

The preloading file.  This file just reads a list of other files and imports each one using the `opcache_compile_file` function.  This compiles the files into bytecode and loads that in memory.  It doesn't execute anything in the files (so side-effects shouldn't be possible).


`src/vendor/SourcePot/Database.php`

An example Datbase singleton class.  Simply connects to the database when requested and uses the Config classes members for connection parameters.


`src/vendor/SourcePot/Http/Response.php`

An example Response class.  Provides the ability to set headers and send some output.


`src/html/index.php`

Example entry point for a website that makes use of the pre-loaded classes without naming an autoloader of manually importing the files.
