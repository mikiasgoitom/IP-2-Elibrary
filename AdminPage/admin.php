<?php
session_start();
require '../dbConfig/dbConfig.php';

$adminName = htmlspecialchars($_SESSION['name']) ?? 'Unknown';

// dashboad data from db
$result = $conn->query("SELECT COUNT(*) AS count FROM visitors");
$totalVisitor = $result ? $result->fetch_assoc()['count'] : 0;

$result = $conn->query("SELECT COUNT(*) AS count FROM visitors WHERE role = 'student'");
$students = $result ? $result->fetch_assoc()['count'] : 0;

$result = $conn->query("SELECT COUNT(*) AS count FROM visitors WHERE role = 'faculty'");
$faculty = $result ? $result->fetch_assoc()['count'] : 0;

$result = $conn->query("SELECT COUNT(*) AS count FROM books");
$eBook = $result ? $result->fetch_assoc()['count'] : 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Page</title>
  <link rel="stylesheet" href="CSS/admin.css" />
  <link rel="icon" href="images/AASTU Logo 2_title.jpg" type="image/x-icon">
  <!--Icons Collection-->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <!-- Google fonts  -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet" />
</head>

<body>
  <!--Header of the page-->

  <header>
    <div class="header-div">
      <input type="checkbox" id="menu-toggle" class="hidden-checkbox" />
      <label for="menu-toggle" class="menu-toggle">
        <span class="las la-bars"></span>
      </label>
      <div class="search-contain">
        <div class="link-icons">
          <a href="/homepage/homepage.html" class="btn btn-m btn-outline-log-out">Logout</a>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <!--Sidebar Section-->
    <aside>
      <div class="sidebar">
        <div class="sidemenu">
          <div class="side-user">
            <div class="user-role">
              <p><?php echo $adminName ?></p>
            </div>
          </div>
          <ul>
            <!-- <li>
              <a href="admin.html">
                <span class="las la-home"></span>
                <span>Dashboard</span>
              </a>
            </li> -->

            <li>
              <a href="feedbacks.html" target="_blank">
                <span class="la la-envelope"></span>
                <span>Feedbacks</span>
              </a>
            </li>
            <li>
              <a href="upload.html" target="_blank">
                <span class="las la-cloud-upload-alt"></span>
                <span>Upload</span>
              </a>
            </li>
            <li>
              <a href="admin_registeration.php">
                <span class="las la-user"></span>
                <span>Add users</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </aside>

    <!-- main body  -->

    <div class="main-content">
      <!-- The main body part of the page -->
      <main>
        <!-- data summery  -->

        <section>
          <div class="cards">
            <div class="card">
              <div class="card-icon follow">
                <span class="las la-users"></span>
              </div>
              <div class="card-info">
                <h2><?php echo "$totalVisitor"?></h2>
                <small>Total Visitors</small>
              </div>
            </div>
            <div class="card">
              <div class="card-icon Students">
                <span class="las la-user-graduate"></span>
              </div>
              <div class="card-info">
                <h2><?php echo "$students"?></h2>
                <small>Students</small>
              </div>
            </div>
            <div class="card">
              <div class="card-icon Teachers">
                <span class="las la-chalkboard-teacher"></span>
              </div>
              <div class="card-info">
                <h2><?php echo "$faculty"?></h2>
                <small>Faculty</small>
              </div>
            </div>
            <!--<div class="card">
                <div class="card-icon groups">
                  <span class="las la-comments"></span>
                </div>
                 <div class="card-info">
                  <h2>200</h2>
                  <small>Discussion Groups</small>
                </div> -->
          </div>
          <div class="card">
            <div class="card-icon books">
              <span class="las la-book"></span>
            </div>
            <div class="card-info">
              <h2><?php echo "$eBook"?></h2>
              <small>E-book</small>
            </div>
          </div>

    </div>
    </section>
    <!--User Feedback-->
    <!-- <div class="feedback-list">
            <h3>Feedback from Users</h3>
            <table class="feedback-table">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Comment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>User 1</td>
                  <td>Great website!</td>
                </tr>
                <tr>
                  <td>User 2</td>
                  <td>Awesome features!</td>
                </tr>
              </tbody>
            </table>
          </div> 
          <div class="upload-box">
            
            <a href="upload.html" class="custom-file-upload">
              <span class="las la-cloud-upload-alt"></span>Upload
            </a>
          </div>-->
    </main>
  </div>
  </div>

  <!-- footer  -->

  <footer>
    <div class="footer-bottom">
      <div class="copyright">
        <p>&copy;2024 AASTU | Developed Software Savants&trade;</p>
      </div>
    </div>
  </footer>

  <!-- javascrip is here  -->

  <script src="app.js"></script>
</body>

</html>