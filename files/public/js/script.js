$(function(){

    
    // ==== open menu ====
    
    $("#hamburger").on("click", function (){
        
        $("#hamburger").addClass("animated bounceIn");
        $("#hamburger").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
            $(this).removeClass("animated bounceIn");
           
        });
        
        $("#menu-overlay").removeClass("hide");

        $("#menu-overlay").addClass("animated slideInLeft");
        $("#menu-overlay").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
            $(this).removeClass("animated slideInLeft");
           
        });
        
            $("#menu-close").addClass("animated rotateIn");
            $("#menu-close").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
                $(this).removeClass("animated rotateIn");
                e.stopPropagation();
            });
            $(".animate-list").removeClass("hide").addClass("animated slideInLeft");
            $(".animate-list").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
                $(this).removeClass("animated slideInLeft");
                e.stopPropagation();
            });
    });
    
    // ==== close menu =====
    
    $("#menu-close").on("click", function (){
        
        $("#menu-overlay").addClass("animated slideOutLeft delayed");
        $("#menu-overlay").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
            $(this).removeClass("animated slideOutLeft delayed");
            $(this).addClass("hide");
        });
//        
        $(".animate-list").addClass("animated slideOutLeft");
        $(".animate-list").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
            e.stopPropagation();
            
            // console.log(this);
            $(this).removeClass("animated slideOutLeft").addClass("hide");
            
        });
        
        $("#menu-close").addClass("animated rotateOut");
        $("#menu-close").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(e){
            $(this).removeClass("animated rotateOut delayed");
            e.stopPropagation();
        });

    });
    
    // ==== add tool plus ====
    
    $("#cross").on("click", function (e){
        
        e.preventDefault();
        var href= this.parentNode.href;
        
        $("#cross").addClass("animated bounceIn");
        $("#cross").one("animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd",function(){
            $(this).removeClass("animated bounceIn");
            window.location = href;
        });
    });
    
    // ==== datepicker ====
    
    $( ".cal" ).datepicker({ dateFormat: 'dd/mm/yy' });
    
    // ==== success message ====


    $(".success-form").delay(1000).queue(function(nxt) {
          $(this).addClass('animated fadeOut');
          nxt();
    });

    $(".success-form2").delay(1000).queue(function(nxt) {
          $(this).addClass('animated fadeOut');
          nxt();
    });

    // ==== error message ====
    
    $(".error-form").delay(1000).queue(function(nxt) {
          $(this).addClass('animated fadeOut');
          nxt();
    });

    // ==== jquery editable ====

    $(".edit-button").on("click", function (){

      $(this).parent().parent().find('[data-editable-userid]').trigger("edit");
    });

    $("[data-editable-userid]").each(function(i,el){

        var url = window.location.href + '/' + $(el).attr('data-editable-userid');

        var options ={

          event : "edit",
          data: " {'Yes':'Yes','No':'No'}",
          type: 'select',
          cssclass: "editable",
          submitdata: {
            _method: "PUT",
            _token: $("#token").text()
          },
          submit:"OK"
        };

        // console.log(options);

        $(el).editable(url,options);

    }); // end of users editable


    // ==== notifications close ====

    $(".dismiss-notification").on("click",function(e){

        e.preventDefault();

        var url = $(this).attr("href");

        var data = {
          _method: "PUT",
          _token: $("#token").text(),
          has_read: "Yes"
        };
        console.log(data);

        $.post(url,data,function(res){
          console.log(res);
        });

        $(this).parent().parent().addClass('animated fadeOut').delay(1000).queue(function(nxt) {
              $(this).addClass('hide');
        });
    });

});// end of script

$(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images
    
    // ==== spinner ====

    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");

    // ==== d3 donut charts ====
    
    var data1 = [
        {dept: '', count : 5, color:"#29ffc7", link:"notifications"},
        {dept: '', count : 100, color:"#1fb890", link:"notifications"}
    ];


    var data2 = [
        {dept: '', count : 10, color:"#29ffc7", link:"tools?type=Personal"},
        {dept: '', count : 100, color:"#1fb890", link:"tools?type=Personal"}   
    ];

    var data3 = [
        {dept: '', count : 4, color:"#f68686", link:"tools?type=Personal"},
        {dept: '', count : 100, color:"#eb5757", link:"tools?type=Personal"} 
    ];
    
    var data4 = [
        {dept: '', count : 12, color:"#29ffc7", link:"users"},
        {dept: '', count : 100, color:"#1fb890", link:"users"}
    ];
    
    var data5 = [
        {dept: '', count : 8, color:"#29ffc7", link:"tools?type=Company"},
        {dept: '', count : 100, color:"#1fb890", link:"tools?type=Company"}
    ];
    
    var data6 = [
        {dept: '', count : 3, color:"#f68686", link:"tools?type=Company"},
        {dept: '', count : 100, color:"#eb5757", link:"tools?type=Company"} 
    ];
    
    var data7 = [
        {dept: '', count : 5, color:"#29ffc7", link:"sites"},
        {dept: '', count : 100, color:"#1fb890", link:"sites"} 
    ];


    var maxWidth = 230;
    var maxHeight = 230;
    var outerRadius = 110;
    var ringWidth = 30;

    // This function helps you figure out when all
    // the elements have finished transitioning
    // Reference: https://groups.google.com/d/msg/d3-js/WC_7Xi6VV50/j1HK0vIWI-EJ
    function checkEndAll(transition, callback) {
        var n = 0;
        transition
        .each(function() { ++n; })
        .each("end", function() {
            if (!--n) callback.apply(this, arguments);
        });
    }    

    function drawAnimatedRingChart(config) {
        var pie = d3.layout.pie().value(function (d) {
            return d.count;
        });

        var color = d3.scale.category10();

        console.log(color);
        var arc = d3.svg.arc();

        // This function helps transition between
        // a starting point and an ending point
        // Also see: http://jsfiddle.net/Nw62g/3/
        function tweenPie(finish) {
            var start = {
                    startAngle: 0,
                    endAngle: 0
                };
            var i = d3.interpolate(start, finish);
            return function(d) { return arc(i(d)); };
        }
        arc.outerRadius(config.outerRadius || outerRadius)
            .innerRadius(config.innerRadius || innerRadius);

        // Remove the previous ring
        d3.select(config.el).selectAll('g').remove();

        var svg = d3.select(config.el)
            .attr({
                width : maxWidth,
                height: maxHeight
            });

        // Add the groups that will hold the arcs
        var groups = svg.selectAll('g.arc')
        .data(pie(config.data))
        .enter()
        .append('g')
        .attr({
            'class': 'arc',
            'transform': 'translate(' + outerRadius + ', ' + outerRadius + ')'
        })

        // Make each arc clickable 
        
        //chart 1 link
        d3.select("#chart1").on("click", function(d, i) {
          window.location = data1[i].link;
        });
        
        //chart 2 link
        d3.select("#chart2").on("click", function(d, i) {
          window.location = data2[i].link;
        });
        
        //chart 3 link
        d3.select("#chart3").on("click", function(d, i) {
          window.location = data3[i].link;
        });
        
        //chart 4 link
        d3.select("#chart4").on("click", function(d, i) {
          window.location = data4[i].link;
        });
        
        //chart 5 link
        d3.select("#chart5").on("click", function(d, i) {
          window.location = data5[i].link;
        });
        
        //chart 6 link
        d3.select("#chart6").on("click", function(d, i) {
          window.location = data6[i].link;
        });
        
        //chart 7 link
        d3.select("#chart7").on("click", function(d, i) {
          window.location = data7[i].link;
        });
        
        // Append text to the inner circle
      

        //chart 1 inner text
        d3.select("#chart1").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'notifications'; });
        
        //chart 2 inner text

        d3.select("#chart2").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'tools added'; });
        
        //chart 3 inner text

        d3.select("#chart3").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'due for re-test'; });
        
        //chart 4 inner text

        d3.select("#chart4").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'users on site'; });
        
        //chart 5 inner text

        d3.select("#chart5").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'co. tools added'; });
        
        //chart 6 inner text

        d3.select("#chart6").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'due for re-test'; });
        
        //chart 7 inner text

        d3.select("#chart7").append("text")
          .attr("dy", "10em")
          .attr("dx", "8em")
          .style("text-anchor", "middle")
          .attr("class", "inner-circle")
          .attr("fill", "#444")
          .text(function(d) { return 'job sites added'; });


        // Create the actual slices of the pie
        groups.append('path')
        .attr({
            'fill': function (d, i) {
                // console.log(d);
                return d.data.color;
            }
        })
        .transition()
        .duration(config.duration || 1000)
        .attrTween('d', tweenPie)
        .call(checkEndAll, function () {

            // Finally append the title of the text to the node
            groups.append('text')
            .attr({
                'text-anchor': 'middle',
                'transform': function (d) {
                    return 'translate(' + arc.centroid(d) + ')';
                }
            })
            .text(function (d) {
                // Notice the usage of d.data to access the raw data item
                return d.data.dept;
            });
        });
    }

    // Render the initial ring

    // notifications chart

    $.get("countnotifications",function(res){
      console.log(res);

      data1[0].count = res;
      drawAnimatedRingChart({
          el: '.box-area svg#chart1',
          outerRadius: outerRadius,
          innerRadius: outerRadius - ringWidth,
          data: data1
      });

      d3.select("#chart1").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#1fb890")
          .text(function(d) { return res; });

    });

    // tools added chart

    $.get("countpersonaltools",function(res){
      console.log(res);

      data2[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart2',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data2
      });

      d3.select("#chart2").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#1fb890")
          .text(function(d) { return res; });

    });

    // tools due chart

    $.get("countduepersonaltools",function(res){
      console.log(res);

      data3[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart3',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data3
      });

      d3.select("#chart3").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#eb5757")
          .text(function(d) { return res; });

    });

     // users on site chart

    $.get("countusers",function(res){
      console.log(res);

      data4[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart4',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data4
      });

      d3.select("#chart4").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#1fb890")
          .text(function(d) { return res; });

    });

    // co tools added chart

    $.get("countcompanytools",function(res){
      console.log(res);

      data5[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart5',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data5
      });

      d3.select("#chart5").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#1fb890")
          .text(function(d) { return res; });

    });

    // co tools due chart

    $.get("countduecompanytools",function(res){
      console.log(res);

      data6[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart6',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data6
      });

      d3.select("#chart6").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#eb5757")
          .text(function(d) { return res; });

    });

    // sites chart

    $.get("countsites",function(res){
      console.log(res);

      data7[0].count = res;

      drawAnimatedRingChart({
        el: '.box-area svg#chart7',
        outerRadius: outerRadius,
        innerRadius: outerRadius - ringWidth,
        data: data7
      });

      d3.select("#chart7").append("text")
          .attr("dy", "3.5em")
          .attr("dx", "2.5em")
          .style("text-anchor", "middle")
          .attr("class", "number-inner-circle")
          .attr("fill", "#1fb890")
          .text(function(d) { return res; });

    });

   

  


     //-------------- auto complete ------------------------------

    // tool names

var rooturl = $("#rooturl").text();

      $.get(rooturl+"/toolnames",function(res){

        var availableTags = res;

        $( ".toolname" ).autocomplete({
          source: availableTags
        });

      });

    // tech names

      $.get(rooturl+"/technames",function(res){

        var availableTags = res;

        $( ".techname" ).autocomplete({
          source: availableTags
        });

      });

    // tech companies

      $.get(rooturl+"/techcompanies",function(res){

        var availableTags = res;

        $( ".techcompany" ).autocomplete({
          source: availableTags
        });

      });

      // tech numbers

      $.get(rooturl+"/technumbers",function(res){

        var availableTags = res;

        $( ".technumber" ).autocomplete({
          source: availableTags
        });

      });
    
}); // end of script
    