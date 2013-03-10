# Radio & Music Programme Finder

You will need to install Composer http://getcomposer.org/doc/00-intro.md, run
the following command at the base directory.

	composer install

Run from the base directory

	php deps/composer.phar install

## Building

...?

## Launching

	http://swakefield-rmusic767.local/pure
	http://swakefield-rmusic767.local/zend
	http://swakefield-rmusic767.local/symfony
	http://swakefield-rmusic767.local/codeigniter
	http://swakefield-rmusic767.local/slim

## Testing

The feature and scenarios haven't been copied like for like from the original
specification, `features/rmusic-767`. There were a few technical and user 
interface details included in the original specification. In this case I have
simply rewritten them slightly to make the scenarios less brittle, this would
have normally involved communication with the product manager.

- Behat
- Mink
- Selenium Server
- Jenkins

## Developing

Some bugs found in the ION service:

- Omitting the perpage attribute results in incorrect information in the 
  returned response under the pagination key, shows incorrect per_page (3000).
- The response contains one additional item in the block list than the submitted
  perpage attribute, i.e. perpage/10 actually returns 11 results.
- Omitting the required search_availability attribute produces an internal error
  which leaks some information about the server file system, it also produces a
  404 Not Found response. A 400 Bad Request is more accurate.

Also, the format parameter wasn't in the documentation (other than the example).
