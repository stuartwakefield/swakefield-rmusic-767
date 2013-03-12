# Radio & Music Programme Finder

Stuart Wakefield

The project has been broken down into the following main components:

### JSAPI

This is the API the JavaScript layer in the application sends Ajax requests. 
This application is a micro application written in Slim and uses the
searchextended client to connect to the ION service.

### SearchExtended client

The searchextended client is a basic cURL client that consumes the 
ION web service it is located in `lib/searchextended`.

### Theme

The stylesheets for the application are written using SASS and Compass and
reside in the `theme` directory.

### JS

The JavaScript Ajax application is written using Backbone and resides in the
`js` directory.

### Main application

There are two versions of the main application, there is an object-oriented
compositional approach that makes the most use out of the script based 
invokation of PHP. This is in the `oo` directory. By not centralising the 
architecture and instead sharing functionality and data through composition, 
performance is far better but requires much more skill to keep this kind of 
application on the tracks as the application grows. 

This approach is a good fit for micro applications and services approaches. 

The other main application is a Zend application in the directory `zend`. Both
applications share resources in the `app` directory.

## Building

You will need:

- ANT for building
- Composer for resolving PHP dependencies
- Compass for building the CSS
- Behat and Mink
- Mocha
- PHPUnit
- Node.js

Copy the `ant.properties.dist` file and add in the properties to match your
environment.

**Note:** If you are running *nix, please update the build.xml to execute the 
appropriate version of the executables.

Then run the ANT build. The test output for the PHPUnit and Mocha tests will
be sent to the `reports` directory.

## Launching

I have included a sample vhost configuration to set the application up on an
Apache web server. Once Apache is set up, to view the application either go to

	http://swakefield-rmusic767.local/oo

Or...
	
	http://swakefield-rmusic767.local/zend

## Testing

To perform testing on the main application you will need Behat and Mink. It is
best that these are installed globally using the PEAR package manager. The
tests for the application are in the features directory.

The feature and scenarios haven't been copied like for like from the original
specification, `features/rmusic-767`. There were a few technical and user 
interface details included in the original specification. In this case I have
simply rewritten them slightly to make the scenarios less brittle, this would
have normally involved communication with the product manager.

The tests are quite brittle at the moment, there are some dependencies on the 
structure of the page and dependencies on services outside of our control. 

Individual components should be tested to work under all cases, for example 
catering for the fact that the web service may take too long to respond or may
be down.

The test will also be quite slow as there is some waiting time. Given more time 
I would be inclined to create a controllable mock service that can simulate 
timeouts, non-responsiveness and unexpected responses and then integrate this 
with the testing. With this control over the scenarios it is possible condense 
the timings down to create some very high performance test suites.

To install Behat and mink, execute the following commands:

		pear channel-discover pear.behat.org
		pear channel-discover pear.symfony.com
		pear install -a behat/behat behat/mink
	
To perform JavaScript testing you will need Mocha, [PhantomJS][phantomjs] and
MochaPhantomJS.

		npm install -g mocha
		npm install -g mocha-phantomjs

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