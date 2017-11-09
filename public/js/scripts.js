
function plot() {
Chart.defaults.global = {
    
    
    
    // Boolean - Whether to animate the chart
    animation: true,

    // Number - Number of animation steps
    animationSteps: 60,

    // String - Animation easing effect
    // Possible effects are:
    // [easeInOutQuart, linear, easeOutBounce, easeInBack, easeInOutQuad,
    //  easeOutQuart, easeOutQuad, easeInOutBounce, easeOutSine, easeInOutCubic,
    //  easeInExpo, easeInOutBack, easeInCirc, easeInOutElastic, easeOutBack,
    //  easeInQuad, easeInOutExpo, easeInQuart, easeOutQuint, easeInOutCirc,
    //  easeInSine, easeOutExpo, easeOutCirc, easeOutCubic, easeInQuint,
    //  easeInElastic, easeInOutSine, easeInOutQuint, easeInBounce,
    //  easeOutElastic, easeInCubic]
    animationEasing: "easeOutQuart",

    // Boolean - If we should show the scale at all
    showScale: true,

    // Boolean - If we want to override with a hard coded scale
    scaleOverride: false,

    // ** Required if scaleOverride is true **
    // Number - The number of steps in a hard coded scale
    scaleSteps: null,
    // Number - The value jump in the hard coded scale
    scaleStepWidth: null,
    // Number - The scale starting value
    scaleStartValue: null,

    // String - Colour of the scale line
    scaleLineColor: "rgba(0,0,0,.1)",

    // Number - Pixel width of the scale line
    scaleLineWidth: 1,

    // Boolean - Whether to show labels on the scale
    scaleShowLabels: true,

    // Interpolated JS string - can access value
    scaleLabel: "<%=value%>",

    // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
    scaleIntegersOnly: true,

    // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero: false,

    // String - Scale label font declaration for the scale label
    scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Scale label font size in pixels
    scaleFontSize: 12,

    // String - Scale label font weight style
    scaleFontStyle: "normal",

    // String - Scale label font colour
    scaleFontColor: "#666",

    // Boolean - whether or not the chart should be responsive and resize when the browser does.
    responsive: false,

    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,

    // Boolean - Determines whether to draw tooltips on the canvas or not
    showTooltips: true,



    // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
    customTooltips: false,

    // Array - Array of string names to attach tooltip events
    tooltipEvents: ["mousemove", "touchstart", "touchmove"],

    // String - Tooltip background colour
    tooltipFillColor: "rgba(0,0,0,0.8)",

    // String - Tooltip label font declaration for the scale label
    tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip label font size in pixels
    tooltipFontSize: 14,

    // String - Tooltip font weight style
    tooltipFontStyle: "normal",

    // String - Tooltip label font colour
    tooltipFontColor: "#fff",

    // String - Tooltip title font declaration for the scale label
    tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

    // Number - Tooltip title font size in pixels
    tooltipTitleFontSize: 14,

    // String - Tooltip title font weight style
    tooltipTitleFontStyle: "bold",

    // String - Tooltip title font colour
    tooltipTitleFontColor: "#fff",

    // Number - pixel width of padding around tooltip text
    tooltipYPadding: 6,

    // Number - pixel width of padding around tooltip text
    tooltipXPadding: 6,

    // Number - Size of the caret on the tooltip
    tooltipCaretSize: 8,

    // Number - Pixel radius of the tooltip border
    tooltipCornerRadius: 6,

    // Number - Pixel offset from point x to tooltip edge
    tooltipXOffset: 10,

    // String - Template string for single tooltips
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",

    // String - Template string for multiple tooltips
    multiTooltipTemplate: "<%= value %>",

    // Function - Will fire on animation progression.
    onAnimationProgress: function(){},

    // Function - Will fire on animation completion.
    onAnimationComplete: function(){}
};

var options = {
    
    showXLabels : 15,

    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,

    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: false,

    //Boolean - Whether the line is curved between points
    bezierCurve : true,

    //Number - Tension of the bezier curve between points
    bezierCurveTension : 0.4,

    //Boolean - Whether to show a dot for each point
    pointDot : true,

    //Number - Radius of each point dot in pixels
    pointDotRadius : 1,

    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth : 1,

    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 1.5,

    //Boolean - Whether to show a stroke for datasets
    datasetStroke : true,

    //Number - Pixel width of dataset stroke
    datasetStrokeWidth : 2,

    //Boolean - Whether to fill the dataset with a colour
    datasetFill : true,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

};


var candidateColor = {
    "gpoe": "rgba(137,207,240,",
    "mroxas": "rgba(220,220,0,",
    "jbinay": "rgba(255,140,0,",
    "rduterte": "rgba(0,0,139,",
    "msantiago": "rgba(178,34,34,"
}


var parameters = {
        candidate: document.getElementById('heading').getAttribute('name')
    };



    $.getJSON("fetch.php", parameters)
    .done(function(data, textStatus, jqXHR) {

        //on success
        
        var elem = document.getElementById("loading");
elem.parentNode.removeChild(elem);
        
        data = {
    labels: data.times,
    datasets: [
        {
            label: "Tweets",
            fillColor: candidateColor[parameters.candidate]+"0.2)",
            strokeColor: candidateColor[parameters.candidate]+"1)",
            pointColor: candidateColor[parameters.candidate]+"1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: candidateColor[parameters.candidate]+"1)",
            data: data.tweets
        },
        
    ]
};
    
    
    var ctx = document.getElementById("myChart").getContext("2d");
    var myLineChart = new Chart(ctx).Line(data, options);
    
    
        
    })
    .fail(function(jqXHR, textStatus, errorThrown) {

        // log error to browser's console
        console.log(errorThrown.toString()+" textstatus: "+textStatus+" jqXHR: "+jqXHR);
    });
    
}




function fetch_recent()
{
    var parameters = {
        candidate: document.title.substr(10)
    };
    
    var can = document.getElementById('heading').getAttribute('name');
       
       var candidateColor = {
    "gpoe": "rgba(137,207,240,0.1)",
    "mroxas": "rgba(220,220,0,0.1)",
    "jbinay": "rgba(255,140,0,0.1)",
    "rduterte": "rgba(0,0,139,0.1)",
    "msantiago": "rgba(178,34,34,0.1)"
    }
    
    var colorstring = "background-color : "+candidateColor[can];
    
    $.getJSON("fetch_top.php", parameters)
    .done(function(data, textStatus, jqXHR) {

        //on success
        var tweet;
        
        if (data.recent.statuses.length <1){
       document.getElementById('table1').innerHTML = "No recent tweets found";}
       
       
       
        
        //document.write(JSON.stringify(data));
        for (tweet of data.recent.statuses)
        {
            
            
            var td0 = document.createElement("td");
        var node = document.createTextNode(tweet.created_at.substr(0,16));
        td0.appendChild(node);
        
            var td1 = document.createElement("td");
        node = document.createTextNode(tweet.user.name);
        td1.appendChild(node);
        
            var td2 = document.createElement("td");
        node = document.createTextNode(tweet.text);
        td2.appendChild(node);
        
        var tr = document.createElement('tr');
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td0);

        var element = document.getElementById("table");
        element.appendChild(tr);
        
        
    var att = document.createAttribute("style");
    att.value = colorstring;
    tr.setAttributeNode(att);
            
        }
        
        var elem = document.getElementById("loading1");
elem.parentNode.removeChild(elem);
        
        
    
    
        
    })
    .fail(function(jqXHR, textStatus, errorThrown) {

        // log error to browser's console
        console.log(errorThrown.toString()+" textstatus: "+textStatus+" jqXHR: "+jqXHR);
    });
    
}

function fetch_top()
{
    var parameters = {
        candidate: document.title.substr(10)
    };
    
    var can = document.getElementById('heading').getAttribute('name');
       
       var candidateColor = {
    "gpoe": "rgba(137,207,240,0.1)",
    "mroxas": "rgba(220,220,0,0.1)",
    "jbinay": "rgba(255,140,0,0.1)",
    "rduterte": "rgba(0,0,139,0.1)",
    "msantiago": "rgba(178,34,34,0.1)"
    }
    
    var colorstring = "background-color : "+candidateColor[can];
    
    $.getJSON("fetch_top.php", parameters)
    .done(function(data, textStatus, jqXHR) {

        //on success
       var tweet;
       
       
       if (data.popular.statuses.length <1){
       document.getElementById('table1').innerHTML = "No popular tweets found";}
        
        for (tweet of data.popular.statuses)
        {
            
            
            var td0 = document.createElement("td");
        var node = document.createTextNode(tweet.created_at.substr(0,16));
        td0.appendChild(node);
        
            var td1 = document.createElement("td");
        node = document.createTextNode(tweet.user.name);
        td1.appendChild(node);
        
            var td2 = document.createElement("td");
        node = document.createTextNode(tweet.text);
        td2.appendChild(node);
        
        var tr = document.createElement('tr');
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td0);

        var element = document.getElementById("table1");
        element.appendChild(tr);
        
        var att = document.createAttribute("style");
    att.value = colorstring;
    tr.setAttributeNode(att);
            
        }
        
        var elem = document.getElementById("loading2");
        elem.parentNode.removeChild(elem);
        
        
    
    
        
    })
    .fail(function(jqXHR, textStatus, errorThrown) {

        // log error to browser's console
        console.log(errorThrown.toString()+" textstatus: "+textStatus+" jqXHR: "+jqXHR);
    });
    
    
    
    
    
}