		
$(function(){
$('#order li').click(function(){
     $(this).parent().find('li.intro').removeClass('intro');
     $(this).addClass('intro');
    });
});
// all
$(function(){
$('#all').click(function(){

//$('.ListContent').load('Allsocial.html');
$('div.tintup-holder').css({"height":"100%","width":"100%"});
$('iframe.tintup').attr('src','http://www.tintup.com/X3All?embed=true');
//$('iframe.tintup').css({"width":"100%","height":"100%"});

});
});

//twitter
$(function(){
$('#twitter').click(function(){
//$('iframe.tintup').attr('src','http://www.tintup.com/X3Twitter?embed=true');
$('iframe.tintup').attr('src','http://www.tintup.com/X3Twitter?embed=true');
});
});
//Facebook
$(function(){
$('#facebook').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3Facebook?embed=true');
});
});
//Youtube
$(function(){
$('#youtube').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3YouTube?embed=true');
});
});
//Blog
$(function(){
$('#blog').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3Blog?embed=true');
});
});
//SAP
$(function(){
$('#sap').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3CompSAPTwitter?embed=true');
});
});
//Microsoft Dynamics
$(function(){
$('#dynamics').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3CompMDAll?embed=true');
});
});
//NetSuite
$(function(){
$('#netsuite').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3CompNSAll?embed=true');
});
});
//Infor
$(function(){
$('#infor').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3CompINAll?embed=true');
});
});
//#ERP
$(function(){
$('#erp').click(function(){
$('iframe.tintup').attr('src','http://www.tintup.com/X3ERPhash?embed=true');
});
});