<?php
include 'fetchDB.php';
$email = $_SESSION['email'];

$stmt = $db->prepare("SELECT * FROM users_registration WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['user_id'] = $user['id'];


// Display user data
if (!$user) {
    header("location: ../login");
    // Display other user information
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the logged-in user's email from the session (assuming it's stored there)
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    } else {
        echo "User email not found. Please log in.";
        exit;
    }
    if (!isset($_POST['avatar'])) {
        echo '<div class="alert alert-danger">New avatar is required.</div>';
    }
    if (isset($_POST['avatar'])) {
    // Get the new avatar from the form
        $newavatar = $_POST['avatar'];

        // Validate the new avatar (add more validation as needed)
        if (!empty($newavatar)) {
            try {
                // Connect to the database (replace with your database connection code)
                require_once "fetchDB.php";
                
                // Prepare and execute the SQL update statement
                $stmt = $db->prepare("UPDATE users_registration SET avatar = ? WHERE email = ?");
                $stmt->execute([$newavatar, $email]);

                // Check if the update was successful
                if ($stmt->rowCount() > 0) {
                    echo '<div class="alert alert-success">avatar updated successfully!</div>';
                } else {
                    echo '<div class="alert alert-warning">No records updated. User not found or avatar already selected.</div>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } 
    }
}
?>

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

<!-- Display the user's avatar -->

<form class="needs-validation"  method="POST" novalidate="">

    <div class="row">
        <div class="col-12">
            <img src="<?php echo $userAvatar; ?>" alt="User Avatar" class="w-2">
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden  name="avatar" class="btn" value="assets/images/author/yeah.png" >
                <img src="assets/images/author/yeah.png"  class="avatar-img" alt="">   
        </label>
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden  name="avatar" class="btn" value="assets/images/author/bravo.png" >
                <img src="assets/images/author/bravo.png"  class="avatar-img" alt=""> 
        </label>
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden  name="avatar" class="btn" value="assets/images/author/happy.png" >
                <img src="assets/images/author/happy.png"  class="avatar-img" alt=""> 
        </label>
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden  name="avatar" class="btn" value="assets/images/author/here.png" >
                <img src="assets/images/author/here.png"  class="avatar-img" alt=""> 
        </label>
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden name="avatar" class="btn" value="assets/images/author/yeah.png" >
                <img src="assets/images/author/yeah.png"  class="avatar-img" alt=""> 
        </label>
        </div>
        <div class="col-4 zoom">
            <label>
             <input type="radio" hidden  name="avatar" id="avatar" class="btn" value="assets/images/author/bravo.png" >
                <img src="assets/images/author/bravo.png"  class="avatar-img" alt=""> 
        </label>
        </div>
    </div>

    <div id="selected" class="alert alert-success"></div>
    <button type="submit" class="btn text-light user-profile mt-4 pr-4 pl-4">Update avatar</button>
</form>
                                        
                                        
                                        
   
<style>
       

        .selected {
            background-color: #8914fe;
            border-radius: 50%;
            width: 100%;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;  transform: scale(1.2);
        }
        img.avatar-img{
            width: 70%;
            border: 2px solid rgb(236, 236, 236);
            padding: 10px;
            margin: 10px;
            cursor: pointer;
        }
        img.avatar-img:hover{
            border-radius: 50%;
            width: 100%;
            margin: 10px;
            cursor: pointer;
            background: #8914fe ;
            transition: transform 0.3s ease;  transform: scale(1.2);
        }
        #selected{
            display: none;
        }
    </style>

    <script>
        const avatarImages = document.querySelectorAll('.avatar-img');

            function handleImageClick(event) {
                // Remove the 'selected' class from all images
                avatarImages.forEach(img => img.classList.remove('selected'));
                
                // Add the 'selected' class to the clicked image
                event.target.classList.add('selected');

                // Display the selected value (optional)
                const selectedValue = event.target.parentElement.querySelector('input').value;
                console.log(`Selected Value: ${selectedValue}`);
            }

            // Add a click event listener to each image
            avatarImages.forEach(img => img.addEventListener('click', handleImageClick));
    </script>