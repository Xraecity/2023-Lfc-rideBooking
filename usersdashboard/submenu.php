<?php
// Fetch the user's selected avatar from the database
$stmt = $db->prepare("SELECT avatar FROM users_registration WHERE email = ?");
$stmt->execute([$_SESSION['email']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $userAvatar = $row['avatar'];
} else {
    // Default avatar source if not found in the database
    $userAvatar = 'assets/images/author/avatar.png';
}


?>

<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <img class="avatar user-thumb" src="<?php echo $userAvatar; ?>" alt="avatar" style="width: 50px">
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $user['fname']; ?> <i class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Message</a>
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
    </div>
</div>