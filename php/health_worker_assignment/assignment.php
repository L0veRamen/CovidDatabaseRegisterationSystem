<!DOCTYPE html>
<html lang="en">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . "/html/head.html") ?>
</head>

<body>
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Public Health Worker Assignment</h2>
            <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New
              Assignment</a>
          </div>
          <?php
          // Include config file
          require_once "../config.php";
          $link = connect();
          // Attempt select query execution
          $sql = "SELECT assignment_id, person.person_id, first_name, last_name, facility_name, start_date, end_date, role, vaccine_name, dose_given, lot 
                  FROM healthcare_worker_assignment 
                  INNER JOIN person ON healthcare_worker_assignment.person_id = person.person_id
                  ORDER BY person_id ASC";
          if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
              echo '<table class="table table-bordered table-striped">';
              echo "<thead>";
              echo "<tr>";
              echo "<th>Person ID</th>";
              echo "<th>First Name</th>";
              echo "<th>Last Name</th>";
              echo "<th>Facility Name</th>";
              echo "<th>Start Date</th>";
              echo "<th>End Date</th>";
              echo "<th>Role</th>";
              echo "<th>Vaccine Name</th>";
              echo "<th>Dose Given</th>";
              echo "<th>Lot</th>";
              echo "<th>Action</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['person_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['facility_name'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>" . $row['vaccine_name'] . "</td>";
                echo "<td>" . $row['dose_given'] . "</td>";
                echo "<td>" . $row['lot'] . "</td>";
                echo "<td>";
                echo '<a href="read.php?assignment_id=' . $row['assignment_id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="update.php?assignment_id=' . $row['assignment_id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="delete.php?assignment_id=' . $row['assignment_id'] . '"class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
              // Free result set
              mysqli_free_result($result);
            } else {
              echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
          } else {
            echo "Oops! Something went wrong. Please try again later." . $link->error;
          }

          // Close connection
          mysqli_close($link);
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>