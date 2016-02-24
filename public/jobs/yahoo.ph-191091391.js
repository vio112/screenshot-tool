
    var page = require('webpage').create();
    page.viewportSize = { width: 1024, height: 768 };
    
    page.open('http://yahoo.ph', function () {
        page.render('yahoo.ph-2103403538_1024_768.jpg');
        phantom.exit();
    });
    