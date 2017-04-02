<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Ander's Kitchen | Owner's Portal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/foundation.css" /> <!--foundation styles-->
        <link rel="stylesheet" href="css/ownerPortal.css" />

        <?php
        $cookie_name = "token";
        ?>
    </head>

    <body>
        <div class="hero row collapse">
            <div class="menu-bar medium-2 columns">
                <h3 style="color: white;">Ander's Kitchen</h3>
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
                    <li class="tabs-title"><a href="#panel0v"><img src="https://placehold.it/50x50">My Profile</a></li>
                    <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Dashboard</a></li>
                    <li class="tabs-title"><a href="#panel2v">Daily Orders</a></li>
                    <li class="tabs-title"><a href="#panel3v">Recipe Book</a></li>
                    <li class="tabs-title"><a href="#panel4v">Customers</a></li>
                    <li class="tabs-title"><a href="#panel5v">Finance Tracking</a></li>
                    <li class="tabs-title"><a href="#panel6v">Settings</a></li>
                </ul>
            </div>
            <div class="medium-10 columns">
                <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                    <div class="tabs-panel MyProfile" id="panel0v">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="tabs-panel is-active Summary" id="panel1v">
                        <div class="row">
                            <div class="medium-12 columns">
                                <h3>Flash Briefing</h3>
                                <div class="row small-up-2 medium-up-3">
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-section">
                                                <center><h4>Number of orders to prepare today:</h4></center>
                                                <center><h1>30</h1></center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-section">
                                                <center><h4>Dish of the day:</h4></center>
                                                <center><h1>Lasagna</h1></center>
                                                <center><a class="button large" href="#">See the recipe</a></center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-section">
                                                <h4>Customer birthdays (next 2 weeks):</h4>
                                                <p>Bill Brown <a class="button small" href="#">See their profile</a></p>
                                                <p>Dona Thomas <a class="button small" href="#">See their profile</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-section">
                                                <h4>This is a card.</h4>
                                                <p>It has an easy to override visual style, and is appropriately subdued.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="medium-12 columns">
                                <h3>Weekly Plan</h3>
                                <h4>Meals</h4>
                                <div class="row full">
                                    <div class="medium-2 column"><h4>Monday</h4></div>
                                    <div class="medium-2 column"><h4>Tuesday</h4></div>
                                    <div class="medium-2 column"><h4>Wednesday</h4></div>
                                    <div class="medium-2 column"><h4>Thursday</h4></div>
                                    <div class="medium-2 column"><h4>Friday</h4></div>
                                    <div class="medium-2 column"></div>
                                </div>
                                <div class="row full">
                                    <div class="medium-2 column"><h4>Lasagna</h4></div>
                                    <div class="medium-2 column"><h4>Another dish</h4></div>
                                    <div class="medium-2 column"><h4>Another dish</h4></div>
                                    <div class="medium-2 column"><h4>Another dish</h4></div>
                                    <div class="medium-2 column"><h4>Another dish</h4></div>
                                    <div class="medium-2 column"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="medium-12 columns">
                                <h3>Finance briefing</h3>
                                <h4>Daily Progress</h4>
                                <div class="row full">
                                    <h4>You have sold 30 meals today! That's a <span style="color:green">50%</span> increase from your typical Mondays!
                                </div>
                                <h4>Last Week's Progress</h4>
                                <div class="row full">
                                    <h4>You have sold 200 meals last week! That's a <span style="color:green">10%</span> increase from your weekly average!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-panel DailyOrders" id="panel2v">
                        <div class="row full DailyOrdersSheet">
                            <div class="medium-2 column">Name</div>
                            <div class="medium-4 column">Address</div>
                            <div class="medium-1 column"># of orders</div>
                            <div class="medium-3 column">Delivery or Pickup</div>
                            <div class="medium-1 column">New Customer?</div>
                            <div class="medium-1 column"></div>
                        </div>
                        <div class="row full Orderentry" style="background-color: lightgrey">
                            <div class="medium-2 column">Bob Smith</div>
                            <div class="medium-4 column">123 North Main street</div>
                            <div class="medium-1 column">4</div>
                            <div class="medium-3 column">Pickup</div>
                            <div class="medium-1 column">YES!</div>
                            <div class="medium-1 column"></div>
                        </div>
                        <div class="row full OrderEntry">
                            <div class="medium-2 column">Tony Williams</div>
                            <div class="medium-4 column">456 Green Street</div>
                            <div class="medium-1 column">5</div>
                            <div class="medium-3 column">Delivery</div>
                            <div class="medium-1 column"></div>
                            <div class="medium-1 column"></div>
                        </div>
                    </div>
                    <div class="tabs-panel RecipeBook" id="panel3v">
                        <div class="top-bar RecipeTopBar">
                            <div class="top-bar-left">
                                <ul class="dropdown menu" data-dropdown-menu>
                                    <li>
                                        <a href="#">Quick Filter</a>
                                        <ul class="menu vertical">
                                            <li><a href="#">Vegan</a></li>
                                            <li><a href="#">Vegetarian</a></li>
                                            <li><a href="#">Gluten-Free</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Add a New Recipe</a></li>
                                    <li><a href="#">View popular Items</a></li>
                                </ul>
                            </div>
                            <div class="top-bar-right">
                                <ul class="menu">
                                    <li><input type="search" placeholder="Search"></li>
                                    <li><button type="button" class="button">Search</button></li>
                                </ul>
                            </div>
                        </div>
                        <iframe style="width: 100%; height:700px;" src="RecipeBook.php"></iframe>
                    </div>

                    <div class="tabs-panel Customers" id="panel4v">
                        <div class="top-bar RecipeTopBar">
                            <div class="top-bar-left">
                                <ul class="dropdown menu" data-dropdown-menu>
                                    <li>
                                        <a href="#">Loyal Customers</a>
                                    </li>
                                    <li><a href="#">Who you haven't seen in a while</a></li>
                                    <li><a href="#">Approaching birthdays</a></li>
                                </ul>
                            </div>
                            <div class="top-bar-right">
                                <ul class="menu">
                                    <li><input type="search" placeholder="Search"></li>
                                    <li><button type="button" class="button">Search</button></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="tabs-panel FinanceTracking" id="panel5v ">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="tabs-panel Settings" id="panel6v">
                        <img class="thumbnail" src="assets/img/generic/rectangle-5.jpg">
                    </div>
                </div>
            </div>
        </div> 
        <!--<div class="row full">
            <div class="sidebar medium-3 large-3 columns">
                <a><div class="menuSelection">test 1</div></a>
                <a><div class="menuSelection">test 2</div></a>
                <a><div class="menuSelection">test 3</div></a>
                <a><div class="menuSelection">test 4</div></a>
                <a><div class="menuSelection">test 5</div></a>
                <a><div class="menuSelection">test 6</div></a>
                <div class="middle-header"> 
                </div>
            </div>

            <div class="content medium-9 large-9 columns">

            </div>
        </div>-->
        <script type="text/javascript" src="js/vendor/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/foundation.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script> <!---My custom jscript and jquery--->
        <script type="text/javascript">
            $(document).foundation();
        </script>
    </body>
</html>
