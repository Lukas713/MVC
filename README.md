<h1>Building MVC framework with PHP</h1>
<h3>Project structure:<h3><hr>
<pre>
  d-App
    d-Controllers
      d-Admin
    d-Views
    d-Models
  d-Core
    l-Dispatcher 
    l-Controller
    l-View
  d-public
    .htaccess
    l-index.php
   d-vendor
   </pre>
   <hr>
<h3> Routing: how URLs are processed in n MVC framework </h3>
      <ol>
        <li>Create a central entry point to the framework: the front controller</li>
        <li>Configure the web server to have pretty URLs</li>
        <li>Get the controller and action from a URL with a variable structure, using regular expression</li>
      </ol><hr>
 <h3>Controllers and actions</h3>
    <ol>
        <li>Dispatch the route: create the controller object and run the action method</li>
        <li>Load classes automatically: add namespaces and an autoload function. (with composer)</li>
        <li>Remove query string variables from the URL before matching to a route</li>
        <li>Action filters: call a method before and after every action in a controller</li>
    </ol><hr>
 <h3>Views</h3>
     <ol>
         <li>Display a view: create a class to render views and use it in a controller</li>
         <li>Make views easier to create and maintain: add a template engine (with Twig)</li>
         <li>Remove repetition in the view templates: add a base template to inherit from</li>
     </ol><hr>
 <h3>Models</h3>
     <ol>
        <li> Add a model, get data from the database and display it in a view</li>
        <li>Optimise the database connection: connect only on demand and reuse it</li>
     </ol>
 <h3>Manage code using Composer</h3>
    <ol>
        <li>Install the template engine library Twig using Composer</li>
        <li>Include all package classes automatically using the Composer autoloader</li>
        <li>Replace the autoload function with the Composer autoloader</li>
    </ol>
 <h3>Error handling</h3>
    <ol>
        <li>Put application configuration settings in a separate file</li>
        <li>Handle errors: convert errors to exceptions and add an exception handler</li>
        <li>Handle errors: convert errors to exceptions and add an exception handler</li>
        <li>Categorise different types of error using HTTP status codes</li>
        <li>Add views to make error pages look nicer for users</li>
    </ol>