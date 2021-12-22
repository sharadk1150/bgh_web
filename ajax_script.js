
function loadData() {

    var $body = $('body');
    var $wikiElem = $('#wikipedia-links');
    var $nytHeaderElem = $('#nytimes-header');
    var $nytElem = $('#nytimes-articles');
    var $greeting = $('#greeting');

    // clear out old data before new request
    $wikiElem.text("The Wiki Element Lists are New");
    $nytElem.text("Ny times Elements nee to go here");

    // load streetview
    $body.append('<img class="bgimg" src="sail-logo.jpg">');

    // YOUR CODE GOES HERE!
    
    

    return false;
};

$('#form-container').submit(loadData);

// loadData();
