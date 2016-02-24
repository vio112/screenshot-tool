
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('http://9gag.com', function () {
        page.render('9gag.com961064426_1024_768.jpg');
        phantom.exit();
    });
    