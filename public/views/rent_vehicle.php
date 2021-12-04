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
  <div class="rent-car-details">
    <div class="renting_details">
      <div class="header">Renting Details</div>
      <ul>
        <li>
          <div class="text">Full Name</div>
          <input class="input" name="full_name" placeholder="Enter full name" type="text">
        </li>
        <li>
          <div class="text">Address</div>
          <input class="input" name="address" placeholder="Enter address" type="text">
        </li>
        <li>
          <div class="text">Country</div>
          <input class="input" name="country" placeholder="Choose country" type="text">
        </li>
        <li>
          <div class="text">City</div>
          <input class="input" name="city" placeholder="Enter city" type="text">
        </li>
      </ul>
    </div>
    <div class="vehicle_details">
      <div class="header">Vehicle Details</div>
      <ul>
        <li>
          <div class="text">Vehicle type</div>
          <input class="input" name="vehicle_type" placeholder="Choose vehicle type" type="text">
        </li>
        <li>
          <div class="text">Vehicle name</div>
          <input class="input" name="vehicle_name" placeholder="Enter full vehicle name" type="text">
        </li>
        <li>
          <div class="text">Production year</div>
          <input class="input" name="production_year" placeholder="Choose year of production" type="text">
        </li>
        <li id="upload">
          <div id="seperate_id">
            <div class="text">Vehicle photos</div>
            <div class="text">Upload series of photos</div>
          </div>
          <div class="button button-6">
            <div class="spin"></div>
            <a href="#">Upload</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="rental_details">
      <div class="header">Rental Details</div>
      <ul>
        <li>
          <div class="text">Rental Period</div>
          <input class="input" name="rental_period" placeholder="Choose rental period" type="date">
        </li>
        <li>
          <div class="text">Price</div>
          <input class="input" name="price" placeholder="Enter price" type="text">
        </li>
        <li>
          <div class="text">Is negotiable?</div>
          <label class="label">
            <div class="toggle">
              <input class="toggle-state" type="checkbox" name="check" value="check" />
              <div class="indicator"></div>
            </div>
          </label>
        </li>
        <li>
          <div class="add-vehicle">
          <div class="button button-6">
            <div class="spin"></div>
            <a href="#">Add vehicle</a>
          </div>
          </div>
        </li>
      </ul>
    </div>

  </div>


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