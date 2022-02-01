<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="public/css/email.css">
  <link rel="stylesheet" type="text/css" href="public/css/main_page.css">
  <link rel="stylesheet" type="text/css" href="public/css/discounts.css">
  <link rel="stylesheet" type="text/css" href="public/css/rent.css">
    <link rel="stylesheet" type="text/css" href="public/css/toggle.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <title>Rent Vehicle</title>
  <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
  <script src="public/js/validRentalDetails.js"></script>
    <script src="public/js/logout.js"></script>
</head>
<body>
<div class="main">
  <nav>
    <ul>
        <li>
            <form action="main_page" method="GET">
                <button type="submit">
                    <img alt="logo" src="public/img/logo.svg">
                </button>
            </form>
        </li>
      <li>
          <div class="dropdown">
              <a href="#" class="dropbtn">
                  <i class="fas fa-filter "></i>
                  Filter
                  <span class="i material-icons">
                            expand_more
                      </span>
              </a>
              <div class="dropdown-content">
                  <div class="toggle_text">
                      Bolt
                      <input type="checkbox" id="bolt_box" onclick="put_filters(); "/>
                      <div>
                          <label class="bolt_height" for="bolt_box"></label>
                      </div>
                  </div>
                  <div class="toggle_text">
                      Lime
                      <input type="checkbox" id="lime_box" onclick="put_filters()"/>
                      <div>
                          <label class="lime_height" for="lime_box"></label>
                      </div>
                  </div>
                  <div class="toggle_text">
                      Tier
                      <input type="checkbox" id="tier_box" onclick="put_filters()"/>
                      <div>
                          <label class="tier_height" for="tier_box"></label>
                      </div>
                  </div>
                  <div class="toggle_text">
                      Private vehicles
                      <input type="checkbox" id="private_vehicles_box" onclick="put_filters()"/>
                      <div>
                          <label class="private_vehicles_height" for="private_vehicles_box"></label>
                      </div>
                  </div>
              </div>
              <script type="text/javascript" async>
                  load_filters()
              </script>
          </div>
      </li>
        <li>
            <form action="discounts" method="POST">
                <button href="#" class="dropbtn">
                    <i class="fas fa-percent"></i>
                    Discounts
                </button>
            </form>
        </li>
        <li>
            <form class="login-container" action="rent_vehicle" method="GET">
                <button type="submit" class="dropbtn">
                    <i class="fas fa-car"></i>
                    Rent your vehicle
                </button>
            </form>
        </li>
    </ul>
  </nav>
  <div class="map-wrapper">
  </div>
    <form action="save_vehicle" method="POST" ENCTYPE="multipart/form-data">
  <div class="rent-car-details">
    <div class="renting_details">
      <div class="header">Renting Details</div>
        <div class="errors"><pre></pre></div>
      <ul>
        <li>
          <div class="text">First Name</div>
          <input id="first_name" class="input" name="first_name" placeholder="Enter first name" type="text" value="<?php  {
              if (!empty($_GET["first_name"])) {
                  echo $_GET["first_name"];
              }
          } ?>">
        </li>
        <li>
          <div class="text">Last Name</div>
          <input id="last_name" class="input" name="last_name" placeholder="Enter last name" type="text" value="<?php if (!empty($_GET["last_name"])) {
              echo $_GET["last_name"];
          } ?>">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">Address</div>
                    <input id="address" class="input double-row" name="address" placeholder="Enter address" type="text" value="<?php if (!empty($_GET["street_name"])) {
                        echo $_GET["street_name"];
                    } ?>">
                </div>
                <div class="double-row">
                    <div class="text left">Address Number</div>
                    <input id="address_number" class="input double-row" name="address_number" placeholder="Enter address number" type="text" value="<?php if (!empty($_GET["address_number"])) {
                        echo $_GET["address_number"];
                    } ?>">
                </div>
            </div>
        </li>
        <li>
          <div class="text">Country</div>
          <input id="country" class="input" name="country" placeholder="Choose country" type="text" value="<?php if (!empty($_GET["country_name"])) {
              echo $_GET["country_name"];
          } ?>">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">City</div>
                    <input id="city" class="input double-row" name="city" placeholder="Enter city" type="text" value="<?php if (!empty($_GET["city_name"])) {
                        echo $_GET["city_name"];
                    } ?>">
                </div>
                <div class="double-row">
                    <div class="text left">Postal Code</div>
                    <input id="postal_code" class="input double-row" name="postal_code" placeholder="  -   " type="text" value="<?php if (!empty($_GET["postal_code"])) {
                        echo $_GET["postal_code"];
                    } ?>">
                </div>
            </div>
        </li>
      </ul>
    </div>
    <div class="vehicle_details">
      <div class="header">Vehicle Details</div>
        <div class="errors-vehicle"><pre></pre></div>
      <ul>
        <li>
          <div class="text">Vehicle type</div>
          <input id="vehicle_type" class="input" name="vehicle_type" placeholder="Choose vehicle type" type="text" value="<?php if (!empty($_GET["vehicle_name"])) {
              echo str_replace("'", "", $_GET["vehicle_type"]);
          } ?>">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">Vehicle name</div>
                    <input id="vehicle_name" class="input double-row" name="vehicle_name" placeholder="Enter full vehicle name" type="text" value="<?php if (!empty($_GET["vehicle_name"])) {
                        echo str_replace("'", "", $_GET["vehicle_name"]);
                    } ?>">
                </div>
                <div class="double-row">
                    <div class="text left">Production year</div>
                    <input id="production_year" class="input double-row" name="production_year" placeholder="Choose year" type="text" value="<?php if (!empty($_GET["production_year"])) {
                        echo str_replace("'", "", $_GET["production_year"]);
                    } ?>">
                </div>
            </div>
        </li>
        <li>
          <div class="text">Last Technical Review Date</div>
            <input id="last_technical_review_date" class="input" name="last_technical_review_date" placeholder="Choose date" type="date" value="<?php if (!empty($_GET["last_technical_review_date"])) {
                echo str_replace("'", "", $_GET["last_technical_review_date"]);
            } ?>">
        </li>
        <li id="upload">
          <div id="seperate_id">
            <div class="text">Vehicle photos</div>
            <div class="text">Upload series of photos</div>
            <input type="file" name="file[]" multiple="multiple"/>
          </div>
        </li>
      </ul>
    </div>
    <div class="rental_details">
        <div class="errors-rental-details"><pre></pre></div>
      <div class="header">Rental Details</div>
      <ul>
          <li>
              <div class="text">Rent From</div>
              <input id="rent_from" class="input" name="rent_from" placeholder="Choose rental period" type="date" value="<?php if (!empty($_GET["rent_from"])) {
                  echo str_replace("'", "", $_GET["rent_from"]);
              } ?>">
          </li>
        <li>
          <div class="text">Rental Until</div>
          <input id="rent_to" class="input" name="rent_to" placeholder="Choose rental period" type="date" value="<?php if (!empty($_GET["rent_to"])) {
              echo str_replace("'", "", $_GET["rent_to"]);
          } ?>">
        </li>
        <li>
          <div class="text">Price</div>
          <input id="price" class="input" name="price" placeholder="Enter price" type="text" value="<?php if (!empty($_GET["price"])) {
              echo str_replace("'", "", $_GET["price"]);
          } ?>">
        </li>
        <li>
          <div class="text">Is negotiable?</div>
          <label class="label">
            <div class="toggle">
              <input id = "is_negotiable" class="toggle-state" type="checkbox" name="is_negotiable" value="check" />
              <div class="indicator"></div>
            </div>
          </label>
        </li>
        <li>
          <div class="add-vehicle">
          <div class="button button-6">
            <div class="spin"></div>
              <button type="submit">Add vehicle</button>
          </div>
          </div>
        </li>
      </ul>
    </div>

  </div>
        <input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php if (!empty($_GET["vehicle_id"])) {
            echo str_replace("'", "", $_GET["vehicle_id"]);
        } ?>">
    </form>

  <nav id="bottom-default">
    <ul>
        <li>
            <form action="settings" method="GET">
                <button class="line">
                      <span class="material-icons">
                            settings
                        </span>
                    Settings
                </button>
            </form>
        </li>

        <li>
            <button class="line" onclick="logout()">
                <span class="material-icons">
                        logout
                </span>
                Log out
            </button>
        </li>
    </ul>
  </nav>
</div>
</body>
</html>