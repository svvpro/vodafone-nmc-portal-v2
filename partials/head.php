<!DOCTYPE html >
<html lang="ru" ng-app="alarm">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>NMC Portal</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="bower_components/angular-ui-bootstrap-datetimepicker/datetimepicker.css">
    <link rel="stylesheet" href="bower_components/oi.select/dist/select.min.css">

   <!--    TextAngulal-->
    <link rel='stylesheet' href='bower_components/textAngular/dist/textAngular.css'>

    <!--    Font-Awesome-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

    <!--    My css style file-->
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/demo.css" />
    <link rel="stylesheet" href="css/component.css" />


    <script src="js/lib/jspdf.min.js"></script>
    <script src="js/lib/html2canvas.js"></script>

    <script>
        function genPdf() {
//            html2canvas(document.getElementById("mark"), {
//                onrendered: function (canvas) {
//                    var img = canvas.toDataURL("image/png");
//                    var doc = new jsPDF();
//                    doc.addImage(img, 'JPEG', 20, 20);
//                    doc.save("text.pdf");
//                }
//            });
            var doc = new jsPDF();
            doc.fromHTML($('#mark').get(0), 20, 20,{ width: 1000});
            doc.save("text.pdf")
        }
    </script>

    <script src="js/lib/modernizr.custom.js"></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/angular-animate/angular-animate.js"></script>
    <!--    Export tp Excel-->
    <script src="js/lib/FileSaver.js" type="text/javascript"></script>

</head>
<body ng-controller="BaseCtrl" ng-cloak>
<div class="container">


