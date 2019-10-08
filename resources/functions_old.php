<?php
require_once("config.php");

function alert_message(){
  if(isset($_SESSION['message'])){
    $message = <<<DELIMETER
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-text"><strong>{$_SESSION['message']}</strong> </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

DELIMETER;
  echo $message;
  unset($_SESSION['message']);
  }
}

function update_profile() {
  if(isset($_POST['update'])) {
    $username               = escape_string($_POST['username']);
    $userpwd                = escape_string($_POST['userpwd']);
    $userno                = escape_string($_POST['userno']);
    $useremail              = escape_string($_POST['useremail']);
    $useradd                = escape_string($_POST['useradd']);

    $query = "UPDATE builders SET ";
    $query .= "username     = '{$username}' , ";
    $query .= "userpwd      = '{$userpwd}'  , ";
    $query .= "useremail    = '{$useremail}', ";
    $query .= "useradd      = '{$useradd}'  ";
    $query .= "WHERE userno='{$userno}'";
    
    $send_update_query = query($query);
    confirm($send_update_query);
    set_message("Profile Updated");
    // redirect("index.php?profile");
    echo "<script> window.location.assign('index.php?profile'); </script>";
    
  }    
}

function get_cities_in_state($state){
  $json = file_get_contents(JSON . '/cities.json');
  $cities = json_decode($json, true);
  $listCities=array();

  foreach ($cities["city"] as $key => $value) {
    // Use $field and $value here
    if($value['state'] == $state){
      //if already echo'd continue to next iteration
      if (in_array($value['name'], $listCities)) {
          continue;
      }
      //else, add image to array and echo.
      $listCities[] = $value['name'];
      // $city = $city + $value['name'] + ",";
    }
    }
  return json_encode($listCities);
}

function get_states_in_admin(){
    $query = query("SELECT * FROM states ORDER BY state");
    confirm($query);
    
    while($row = fetch_array($query)) {
        $city = <<<DELIMETER

        <tr>
        <td>
          <div class="avatar-group">
            <a id="openEditCityModal" data-state="{$row['state']}" class="avatar avatar-sm" data-original-title="Edit City" data-toggle="modal" data-target="#editCityModal">
                <i class="fas fa-pencil-alt text-orange"></i>
            </a>
            <a id="openDeleteModalState" data-sid="{$row['sid']}" class="avatar avatar-sm" data-original-title="Delete City" data-toggle="modal" data-target="#deleteModalState">
                <i class="fas fa-trash-alt text-red"></i>
            </a>
            
          </div>
        </td>
        <th scope="row">
          <div class="media align-items-center">
            <div class="media-body">
              <span class="mb-0 text-sm">{$row['state']}</span>
            </div>
          </div>
          </th>
        <td style='flex-grow: 3;'><em>
DELIMETER
                . get_cities_in_state($row['state']) . <<<DELIMETER
                </em></td>
      </tr>
DELIMETER;

echo $city;
    }
}

function get_states_in_modal(){
  $json = file_get_contents(JSON . '/cities.json');
  $cities = json_decode($json, true);
  $listCities=array();

  foreach ($cities["city"] as $key => $value) {
    // Use $field and $value here
      //if already echo'd continue to next iteration
      if (in_array($value['state'], $listCities)) {
          continue;
      }
      //else, add image to array and echo.
      $listCities[] = $value['state'];
      $city = <<<DELIMETER
      <option value="{$value['state']}">{$value['state']}</option>
DELIMETER;
  echo $city;
    }
}



function add_state(){
  if(isset($_POST['add_state'])) {
    $state  = escape_string($_POST['state']);
    
    $query = query("SELECT * FROM states WHERE state = '{$state}'");
    confirm($query);
    if(mysqli_num_rows($query) == 0){
      $query2 = query("INSERT INTO states(state,city) VALUES('{$state}', NULL)");
      confirm($query2);
      set_message("State added successfully");
    }
    else 
      set_message("State already exists!!");    
    echo "<script> window.location.assign('index.php?states'); </script>";
  }
}

function get_states_in_add_property(){
  $query = query("SELECT DISTINCT state from states ORDER BY state");
  confirm($query);

  while($row = fetch_array($query)) {
    $city = <<<DELIMETER
    <option value="{$row['state']}">{$row['state']}</option>
DELIMETER;
echo $city;
  }
}

function get_cities_in_add_supplier(){
  $json = file_get_contents(JSON . '/cities.json');
  $cities = json_decode($json, true);
  $listCities=array();

  foreach ($cities["city"] as $key => $value) {
    // Use $field and $value here
      //if already echo'd continue to next iteration
      if (in_array($value['name'], $listCities)) {
          continue;
      }
      //else, add image to array and echo.
      $listCities[] = $value['name'];
      $city = <<<DELIMETER
      <option value="{$value['name']}">{$value['name']}</option>
DELIMETER;
  echo $city;
    }
}

function add_supplier(){
  if(isset($_POST['add_supplier'])) {
    $sname    = escape_string($_POST['suppliername']);
    $smobile  = escape_string($_POST['suppliermobile']);
    $semail   = escape_string($_POST['supplieremail']);
    $scity  = escape_string($_POST['scity']);
    $posterimg_file         = escape_string($_FILES['posterimg-file']['name']);
    $image_temp_location    = $_FILES['posterimg-file']['tmp_name'];

    if(isset($_FILES['posterimg-file']['name'])){
      if(move_uploaded_file($image_temp_location  , UPLOADS . DS . $posterimg_file)){
    $posterimg_file         = escape_string($_FILES['posterimg-file']['name']);
        $query = query("INSERT INTO suppliers(sname, smobile, semail, scity, sposter) VALUES ('{$sname}','{$smobile}','{$semail}','{$scity}','{$posterimg_file}')");
        confirm($query);
      }
    }
    // if(mysqli_num_rows($query) == 0){
      set_message("Supplier added successfully");
    // }
    // else 
    //   set_message("Supplier already exists!!");    
    echo "<script> window.location.assign('index.php?suppliers'); </script>";
  }
}

function edit_supplier($supplierid){
  if(isset($_POST['edit_supplier'])) {
    $sname       = escape_string($_POST['sname']);
    $scity       = escape_string($_POST['scity']);
    $smobile     = escape_string($_POST['smobile']);
    $semail      = escape_string($_POST['semail']);
    $posterimg_file         = escape_string($_FILES['posterimg-file']['name']);
    $image_temp_location    = $_FILES['posterimg-file']['tmp_name'];

    if($_FILES['posterimg-file']['name'] != ""){
      move_uploaded_file($_FILES['posterimg-file']['tmp_name'] , UPLOADS . DS . $posterimg_file);
      $posterimg_file = escape_string($_FILES['posterimg-file']['name']);
      $query = query("UPDATE suppliers SET sname = '{$sname}', smobile = '{$smobile}',semail = '{$semail}', scity = '{$scity}', sposter = '{$posterimg_file}' WHERE supplierid = '{$supplierid}'");
    } else 
        $query = query("UPDATE suppliers SET sname = '{$sname}', smobile = '{$smobile}',semail = '{$semail}', scity = '{$scity}' WHERE supplierid = '{$supplierid}'");
      confirm($query);
      set_message("Supplier edited successfully");
  }
}

function edit_city(){
  if(isset($_POST['city1']) && $_POST['city1'] != "") {
    $city   = escape_string($_POST['city1']);
    $state  = escape_string($_POST['edit-state']);

    $json = file_get_contents(JSON . '/cities.json');
    $cities = json_decode($json, true);
    $elementCount  = count($cities["city"]);
    $newData = array(  
      'id'     =>     $elementCount+1,  
      'name'   =>     $city,  
      'state'  =>     $state  
    );  
    array_push($cities["city"], $newData);
    $final_data = json_encode($cities);
    file_put_contents(JSON . '/cities.json', $final_data);
    
    set_message("City added successfully");
    echo "<script> window.location.assign('index.php?states'); </script>";
    }
}

function get_builders_in_admin(){
  $query = query("SELECT * FROM builders");
  confirm($query);
  
  $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database

  if(isset($_GET['page'])){ //get page from URL if its there
    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers
  } else{// If the page url variable is not present force it to be number 1
    $page = 1;
  }

  $perPage = 10; // Items per page here
  $lastPage = ceil($rows / $perPage); // Get the value of the last page

  // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

  if($page < 1){ // If it is less than 1
    $page = 1; // force if to be 1
  }elseif($page > $lastPage){ // if it is greater than $lastpage
    $page = $lastPage; // force it to be $lastpage's value
  }

  $middleNumbers = ''; // Initialize this variable

  // This creates the numbers to click in between the next and back buttons
  $sub1 = $page - 1;
  $sub2 = $page - 2;
  $add1 = $page + 1;
  $add2 = $page + 2;

  if($page == 1){
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$add1.'">' .$add1. '</a></li>';
  } elseif ($page == $lastPage) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
  }elseif ($page > 2 && $page < ($lastPage -1)) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$sub2.'">' .$sub2. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$add1.'">' .$add1. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$add2.'">' .$add2. '</a></li>';
  } elseif($page > 1 && $page < $lastPage){
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page= '.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$add1.'">' .$add1. '</a></li>';
  }

  // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
  $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

  $query2 = query(" SELECT * FROM builders $limit");
  confirm($query2);

  $outputPagination = ""; // Initialize the pagination output variable

  // if($lastPage != 1){
  //    echo "Page $page of $lastPage";
  // }

  // If we are not on page one we place the back link
  if($page != 1){
      $prev  = $page - 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$prev.'"><i class="fas fa-angle-left"></i>
      <span class="sr-only">Previous</span></a></li>';
  }

  // Lets append all our links to this variable that we can use this output pagination
  $outputPagination .= $middleNumbers;

  // If we are not on the very last page we the place the next link
  if($page != $lastPage){
      $next = $page + 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?builders&page='.$next.'"><i class="fas fa-angle-right"></i>
      <span class="sr-only">Next</span></a></li>';
  }

  // Done with pagination


  while($row = fetch_array($query2)) {
    $statusColor = $row['isblocked'] ? "danger" : "success";
    $status      = $row['isblocked'] ? "Unblock" : "Block";
    $builder = <<<DELIMETER

    <tr>
    <th scope="row">
      <div class="media align-items-center">
        <div class="media-body">
          <span class="mb-0 text-sm">{$row['username']}</span>
        </div>
      </div>
    </th>
    <td>{$row['userno']}</td>
    <td>{$row['useremail']}</td>
    <td>{$row['useradd']}</td>
    <td><button type="button" class="block-status btn-sm btn-outline-{$statusColor}" data-userid="{$row['userid']}">{$status}</button></td>
    <td>
      <div class="avatar-group">
        <a href="index.php?edit_builder&userid={$row['userid']}" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Edit Builder">
            <i class="fas fa-pencil-alt text-orange"></i>
        </a>
        <a id="openDeleteModalBuilder" class="avatar avatar-sm" data-original-title="Delete Builder" data-userid={$row['userid']} data-toggle="modal" data-target="#deleteModalBuilder">
            <i class="fas fa-trash-alt text-red"></i>
        </a> 
      </div>
    </td>
    </tr>
DELIMETER;

echo $builder;
  }
  echo "</tbody></table></div><div class='card-footer py-4'><nav aria-label='...'><ul class='pagination justify-content-end mb-0'>{$outputPagination}</ul></nav></div>";        

}

function create_builder(){
  if(isset($_POST['create'])) {
    $userno     = escape_string($_POST['userno']);
    $username   = escape_string($_POST['username']);
    $userpwd    = escape_string($_POST['userpwd']);
    $useremail  = escape_string($_POST['useremail']);
    $useradd    = escape_string($_POST['useradd']);
    $isblocked  = escape_string('0');

    $query = query("INSERT INTO builders(userno,username,userpwd,useremail,useradd,isblocked) VALUES('{$userno}','{$username}','{$userpwd}','{$useremail}','{$useradd}','{$isblocked}')");
    confirm($query);
    set_message("Builder added successfully.");
    echo "<script> window.location.assign('index.php?builders'); </script>";
  }
}

function edit_builder($userid){
  if(isset($_POST['edit_builder'])) {
    $userno     = escape_string($_POST['userno']);
    $username   = escape_string($_POST['username']);
    $userpwd    = escape_string($_POST['userpwd']);
    $useremail  = escape_string($_POST['useremail']);
    $useradd    = escape_string($_POST['useradd']);
    $isblocked  = escape_string('0');

    $query = query("UPDATE builders SET userno = '{$userno}', username = '{$username}',userpwd = '{$userpwd}', useremail = '{$useremail}', useradd = '{$useradd}', isblocked = '{$isblocked}' WHERE userid = '{$userid}'");
    confirm($query);
    set_message("Builder edited successfully.");
    echo "<script> window.location.assign('index.php?builders'); </script>";
  }
}

function get_query_for_admin(){
  if(isset($_GET['pname']) || isset($_GET['builder']) || isset($_GET['city']) || isset($_GET['ptype']) || isset($_GET['proomtype'])){
    $pname     = escape_string($_GET['pname']);
    $builder   = escape_string($_GET['builder']);
    $city      = escape_string($_GET['city']);
    $ptype     = escape_string($_GET['ptype']);
    $proomtype = escape_string($_GET['proomtype']);

    if(($_GET['pname']) == '' && ($_GET['builder']) == '' && ($_GET['city']) == '' && ($_GET['ptype']) == '' && ($_GET['proomtype']) == '')
      $query = ("SELECT * FROM properties");
    else 
      if(($_GET['ptype']) != '' && ($_GET['proomtype']) != '')
        $query = ("SELECT * FROM properties WHERE pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}' UNION 
        SELECT * FROM properties WHERE ptype LIKE '%{$ptype}%' UNION 
        SELECT * FROM properties WHERE proomtype LIKE '%{$proomtype}%'");
      else if(($_GET['ptype']) == '' && ($_GET['proomtype']) != '')
        $query = ("SELECT * FROM properties WHERE pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}' UNION 
          SELECT * FROM properties WHERE proomtype LIKE '%{$proomtype}%'");
      else if(($_GET['ptype']) != '' && ($_GET['proomtype']) == '')
        $query = ("SELECT * FROM properties WHERE pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}' UNION 
          SELECT * FROM properties WHERE ptype LIKE '%{$ptype}%'");
      else
        $query = ("SELECT * FROM properties WHERE pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}'");
  } 
  else {
    $query = ("SELECT * FROM properties");
  }
  return $query;
}

function get_query_for_builder(){
  $userid    = get_user_id($_SESSION['userno']);
  if(isset($_GET['pname']) || isset($_GET['builder']) || isset($_GET['city']) || isset($_GET['ptype']) || isset($_GET['proomtype'])){
    $pname     = escape_string($_GET['pname']);
    $builder   = escape_string($_GET['builder']);
    $city      = escape_string($_GET['city']);
    $ptype     = escape_string($_GET['ptype']);
    $proomtype = escape_string($_GET['proomtype']);

    if(($_GET['pname']) == '' && ($_GET['builder']) == '' && ($_GET['city']) == '' && ($_GET['ptype']) == '' && ($_GET['proomtype']) == '')
      $query = ("SELECT * FROM properties WHERE userid = '{$userid}'");
    else 
      if(($_GET['ptype']) != '' && ($_GET['proomtype']) != '')
        $query = ("SELECT * FROM properties WHERE (pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}') AND userid = '{$userid}' UNION 
        SELECT * FROM properties WHERE ptype LIKE '%{$ptype}%' AND userid = '{$userid}' UNION 
        SELECT * FROM properties WHERE proomtype LIKE '%{$proomtype}%' AND userid = '{$userid}'");
      else if(($_GET['ptype']) == '' && ($_GET['proomtype']) != '')
        $query = ("SELECT * FROM properties WHERE (pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}') AND userid = '{$userid}' UNION 
          SELECT * FROM properties WHERE proomtype LIKE '%{$proomtype}%' AND userid = '{$userid}'");
      else if(($_GET['ptype']) != '' && ($_GET['proomtype']) == '')
        $query = ("SELECT * FROM properties WHERE (pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}') AND userid = '{$userid}' UNION 
          SELECT * FROM properties WHERE ptype LIKE '%{$ptype}%' AND userid = '{$userid}'");
      else
        $query = ("SELECT * FROM properties WHERE (pname = '{$pname}' OR username = '{$builder}' OR pcity = '{$city}') AND userid = '{$userid}'");
  } 
  else {
    $query = ("SELECT * FROM properties WHERE userid = '{$userid}'");
  }
  return $query;
}

function get_properties_in_admin(){
  $isAdmin    = get_user_id($_SESSION['userno']) == 5;  
  if($isAdmin)
    $query = get_query_for_admin();
  else
    $query = get_query_for_builder();

  confirm(query($query));  
  $rows = mysqli_num_rows(query($query)); // Get total of mumber of rows from the database
  if($rows > 0){
    if(isset($_GET['page'])){ //get page from URL if its there
      $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers
    } else{// If the page url variable is not present force it to be number 1
      $page = 1;
    }
  
    $perPage = 10; // Items per page here
    $lastPage = ceil($rows / $perPage); // Get the value of the last page
  
    // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage
  
    if($page < 1){ // If it is less than 1
      $page = 1; // force if to be 1
    }elseif($page > $lastPage){ // if it is greater than $lastpage
      $page = $lastPage; // force it to be $lastpage's value
    }
  
    $middleNumbers = ''; // Initialize this variable
  
    // This creates the numbers to click in between the next and back buttons
    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;
  
    if($page == 1){
        $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$add1.'">' .$add1. '</a></li>';
    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
    }elseif ($page > 2 && $page < ($lastPage -1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$sub2.'">' .$sub2. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$add1.'">' .$add1. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$add2.'">' .$add2. '</a></li>';
    } elseif($page > 1 && $page < $lastPage){
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page= '.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$add1.'">' .$add1. '</a></li>';
    }
  
    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
    $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;
    $query2 = query(" ". $query ." ". $limit." ");
    confirm($query2);
  
    $outputPagination = ""; // Initialize the pagination output variable
  
    // if($lastPage != 1){
    //    echo "Page $page of $lastPage";
    // }
  
    // If we are not on page one we place the back link
    if($page != 1){
        $prev  = $page - 1;
        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$prev.'"><i class="fas fa-angle-left"></i>
        <span class="sr-only">Previous</span></a></li>';
    }
  
    // Lets append all our links to this variable that we can use this output pagination
    $outputPagination .= $middleNumbers;
  
    // If we are not on the very last page we the place the next link
    if($page != $lastPage){
        $next = $page + 1;
        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?properties&page='.$next.'"><i class="fas fa-angle-right"></i>
        <span class="sr-only">Next</span></a></li>';
    }
  
    // Done with pagination
  
  
    while($row = fetch_array($query2)) {
      // $companyname = show_company_name($row['username']);
    $user_name = show_company_name($row['userid']);
      $statusColor = $row['isActive'] ? "success" : "danger";
      $status      = $row['isActive'] ? "Active" : "Not Active";
      $classname   = $isAdmin ? 'active-status ' : '';
      $pid         = $isAdmin ? $row['pid'] : '';
      $property    = <<<DELIMETER
  
      <tr>
      <th scope="row">
        <div class="media align-items-center">
          <div class="media-body">
            <span class="mb-0 text-sm">{$row['pname']}</span>
          </div>
        </div>
      </th>
      <td>{$user_name}</td>
      <td>{$row['pcity']}</td>
      <td>{$row['location']}</td>
      <td><button type="button" class="{$classname}btn-sm btn-outline-{$statusColor}" data-pid="{$pid}">{$status}</button></td>
      <td>
      <button id="openAddImagesModal" class="btn btn-icon btn-sm btn-primary alert-secondary" type="button" data-toggle="modal"
      data-target="#addImagesModal" data-pid="{$row['pid']}" data-original-title="Add Images">    
        <span class="btn-inner--icon"><i class="fas fa-images"></i></span>  
        <span class="btn-inner--text">Add Images</span>  
      </button>
      </td>
      <td>
      <button id="openAddAmenitiesModal" class="btn btn-icon btn-sm btn-primary alert-secondary" type="button" data-toggle="modal" 
      data-target="#addAmenitiesModal" data-pid="{$row['pid']}" data-original-title="Add Amenities" >
        <span class="btn-inner--icon"><i class="fas fa-door-open"></i></span>  
        <span class="btn-inner--text">Add Amenities</span>  
      </button>
      </td>
      <td>
      <button id="openPlacesModal" class="btn btn-icon btn-sm btn-primary alert-secondary" type="button" data-toggle="modal" 
      data-target="#addPlacesModal" data-pid="{$row['pid']}" data-original-title="Add Nearby Places">
        <span class="btn-inner--icon"><i class="fas fa-map-marked-alt"></i></span>  
        <span class="btn-inner--text">Add Nearest Places</span>  
      </button>
      </td>
      
      <td>
        <div class="avatar-group">
          <a href="index.php?edit_property&pid={$row['pid']}" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Edit Property">
              <i class="fas fa-pencil-alt text-orange"></i>
          </a>
          <a class="avatar avatar-sm" id="propertyDeleteModal" data-original-title="Delete Property" data-pid={$row['pid']} data-toggle="modal" data-target="#deleteModal">
              <i class="fas fa-trash-alt text-red"></i>
          </a> 
        </div>
      </td>
      </tr>
DELIMETER;
  
  echo $property;
    }
  
  echo "</tbody></table></div><div class='card-footer py-4'><nav aria-label='...'><ul class='pagination justify-content-end mb-0'>{$outputPagination}</ul></nav></div>";
  }
  else {
    echo "No properties found!!";
  }          
}

function show_company_name($username){
  $company_query = query("SELECT * FROM builders WHERE (username = '{$username}') OR (userno = '{$username}') OR (userid = '{$username}')");
  confirm($company_query);

  while($company_row = fetch_array($company_query)) {
    return $company_row['username'];
  }
}

function get_username(){
  $companyname = show_company_name($_SESSION['userno']);
  $_SESSION['companyname'] = $companyname;
}

function get_user_id($userno){
  $company_query = query("SELECT userid FROM builders WHERE userno = '{$userno}' ");
  confirm($company_query);

  $company_row = fetch_array($company_query);
  return $company_row['userid'];
}

function add_property(){
  $companyname = show_company_name($_SESSION['userno']);
  $_SESSION['companyname'] = $companyname;
  if(isset($_POST['create'])) {
    $pstate             = escape_string($_POST['pstate']);
    $pcity              = escape_string($_POST['pcity']);
    $location           = escape_string($_POST['location']);
    $pname              = escape_string($_POST['pname']);
    $rera               = escape_string($_POST['rera']);
    $reraapp            = escape_string($_POST['reraapp']);
    $rera_image         = escape_string($_FILES['rera-file']['name']);
    $image_temp_location= $_FILES['rera-file']['tmp_name'];
    $paddress           = escape_string($_POST['paddress']);
    $minprice           = escape_string($_POST['minprice']);
    $maxprice           = escape_string($_POST['maxprice']);
    $pdesc              = escape_string($_POST['pdesc']);
    $ptype              = escape_string($_POST['ptype']);
    $proomtype          = escape_string($_POST['proomtype']);
    $plat               = escape_string($_POST['plat']);
    $plog               = escape_string($_POST['plog']);
    $pzoom              = escape_string($_POST['pzoom']);
    
    echo $ptype;
    if(move_uploaded_file($image_temp_location  , UPLOADS . DS . $rera_image)){
      $query = "INSERT INTO properties";
      $query.= "(username,pstate,pcity,location,pname,rera,reraapp,reracert,paddress,minprice,maxprice,pdesc,ptype,proomtype,plat,plog,pzoom)";
      $query.= "VALUES('{$companyname}','{$pstate}','{$pcity}','{$location}','{$pname}','{$rera}','{$reraapp}','{$rera_image}','{$paddress}','{$minprice}','{$maxprice}','{$pdesc}','{$ptype}','{$proomtype}','{$plat}','{$plog}','{$pzoom}')";
      confirm(query($query));
     // set_message("City Added");
    //  if(is_array($_FILES)){
    //   if(is_uploaded_file($_FILES['rera-file']['tmp_name'])) {
        // if(move_uploaded_file($_FILES['rera-file']['tmp_name'], UPLOADS . DS . $rera_image)) {
      echo "<script> window.location.assign('index.php?properties'); </script>";
      // echo "Neel";
  //   }
  // }
  }
  }
}

function edit_property($pid){
  if(isset($_POST['update'])) {
    $pstate             = escape_string($_POST['pstate']);
    $pcity              = escape_string($_POST['pcity']);
    $location           = escape_string($_POST['location']);
    $pname              = escape_string($_POST['pname']);
    $rera               = escape_string($_POST['rera']);
    $reraapp            = escape_string($_POST['reraapp']);
    $paddress           = escape_string($_POST['paddress']);
    $minprice           = escape_string($_POST['minprice']);
    $maxprice           = escape_string($_POST['maxprice']);
    $pdesc              = escape_string($_POST['pdesc']);
    $ptype              = escape_string($_POST['ptype']);
    $proomtype          = escape_string($_POST['proomtype']);
    $plat               = escape_string($_POST['plat']);
    $plog               = escape_string($_POST['plog']);
    $pzoom              = escape_string($_POST['pzoom']);
    
    if(isset($_FILES['rera-file']['tmp_name'])){
      $rera_image         = escape_string($_FILES['rera-file']['name']);
      $image_temp_location= $_FILES['rera-file']['tmp_name'];
      move_uploaded_file($_FILES['rera-file']['tmp_name']  , UPLOADS . DS . $rera_image);

      $query = "UPDATE properties SET ";
      $query.= "reracert = '{$rera_image}',";
      // $query.= "image_temp_location = '{$image_temp_location}',";
    }
    else {
      $query = "UPDATE properties SET ";
    }
      $query.= "pstate = '{$pstate}',";
      $query.= "pcity = '{$pcity}',";
      $query.= "location = '{$location}',";
      $query.= "pname = '{$pname}',";
      $query.= "rera = '{$rera}',";
      $query.= "reraapp = '{$reraapp}',";
      $query.= "paddress = '{$paddress}',";
      $query.= "minprice = '{$minprice}',";
      $query.= "maxprice = '{$maxprice}',";
      $query.= "pdesc = '{$pdesc}',";
      $query.= "ptype = '{$ptype}',";
      $query.= "proomtype = '{$proomtype}',";
      $query.= "plat = '{$plat}',";
      $query.= "plog = '{$plog}',";
      $query.= "pzoom = '{$pzoom}'";
      $query.= "WHERE pid = '{$pid}'";
      confirm(query($query));
     // set_message("City Added");
    //  if(is_array($_FILES)){
    //   if(is_uploaded_file($_FILES['rera-file']['tmp_name'])) {
        // if(move_uploaded_file($_FILES['rera-file']['tmp_name'], UPLOADS . DS . $rera_image)) {
      echo "<script> window.location.assign('index.php?properties'); </script>";
      // echo "Neel";
  //   }
  // }

  }


}

function get_enquiries_in_admin(){
  $userid = get_user_id($_SESSION['userno']);
  if($userid == 5)
    $query = "SELECT * FROM enquiries ORDER BY edate DESC, enquiryid DESC";
  else
    $query = "SELECT * FROM enquiries WHERE userid = '{$userid}' ORDER BY edate DESC, enquiryid DESC";
  confirm(query($query));

  $rows = mysqli_num_rows(query($query)); // Get total of mumber of rows from the database

  if(isset($_GET['page'])){ //get page from URL if its there
    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers
  } else{// If the page url variable is not present force it to be number 1
    $page = 1;
  }

  $perPage = 10; // Items per page here
  $lastPage = ceil($rows / $perPage); // Get the value of the last page

  // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

  if($page < 1){ // If it is less than 1
    $page = 1; // force if to be 1
  }elseif($page > $lastPage){ // if it is greater than $lastpage
    $page = $lastPage; // force it to be $lastpage's value
  }

  $middleNumbers = ''; // Initialize this variable

  // This creates the numbers to click in between the next and back buttons
  $sub1 = $page - 1;
  $sub2 = $page - 2;
  $add1 = $page + 1;
  $add2 = $page + 2;

  if($page == 1){
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
  } elseif ($page == $lastPage) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
  }elseif ($page > 2 && $page < ($lastPage -1)) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub2.'">' .$sub2. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add2.'">' .$add2. '</a></li>';
  } elseif($page > 1 && $page < $lastPage){
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page= '.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
  }

  // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
  $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

  $query2 = query("$query $limit");
  confirm($query2);

  $outputPagination = ""; // Initialize the pagination output variable

  // if($lastPage != 1){
  //    echo "Page $page of $lastPage";
  // }

  // If we are not on page one we place the back link
  if($page != 1){
      $prev  = $page - 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$prev.'"><i class="fas fa-angle-left"></i>
      <span class="sr-only">Previous</span></a></li>';
  }

  // Lets append all our links to this variable that we can use this output pagination
  $outputPagination .= $middleNumbers;

  // If we are not on the very last page we the place the next link
  if($page != $lastPage){
      $next = $page + 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$next.'"><i class="fas fa-angle-right"></i>
      <span class="sr-only">Next</span></a></li>';
  }

  // Done with pagination


  while($row = fetch_array($query2)) {
    $propertyname = show_property_name($row['pid']);
    $enquiry    = <<<DELIMETER

    <tr>
      <th scope="row">
        <div class="media align-items-center">
          <div class="media-body">
            <span class="mb-0 text-sm">{$propertyname}</span>
          </div>
        </div>
      </th>
      <td>{$row['edate']}</td>
      <td>{$row['ename']}</td>
      <td>{$row['eemail']}</td>
      <td>{$row['emobile']}</td>
      <td>{$row['emessage']}</td>
    </tr>
DELIMETER;

echo $enquiry;
  }

echo "</tbody></table></div><div class='card-footer py-4'><nav aria-label='...'><ul class='pagination justify-content-end mb-0'>{$outputPagination}</ul></nav></div>";        
}

function get_suppliers_in_admin(){
  $query = query("SELECT * FROM suppliers");
  confirm($query);

  $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database

  if(isset($_GET['page'])){ //get page from URL if its there
    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers
  } else{// If the page url variable is not present force it to be number 1
    $page = 1;
  }

  $perPage = 10; // Items per page here
  $lastPage = ceil($rows / $perPage); // Get the value of the last page

  // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

  if($page < 1){ // If it is less than 1
    $page = 1; // force if to be 1
  }elseif($page > $lastPage){ // if it is greater than $lastpage
    $page = $lastPage; // force it to be $lastpage's value
  }

  $middleNumbers = ''; // Initialize this variable

  // This creates the numbers to click in between the next and back buttons
  $sub1 = $page - 1;
  $sub2 = $page - 2;
  $add1 = $page + 1;
  $add2 = $page + 2;

  if($page == 1){
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
  } elseif ($page == $lastPage) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
  }elseif ($page > 2 && $page < ($lastPage -1)) {
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub2.'">' .$sub2. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add2.'">' .$add2. '</a></li>';
  } elseif($page > 1 && $page < $lastPage){
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page= '.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a class="page-link">' .$page. '</a></li>';
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$add1.'">' .$add1. '</a></li>';
  }

  // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
  $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

  $query2 = query("SELECT * FROM suppliers ORDER BY supplierid DESC $limit");
  confirm($query2);

  $outputPagination = ""; // Initialize the pagination output variable

  // if($lastPage != 1){
  //    echo "Page $page of $lastPage";
  // }

  // If we are not on page one we place the back link
  if($page != 1){
      $prev  = $page - 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$prev.'"><i class="fas fa-angle-left"></i>
      <span class="sr-only">Previous</span></a></li>';
  }

  // Lets append all our links to this variable that we can use this output pagination
  $outputPagination .= $middleNumbers;

  // If we are not on the very last page we the place the next link
  if($page != $lastPage){
      $next = $page + 1;
      $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?enquiries&page='.$next.'"><i class="fas fa-angle-right"></i>
      <span class="sr-only">Next</span></a></li>';
  }

  // Done with pagination


  while($row = fetch_array($query2)) {
    // $propertyname = show_property_name($row['pid']);
    $supplier    = <<<DELIMETER

    <tr>
      <th scope="row">
        <div class="media align-items-center">
          <div class="media-body">
            <span class="mb-0 text-sm">{$row['sname']}</span>
          </div>
        </div>
      </th>
      <td>{$row['scity']}</td>
      <td>
        <div class="col ml--2 mt-2">
          <a href="#!" class="avatar" style="width: 150px; height: 70px; border-radius: 10%;">
            <img alt="Image placeholder" 
            src="../../resources/uploads/{$row['sposter']}"  
            style="border-radius: 10%;">
          </a>
        </div>
      </td>
      <td>
      <div class="avatar-group">
        <a href="index.php?edit_supplier&supplierid={$row['supplierid']}" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Edit Supplier">
            <i class="fas fa-pencil-alt text-orange"></i>
        </a>
        <a class="avatar avatar-sm" id="supplierDeleteModal" data-original-title="Delete Property" data-supplierid={$row['supplierid']} data-toggle="modal" data-target="#deleteModal">
            <i class="fas fa-trash-alt text-red"></i>
        </a> 
      </div>
      </td>
    </tr>
DELIMETER;
// <button type="button" class="btn btn-sm btn-primary" id="submitDisplayImage">Upload</button>

echo $supplier;
  }

echo "</tbody></table></div><div class='card-footer py-4'><nav aria-label='...'><ul class='pagination justify-content-end mb-0'>{$outputPagination}</ul></nav></div>";        
}

function show_property_name($pid){
  $property_query = query("SELECT * FROM properties WHERE pid = $pid ");
  confirm($property_query);

  while($property_row = fetch_array($property_query)) {
    return $property_row['pname'];
  }
}

function show_username($userid){
  $query = query("SELECT username from builders WHERE userid = $userid ");
  confirm($query);
  $user_row = fetch_array($query);
  return $user_row['username'];
}

// FUNCTIONS FOR PROPERTY SEARCH
function get_properties_for_search(){
  $query = query("SELECT DISTINCT pname from properties ORDER BY pname");
  confirm($query);

  while($row = fetch_array($query)) {
    $propertyname = <<<DELIMETER
    <option value="{$row['pname']}">{$row['pname']}</option>
DELIMETER;
echo $propertyname;
  }
}

function get_builders_for_search(){
  $query = query("SELECT DISTINCT userid from properties ORDER BY userid");
  confirm($query);

  while($row = fetch_array($query)) {
    $user_name = show_company_name($row['userid']);
    $builder = <<<DELIMETER
    <option value="{$user_name}">{$user_name}</option>
DELIMETER;
echo $builder;
  }
}

function get_cities_for_search(){
  $query = query("SELECT DISTINCT pcity from properties ORDER BY pcity");
  confirm($query);

  while($row = fetch_array($query)) {
    $city = <<<DELIMETER
    <option value="{$row['pcity']}">{$row['pcity']}</option>
DELIMETER;
echo $city;
  }
}

function get_ptype_for_search(){
  $ptype = array("Apartment","Residential","Duplex","Row House","Plot","Pent House","Farm House","Bungalow","Commercial Shop","Office","Villa","Flats");
  // Loop through ptype array
  foreach($ptype as $value){
      echo "<option value='$value'>{$value}</option>";
    }
}

function get_proomtype_for_search(){
  $proomtype = array("1RK","1BHK","2BHK","3BHK","4BHK","4+BHK");
 
  // Loop through ptype array
  foreach($proomtype as $value){
      echo "<option value='$value'>{$value}</option>";
    }
}
?>