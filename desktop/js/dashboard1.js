

// Dashboard 1 Morris-chart

Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '10',
            G: 120,
            C: 1,
            H: 1,
            L:1,
            T:1
        }, {
            period: '20',
            G: 1,
            C: 234,
            H: 1,
            L:1,
            T:1
        }, {
            period: '30',
            G: 1,
            C: 1,
            H: 134,
            L:1,
            T:1
        }, {
            period: '40',
            G: 1,
            C: 1,
            H: 1,
            L:89,
            T:1
        }, {
            period: '50',
            G: 1,
            C: 1,
            H: 1,
            L:1,
            T: 220
        }],
        xkey: 'period',
        ykeys: ['G', 'C', 'H','L','T'],
        labels: ['GLUCOSA', 'COLESTEROL', 'HDL','LDL','TRIG'],
        pointSize: 8,
        fillOpacity: 0,
        pointStrokeColors:['#00bfc7', '#fb9678', '#9675ce','#00aff0','#e67e22'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 4,
        hideHover: 'auto',
        lineColors: ['#00bfc7', '#fb9678', '#9675ce','#00aff0','#e67e22'],
        resize: true
        
    });

Morris.Area({
        element: 'morris-area-chart2',
        data: [{
            period: '2010',
            SiteA: 0,
            SiteB: 0,
            
        }, {
            period: '2011',
            SiteA: 130,
            SiteB: 100,
            
        }, {
            period: '2012',
            SiteA: 80,
            SiteB: 60,
            
        }, {
            period: '2013',
            SiteA: 70,
            SiteB: 200,
            
        }, {
            period: '2014',
            SiteA: 180,
            SiteB: 150,
            
        }, {
            period: '2015',
            SiteA: 105,
            SiteB: 90,
            
        },
         {
            period: '2016',
            SiteA: 250,
            SiteB: 150,
           
        }],
        xkey: 'period',
        ykeys: ['SiteA', 'SiteB'],
        labels: ['Site A', 'Site B'],
        pointSize: 0,
        fillOpacity: 0.4,
        pointStrokeColors:['#b4becb', '#01c0c8'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        smooth: false,
        hideHover: 'auto',
        lineColors: ['#b4becb', '#01c0c8'],
        resize: true
        
    });

 
 $('.vcarousel').carousel({
            interval: 3000
         })
$(".counter").counterUp({
        delay: 100,
        time: 1200
    });

$(document).ready(function() {
    
   var sparklineLogin = function() { 
        $('#sales1').sparkline([20, 40, 30], {
            type: 'pie',
            height: '90',
            resize: true,
            sliceColors: ['#01c0c8', '#7d5ab6', '#ffffff']
        });
        $('#sparkline2dash').sparkline([6, 10, 9, 11, 9, 10, 12], {
            type: 'bar',
            height: '154',
            barWidth: '4',
            resize: true,
            barSpacing: '10',
            barColor: '#25a6f7'
        });
        
   }
    var sparkResize;
 
        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 500);
        });
        sparklineLogin();

});