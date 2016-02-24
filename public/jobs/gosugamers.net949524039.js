
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('http://gosugamers.net', function () {
        page.render('gosugamers.net-740867977_1024_768.jpg');
        phantom.exit();
    });
    