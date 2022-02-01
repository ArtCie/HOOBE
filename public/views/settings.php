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
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <title>Settings</title>
  <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script src="public/js/setSettingValues.js"></script>
    <script src="public/js/vehicleSettingsManager.js"></script>
    <script src="public/js/logout.js"></script>
</head>
<body>
<script type="text/javascript">
    initSettings();
</script>
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
    <form action="update_settings" method="POST">
  <div class="rent-car-details">
    <div class="edit-vehicles-details">
      <div class="header">Vehicles</div>
      <ul>
        <li><div class="text">Edit vehicles</div></li>
          <?php if (isset($vehicles)) {
              foreach ($vehicles as $vehicle): ?>
                  <li>
                      <div class="edit_vehicles" id='<?php echo "vehicle" . $vehicle["id"];?>'>
                          <?php echo $vehicle["name"];?>
                          <div>
                              <button onclick="editVehicle('<?php echo $vehicle["id"];?>')" class="material-icons-outlined">
                                  edit_note
                              </button>
                              <button onclick="removeVehicle('<?php echo $vehicle["id"];?>')" class="material-icons-outlined thrash">
                                  delete
                              </button>
                          </div>
                      </div>
                  </li>
              <?php   endforeach;} ?>
        <li>
          <div class="add-vehicle">
            <div class="button button-6">
              <div class="spin"></div>
              <button type="submit">Save changes</button>
            </div>
          </div>
         </li>
      </ul>
    </div>
    <div class="vehicle_details">
      <div class="header">User</div>
      <ul>
        <li>
          <div class="text">Email address</div>
          <input class="input" name="email_address" placeholder="youremail@gmail.com" type="text">
        </li>
        <li>
          <div class="text">Date of birth</div>

            <input type="text" class="input" name="birthday" placeholder="MM/DD/YYYY"
                   onfocus="(this.type='date')"
                   onblur="(this.type='text')">
        </li>
        <li>
          <div class="text">Password</div>
          <input class="input" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" type="password">
        </li>
      </ul>
    </div>
  </div>
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