$(document).ready(function()
{
    $('#comment').wysihtml5({
        "style": true,
        "font-size": true,
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": true, //Button to insert an image. Default true,
        "color": true, //Button to change color of font  
        "stylesheets": ['/css/wysihtml5-colors.css'], //CSS stylesheets to load
        parser: function(html) {
            return html;
        }
    });
});
