<?php

include('lock.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cycle Profix billing</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <script>
    window.onload = showHide;

    function showHide(){
        document.getElementById("price").className="hidden";
        document.getElementById("costList").className="hidden";
        document.getElementById("priceList").className="hidden";
    }

    function ShowCost(){
        document.getElementById("cost").className="visible";
        document.getElementById("price").className="hidden";
        document.getElementById("costList").className="hidden";
        document.getElementById("priceList").className="hidden";
    };

    function ShowPrice(){
        document.getElementById("cost").className="hidden";
        document.getElementById("price").className="visible";
        document.getElementById("costList").className="hidden";
    };

    function ShowCostList(){
        document.getElementById("cost").className="hidden";
        document.getElementById("price").className="hidden";
        document.getElementById("priceList").className="hidden";
        document.getElementById("costList").className="visible";
    };

    function ShowPriceList(){
        document.getElementById("cost").className="hidden";
        document.getElementById("price").className="hidden";
        document.getElementById("costList").className="hidden";
        document.getElementById("priceList").className="visible";
    };

    </script>


</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Profix
                    </a>
                </li>
                <li>
                    <span title="Add or create new cost entry for a contractor">
                    <a href="#cost" onclick="ShowCost()">Add Contractor Cost</a>
                    </span>
                </li>
                <li>
                    <span title="To get the list of costs associated to a contractor">
                    <a href="cost_list.php">Contractor Cost Listing</a>
                    </span>
                </li>
                <li>
                    <span title="Add or create new price entry for a costumer">
                    <a href="#price" onclick="ShowPrice()">Add Customer Price</a>
                    </span>
                </li>
                <li>
                    <span title="To get the list of prices associated to a costumer ">
                    <a href="price_list.php">Customer Price Listing</a>
                    </span>
                </li>
                <li>
                    <a href="logout.php">Sign out</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="cost"><?php require("cost.php"); ?></div>
                        <div id="costList"><?php require("cost_list.php"); ?></div>
                        <div id="price"><?php require("price.php"); ?></div>
                        <div id="priceList"><?php require("price_list.php"); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
