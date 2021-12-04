<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/email.css">
    <link rel="stylesheet" type="text/css" href="public/css/main_page.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>HOOBE</title>
    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="public/js/initFile.js"></script>
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
    <div id="map"></div>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoR-bTNSckAUS-EwelCX0p5_vLaQC3jsg&map_ids=f5a8682e636f2b1d&callback=initMap"
            async
    ></script>
  <nav class="bottom">
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