# Radio & Music Programme Finder

Stuart Wakefield



### Installation

You will need to install Composer http://getcomposer.org/doc/00-intro.md, run
the command `composer install` for the directories `zend`, `jsapi`.

The Apache configuration file is in the `config` directory, you can use this
to set up the applications.

### JSAPI

The JS API. This is where the JavaScript layer in the application sends Ajax
requests. This application is a tiny application written in Slim and uses the
searchextended client in the `lib` directory.

### SearchExtended client

The searchextended client is a basic client that consumes the searchextended
web service it is located in `lib/searchextended`.

### Theme

The stylesheets for the application are written using SASS and Compass.

### JS

The JavaScript Ajax application is written using Backbone.

### Main application

There are two versions of the main application, there is an object-oriented
compositional approach that makes the most use out of the script based 
invokation of PHP. By not centralising the architecture and instead sharing
functionality and data through composition, performance is far better but 
requires much more skill to keep this kind of application on the tracks as
the application grows. This approach is a better fit for micro applications 
and micro services approaches. 

The other main application is a Zend application in the directory.

## Building

You will need:

- ANT for building
- Composer for resolving PHP dependencies
- Compass for building the CSS. 

Copy the `ant.properties.dist` file and add in the required properties.

**Note:** If you are running *nix, please update the build.xml to execute the 
appropriate version of the executables (a Pull request would be appreciated). 

Then run the ANT build

## Launching

Once Apache is set up, either go to

	http://swakefield-rmusic767.local/oo

Or...
	
	http://swakefield-rmusic767.local/zend

## Testing

To perform testing on the main application you will need Behat and Mink. It is
best that these are installed globally using the PEAR package manager. 

To install Behat and mink, execute the following commands:

		pear channel-discover pear.behat.org
		pear channel-discover pear.symfony.org
		pear install -a behat/behat behat/mink
	
- Mocha

		npm install -g mocha

- PhantomJS, [available for download here][phantomjs].
- MochaPhantomJS

		npm install -g mocha-phantomjs

The tests are quite brittle at the moment, there are some dependencies on the 
structure of the page and dependencies on services outside of our control. 

Individual components should be tested to work under all cases, for example what
should happens when the searchextended service is down, the interface should be 
resilient and respond appropriately to the user. The test will also be quite 
slow as there is some waiting time. Given more time I would be inclined to 
create a controllable mock service that can simulate timeouts, 
non-responsiveness and unexpected responses and then integrate this with the 
testing. With this control over the scenarios it is possible condense the 
timings down to create some very high performance test suites.

## Notes

Some bugs found in the ION service:

- Omitting the perpage attribute results in incorrect information in the 
  returned response under the pagination key, shows incorrect per_page (3000).
- The response contains one additional item in the block list than the submitted
  perpage attribute, i.e. perpage/10 actually returns 11 results.
- Omitting the required search_availability attribute produces an internal error
  which leaks some information about the server file system, it also produces a
  404 Not Found response. A 400 Bad Request is more accurate.

Also, the format parameter wasn't in the documentation (other than the example).

[phantomjs]:http://phantomjs.org/download.html