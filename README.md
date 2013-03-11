# Radio & Music Programme Finder

You will need to install Composer http://getcomposer.org/doc/00-intro.md, run
the command `composer install` for the directories `zend`, `jsapi`.

The Apache configuration file is in the `config` directory, you can use this
to set up the applications.

- The JS API. This is where the JavaScript layer in the application sends Ajax
  requests. This application is a tiny application written in Slim and uses the
  searchextended client in the `lib` directory.
- The searchextended client is a basic client that consumes the searchextended
  web service it is located in `lib/searchextended`
- The `theme` directory contains all of the stylesheets for the application,
  these are written using SASS and Compass.
- The `js` directory contains the JavaScript Ajax application, it is written
  using Backbone.
- There are two versions of the main application, there is an object-oriented
  compositional approach that makes the most use out of the script based 
  invokation of PHP. By not centralising the architecture and instead sharing
  functionality and data through composition performance is far better but 
  requires much more skill to keep this kind of application on the tracks as
  the application grows. As a result this approach is a better fit for micro
  applications and micro services approaches. This is in the directory `oo`. 
  The other main application is a basic Zend application in the `zend` 
  directory.

## Building

- Compass

## Launching

Once Apache is set up, either go to...

	http://swakefield-rmusic767.local/oo

Or...
	
	http://swakefield-rmusic767.local/zend

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

There is a tonne of error handling that isn't done and should be, for example
what happens when the web service isn't responding, etc.