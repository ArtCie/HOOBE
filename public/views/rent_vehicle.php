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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <title>Rent Vehicle</title>
  <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
  <script src="public/js/validRentalDetails.js"></script>
</head>
<body>
<div class="main">
  <nav>
    <ul>
      <li>
        <img alt="logo" src="public/img/logo.svg">
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
            <a href="#">Bolt</a>
            <a href="#">Lime</a>
            <a href="#">Tier</a>
            <a href="#">Panek</a>
            <a href="#">Private Vehicles</a>
          </div>
        </div>
      </li>
      <li>
        <a href="#" class="dropbtn">
          <i class="fas fa-percent"></i>
          Discounts
        </a>
      </li>
      <li>
        <a href="#" class="dropbtn">
          <i class="fas fa-car"></i>
          Rent your vehicle
        </a>
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
          <input id="first_name" class="input" name="first_name" placeholder="Enter first name" type="text">
        </li>
        <li>
          <div class="text">Last Name</div>
          <input id="last_name" class="input" name="last_name" placeholder="Enter last name" type="text">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">Address</div>
                    <input id="address" class="input double-row" name="address" placeholder="Enter address" type="text">
                </div>
                <div class="double-row">
                    <div class="text left">Address Number</div>
                    <input id="address_number" class="input double-row" name="address_number" placeholder="Enter address number" type="text">
                </div>
            </div>
        </li>
        <li>
          <div class="text">Country</div>
          <input id="country" class="input" name="country" placeholder="Choose country" type="text">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">City</div>
                    <input id="city" class="input double-row" name="city" placeholder="Enter city" type="text">
                </div>
                <div class="double-row">
                    <div class="text left">Postal Code</div>
                    <input id="postal_code" class="input double-row" name="postal_code" placeholder="  -   " type="text">
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
          <input id="vehicle_type" class="input" name="vehicle_type" placeholder="Choose vehicle type" type="text">
        </li>
        <li class="extend-width">
            <div class="address">
                <div class="double-row">
                    <div class="text left">Vehicle name</div>
                    <input id="vehicle_name" class="input double-row" name="vehicle_name" placeholder="Enter full vehicle name" type="text">
                </div>
                <div class="double-row">
                    <div class="text left">Production year</div>
                    <input id="production_year" class="input double-row" name="production_year" placeholder="Choose year" type="text">
                </div>
            </div>
        </li>
        <li>
          <div class="text">Last Technical Review Date</div>
            <input id="last_technical_review_date" class="input" name="last_technical_review_date" placeholder="Choose date" type="date">
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
              <input id="rent_from" class="input" name="rent_from" placeholder="Choose rental period" type="date">
          </li>
        <li>
          <div class="text">Rental Until</div>
          <input id="rent_to" class="input" name="rental_until" placeholder="Choose rental period" type="date">
        </li>
        <li>
          <div class="text">Price</div>
          <input id="price" class="input" name="price" placeholder="Enter price" type="text">
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
<!--            <button onclick="validRentalDetails()">Add vehicle</button>-->
              <button type="submit">Add vehicle</button>
          </div>
          </div>
        </li>
      </ul>
    </div>

  </div>
    </form>

  <nav id="bottom-default">
    <ul>
      <li>
        <a class="line" href="#" >
                  <span class="material-icons">
                        settings
                    </span>
          Settings
        </a>
      </li>

      <li>
        <a class="line" href="#">
                <span class="material-icons">
                        logout
                </span>
          Log out
        </a>
      </li>
    </ul>
  </nav>
</div>
</body>
</html>