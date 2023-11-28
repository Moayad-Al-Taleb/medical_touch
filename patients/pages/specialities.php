<?php
session_start();

include "../includes/header.php";

$box = isset($_GET['box']) ? $_GET['box'] : "index";

if ($box == "index") {
    require '../../connect.php';

    $sql = "SELECT * FROM specialties";
    $result = $conn->query($sql);
?>
    <main class="container">
        <h1 class="main-text-color">our medical services</h1>
        <p style="max-width: 70%; text-align: center; margin: 8px auto;">Welcome to Medical Touch - Your Gateway to Expert Medical Services</p>
        <div class="speialities-wrapper">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <a href="?box=show&&id=<?php echo $row['id']; ?>" class="speciality">
                        <div class="speciality-icon">
                            <svg class="icon" id="SvgjsSvg1076" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                <defs id="SvgjsDefs1077"></defs>
                                <g id="SvgjsG1078"><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 512 512">
                                        <path d="m435.19 382.037 68.707-79.987a39.256 39.256 0 0 0 7.876-37.035L472.146 132.91a23.927 23.927 0 0 0-46.836 6.81c0 .56.017 1.12.057 1.633l5.522 80.524a19.146 19.146 0 0 0-14.815 5.186l-67.82 64.67a78.73 78.73 0 0 0-24.314 56.707v61.849a28.387 28.387 0 0 0-13.97 24.417V504.5a7.5 7.5 0 0 0 15 0v-51.75H425.31v51.75a7.5 7.5 0 0 0 15 0v-69.794a28.375 28.375 0 0 0-13.38-24.055v-6.341a34.21 34.21 0 0 1 8.26-22.273Zm-9.881 55.713H324.97v-3.044a13.461 13.461 0 0 1 13.494-13.396h73.35a13.461 13.461 0 0 1 13.494 13.396Zm-1.5-65.485a49.218 49.218 0 0 0-11.88 32.045v2.003c-.038 0-.076-.003-.115-.003H338.94v-57.87a63.666 63.666 0 0 1 19.665-45.852l67.824-64.672a4.2 4.2 0 0 1 5.853.073l.559.568q.318.319.614.65c.065.08.132.158.2.235a21.937 21.937 0 0 1-1.04 30.158l-37.63 37.1a7.5 7.5 0 0 0 10.53 10.68l37.632-37.1a36.939 36.939 0 0 0 3.443-48.696l-6.263-91.321a7.27 7.27 0 0 1-.017-.543 8.928 8.928 0 0 1 17.466-2.505l39.63 132.11a24.323 24.323 0 0 1-4.885 22.948ZM189.5 410.289V347a78.738 78.738 0 0 0-24.314-56.708l-67.818-64.668a19.137 19.137 0 0 0-14.818-5.183l5.516-80.446c.043-.539.064-1.1.064-1.715a23.927 23.927 0 0 0-46.833-6.815L1.666 263.575a39.25 39.25 0 0 0 7.875 37.031l68.709 79.99a34.218 34.218 0 0 1 8.26 22.274v7.782a28.374 28.374 0 0 0-13.378 24.054V504.5a7.5 7.5 0 0 0 15 0v-51.75H188.47v51.75a7.5 7.5 0 0 0 15 0v-69.794a28.387 28.387 0 0 0-13.97-24.417ZM20.917 290.83a24.321 24.321 0 0 1-4.884-22.944l39.633-132.117a8.927 8.927 0 0 1 17.464 2.511c0 .174-.002.347-.023.608l-6.257 91.247a36.948 36.948 0 0 0 3.444 48.706l37.63 37.1a7.5 7.5 0 1 0 10.532-10.682L80.827 268.16a21.95 21.95 0 0 1-1.028-30.184c.256-.291.517-.577.849-.908l.494-.506a4.214 4.214 0 0 1 5.873-.085l67.818 64.668A63.668 63.668 0 0 1 174.5 347v59.31h-72.874c-.04 0-.077.002-.116.003v-3.443a49.227 49.227 0 0 0-11.88-32.047ZM188.47 437.75H88.132v-3.044a13.461 13.461 0 0 1 13.494-13.396h73.349a13.461 13.461 0 0 1 13.495 13.396Zm92.267-164.96c23.471-7.214 42.172-14.704 45.553-28.691a17.178 17.178 0 0 0-2.284-13.594c-5.096-7.958-16.903-13.21-32.407-17.5 25.359-5.96 44.504-13.327 48.212-27.528a15.77 15.77 0 0 0-1.803-12.417c-4.7-7.76-15.822-13.17-37.196-18.09a7.5 7.5 0 0 0-3.365 14.618c21.943 5.052 26.702 9.545 27.73 11.242a.854.854 0 0 1 .12.858c-.465 1.78-3.339 6.51-19.952 11.974-11.71 3.851-26.83 6.973-41.845 9.946v-64.856h72.619l.012.001.022-.001h44.117a11.5 11.5 0 0 0 8.71-19.009l-49.957-57.95A44.872 44.872 0 0 0 284.241 51.2L263.5 61.928V48.85a25 25 0 1 0-15 0v13.08L227.759 51.2a44.873 44.873 0 0 0-54.782 10.593l-49.957 57.95a11.5 11.5 0 0 0 8.71 19.009h44.117l.022.001.012-.001H248.5v64.856c-15.014-2.973-30.135-6.095-41.845-9.946-16.613-5.465-19.487-10.194-19.952-11.975a.852.852 0 0 1 .12-.857c1.028-1.697 5.786-6.19 27.725-11.241a7.5 7.5 0 1 0-3.365-14.617c-21.37 4.92-32.493 10.33-37.19 18.089a15.768 15.768 0 0 0-1.804 12.416c3.708 14.2 22.853 21.569 48.212 27.529-15.504 4.289-27.311 9.54-32.407 17.499a17.178 17.178 0 0 0-2.284 13.594c3.381 13.987 22.082 21.477 45.553 28.692-11.253 4.542-19.807 9.779-23.667 16.947a17.72 17.72 0 0 0-1.341 13.86c3.48 11.388 15.925 18.537 30.78 25.027-15.412 7.752-27.367 17.617-23.86 33.19a7.5 7.5 0 0 0 14.634-3.297c-1.523-6.76 7.227-12.576 20.691-18.724v20.372a7.5 7.5 0 0 0 15 0v-20.372c13.464 6.148 22.214 11.963 20.691 18.724a7.5 7.5 0 1 0 14.633 3.296c3.508-15.572-8.447-25.437-23.858-33.189 14.854-6.49 27.3-13.64 30.78-25.026a17.72 17.72 0 0 0-1.342-13.86c-3.86-7.17-12.414-12.406-23.667-16.948ZM248.5 317.198c-12.682-5.29-25.92-11.504-27.9-17.981a2.709 2.709 0 0 1 .203-2.365c2.75-5.11 14.491-9.957 27.697-14.296Zm0-54.912c-12.137-3.574-24.677-7.27-34.065-11.395-11.766-5.17-13.812-8.937-14.145-10.317a2.221 2.221 0 0 1 .337-1.98c4.42-6.905 26.345-12.274 47.873-16.698Zm0-138.533h-40.076a55.775 55.775 0 0 0 3.794-3.785 57.453 57.453 0 0 0 10.89-17.686 7.5 7.5 0 1 0-13.971-5.46 42.512 42.512 0 0 1-8.048 13.088c-8.639 9.559-19.694 12.767-25.863 13.843h-35.858l44.97-52.164a29.922 29.922 0 0 1 36.53-7.065L248.5 78.817Zm62.873 114.84a2.221 2.221 0 0 1 .337 1.981c-.333 1.38-2.379 5.147-14.145 10.317-9.389 4.125-21.928 7.82-34.065 11.395v-40.39c21.528 4.424 43.452 9.792 47.873 16.698ZM291.132 64.525a29.921 29.921 0 0 1 36.53 7.064l44.97 52.164h-35.858c-6.17-1.076-17.224-4.284-25.863-13.842a42.528 42.528 0 0 1-8.048-13.09 7.5 7.5 0 1 0-13.97 5.461 57.47 57.47 0 0 0 10.89 17.687 55.756 55.756 0 0 0 3.792 3.784H263.5V78.817ZM256 35a10 10 0 1 1 10-10 10.012 10.012 0 0 1-10 10Zm35.4 264.216c-1.98 6.477-15.218 12.691-27.9 17.98v-34.64c13.206 4.338 24.946 9.185 27.697 14.295a2.709 2.709 0 0 1 .202 2.365Z" fill="#50b3ba" class="color000 svgShape"></path>
                                    </svg></g>
                            </svg>
                        </div>
                        <span class="main-text-color"><?php echo $row['name'] ?></span>
                    </a>
            <?php
                }
            } else {
                echo "No data has been added.";
            }
            ?>
        </div>
    </main>
<?php
} elseif ($box == "show") {
    $id = intval($_GET['id']);
    $specialty_id = $id;
    require '../../static_functions.php';
    require '../../connect.php';

    $sql = "SELECT doctors.*, specialties.name FROM doctors, specialties WHERE doctors.specialty_Id = specialties.id AND doctors.account_type = 2 AND doctors.account_status = 1 AND specialty_id='$specialty_id'";
    $result = $conn->query($sql);
?>
    <main class="container">
        <h1 class="main-text-color">Get to know our doctors</h1>
        <p style="max-width: 70%; text-align: center; margin: 8px auto;">At Medical Touch, we take immense pride in introducing our esteemed team of doctors who are at the heart of our commitment to exceptional healthcare. Each doctor brings a unique set of skills, expertise, and compassion to ensure you receive the best possible medical care. Get to know our exceptional doctors:</p>
        <div class="doctors-wrapper">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="doctor">
                        <div class="doctor-icon">
                            <svg id="SvgjsSvg1230" width="288" height="288" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
                                <circle id="SvgjsCircle1254" r="144" cx="144" cy="144" transform="matrix(0.56,0,0,0.56,63.359999999999985,63.359999999999985)" fill="#ffffff">
                                </circle>
                                <defs id="SvgjsDefs1231"></defs>
                                <g id="SvgjsG1232" transform="matrix(0.36,0,0,0.36,92.16,92.15999908447266)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="288" height="288">
                                        <path fill="#bec6c6" d="M34 8v6.5c-.79-.6-1.42-.5-3-.5v-1a4.83 4.83 0 0 1-4.29-2.59A10 10 0 0 1 20 13h-3v1c-1.64 0-2.21-.1-3 .5V10a8 8 0 0 1 8-8h2.69a8 8 0 0 1 5.65 2.34L31 5a3 3 0 0 1 3 3Z" class="colorbec6c6 svgShape"></path>
                                        <path fill="#f8f9f9" d="M17 14v5h-1.5a2.5 2.5 0 1 1 0-5zm18 2.5a2.5 2.5 0 0 1-2.5 2.5H31v-5h1.5a2.49 2.49 0 0 1 2.5 2.5z" class="colorf8f9f9 svgShape"></path>
                                        <path fill="#f8f9f9" d="M31 13v6a7 7 0 0 1-2 5c-4.53 4.43-12 1.07-12-5.29V13h3a10 10 0 0 0 6.71-2.59A4.83 4.83 0 0 0 31 13Z" class="colorf8f9f9 svgShape"></path>
                                        <path fill="#bec6c6" d="M30.71 21a6.94 6.94 0 0 1-13.33 0c1.27 0 2.47.15 3.62-1a3.41 3.41 0 0 1 2.41-1c1.27 0 2.46-.13 3.59 1s2.37 1 3.71 1Z" class="colorbec6c6 svgShape"></path>
                                        <path fill="#414141" d="M24 27a8.1 8.1 0 0 1-7.6-5.69 1 1 0 0 1 .14-.9c.7-1 2.36.24 3.72-1.12s3-1.29 4.3-1.29a4.45 4.45 0 0 1 3.12 1.29 2.43 2.43 0 0 0 1.7.71h1.3a1 1 0 0 1 1 1.28A8 8 0 0 1 24 27Zm-5.12-5a5.91 5.91 0 0 0 10.32 0 4.5 4.5 0 0 1-2.91-1.29c-.87-.88-1.9-.71-2.88-.71a2.43 2.43 0 0 0-1.7.71 4.49 4.49 0 0 1-2.8 1.29Z" class="color414141 svgShape"></path>
                                        <path fill="#f8f9f9" d="M41 33.47V46H7V33.47a4 4 0 0 1 3.43-4L21 28v-2.74a6.74 6.74 0 0 0 6 .07V28l10.57 1.51A4 4 0 0 1 41 33.47Z" class="colorf8f9f9 svgShape"></path>
                                        <path fill="#bec6c6" d="M35 36a1 1 0 0 1-1-1v-5.86a1 1 0 0 1 2 0V35a1 1 0 0 1-1 1zm-22 0a1 1 0 0 1-1-1v-5.86a1 1 0 0 1 2 0V35a1 1 0 0 1-1 1z" class="colorbec6c6 svgShape"></path>
                                        <path fill="#bec6c6" d="M15 40a1 1 0 0 1-1-1v-2a1 1 0 0 0-2 0v2a1 1 0 0 1-2 0v-2a3 3 0 0 1 6 0v2a1 1 0 0 1-1 1zm12-10-3 10-3-10a5.41 5.41 0 0 0 6 0z" class="colorbec6c6 svgShape"></path>
                                        <path fill="#bec6c6" d="m17 34 1-2-1.67-3.33L21 28l3 12-7-6zM30 32l1 2-7 6 3-12 4.67.67L30 32z" class="colorbec6c6 svgShape"></path>
                                        <path fill="#414141" d="M34 15.5a1 1 0 0 1-1-1V8a2 2 0 0 0-2-2c-.46 0-.6-.19-1.37-1a6.94 6.94 0 0 0-4.94-2H22a7 7 0 0 0-7 7v4.5a1 1 0 0 1-2 0V10a9 9 0 0 1 9-9h2.69a9 9 0 0 1 6.36 2.63l.39.39A4 4 0 0 1 35 8v6.5a1 1 0 0 1-1 1Z" class="color414141 svgShape"></path>
                                        <path fill="#414141" d="M17 20h-1.5a3.5 3.5 0 0 1 0-7H17a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1zm-1.5-5a1.5 1.5 0 0 0 0 3h.5v-3zm17 5H31a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1h1.5a3.5 3.5 0 0 1 0 7zm-.5-2h.5a1.5 1.5 0 0 0 0-3H32z" class="color414141 svgShape"></path>
                                        <path fill="#414141" d="M24 27a8.23 8.23 0 0 1-8-8.29V13a1 1 0 0 1 2 0v5.71A6.23 6.23 0 0 0 24.2 25a6 6 0 0 0 5.8-6v-5.08a5.83 5.83 0 0 1-4.18-3.05A1 1 0 1 1 27.6 10a3.82 3.82 0 0 0 3.4 2 1 1 0 0 1 1 1v6a8 8 0 0 1-8 8Z" class="color414141 svgShape"></path>
                                        <path fill="#414141" d="M20 14h-3a1 1 0 0 1-.45-1.89 5.76 5.76 0 0 0 2.56-2.56 1 1 0 1 1 1.78.9 7 7 0 0 1-1 1.55 9.06 9.06 0 0 0 7.31-3.6 1 1 0 1 1 1.6 1.2A11.08 11.08 0 0 1 20 14zm4 27c-.52 0-.08.25-7.65-6.24a1 1 0 0 1-.24-1.21l.77-1.55-1.44-2.88a1 1 0 0 1 1.78-.9l1.67 3.33a1 1 0 0 1 0 .9l-.65 1.3 4 3.45-2.24-9a1 1 0 1 1 2-.44l3 12A1 1 0 0 1 24 41z" class="color414141 svgShape"></path>
                                        <path fill="#414141" d="M24 41a1 1 0 0 1-1-1.24l3-12a1 1 0 1 1 1.94.48l-2.24 9 4-3.45-.65-1.3a1 1 0 0 1 0-.9l1.67-3.33a1 1 0 1 1 1.78.9L31.12 32l.77 1.55a1 1 0 0 1-.24 1.21C24.09 41.24 24.53 41 24 41zM7 47a1 1 0 0 1-1-1V33.47a5 5 0 0 1 4.29-4.95L20 27.13v-1.87a1 1 0 0 1 2 0V28a1 1 0 0 1-.86 1l-10.56 1.5a3 3 0 0 0-2.58 3V46a1 1 0 0 1-1 1z" class="color414141 svgShape"></path>
                                        <path fill="#414141" d="M41 47a1 1 0 0 1-1-1V33.47a3 3 0 0 0-2.58-3L26.86 29a1 1 0 0 1-.86-1v-2.74a1 1 0 0 1 2 0v1.87l9.71 1.39A5 5 0 0 1 42 33.47V46a1 1 0 0 1-1 1Z" class="color414141 svgShape"></path>
                                        <path fill="#bec6c6" d="M32 43a1 1 0 0 1-1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1-1 1Z" class="colorbec6c6 svgShape"></path>
                                        <rect width="8" height="4" x="28" y="42" fill="#50b3ba" rx="1" class="color6457ff svgShape"></rect>
                                        <path fill="#bec6c6" d="M35 40a3 3 0 1 1 3-3 3 3 0 0 1-3 3Zm0-4a1 1 0 1 0 1 1 1 1 0 0 0-1-1Z" class="colorbec6c6 svgShape"></path>
                                    </svg></g>
                            </svg>
                        </div>
                        <div class="doctor-content">
                            <h3 class="main-text-color"><?php echo $row['full_name']; ?></h3>
                            <small class="main-text-color">doctor speciality</small>
                            <p class="main-text-color"><?php echo $row['clinic_hospital_affiliation']; ?></p>
                        </div>
                        <div class="active-status">
                            <?php
                            echo ($row['activity_status'] == 1) ? "<div class='online'></div>" : "<div class='offline'></div>";
                            ?>
                        </div>
                        <div>
                            <a href="../../chat.php?box=start_chat&&doctor_id=<?php echo $row['id']; ?>&fromDoctor=yes" class="doctor-btn">start chat</a>
                            <a href="?box=view_dr&&id=<?php echo $row['id']; ?>" class="doctor-btn">view</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "no doctors yet !";
            }
            ?>
        </div>
    </main>

<?php
} elseif ($box == "view_dr") {
    $id = intval($_GET['id']);
    $doctor_id = $id;

    $id = intval($_GET['id']);

    require '../../connect.php';

    $sql = "SELECT doctors.*, specialties.name FROM doctors, specialties WHERE doctors.specialty_Id = specialties.id AND doctors.id='$id'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
?>
    <main class="container">
        <h1 class="main-text-color">about the doctor</h1>
        <div class="doctor-info">
            <div>
                <span><b>full name:</b> <?php echo $row['full_name']; ?></span>
                <span><b>specialty:</b> <?php echo $row['name']; ?></span>
                <span><b>contact information:</b> <?php echo $row['contact_information']; ?></span>
                <span><b>availability:</b> <?php echo $row['availability']; ?></span>
                <span><b>languages:</b> <?php echo $row['languages']; ?></span>
            </div>
            <div>
                <span><b>clinic hospital affiliation:</b> <?php echo $row['clinic_hospital_affiliation']; ?></span>
                <span><b>user name:</b> <?php echo $row['user_name']; ?></span>
                <span><b>email address:</b> <?php echo $row['email_address']; ?></span>
                <span><b>account status:</b> <?php echo ($row['account_status'] == 1) ? "account is active" : "account is inactive"; ?></span>
                <span><b>activity status:</b> <?php echo ($row['activity_status'] == 1) ? "online account" : "The account is offline"; ?></span>
            </div>
        </div>
        <?php

        require '../../connect.php';

        $sql = "SELECT * FROM certificates WHERE certificates.doctor_id='$doctor_id'";
        $result = $conn->query($sql);


        ?>
        <h1 class="main-text-color">attached certificates</h1>
        <?php
        if ($result->num_rows > 0) {
            $counter = 1;
        ?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-head">
                        <tr>
                            <th>#</th>
                            <th>description</th>
                            <th>experience</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $file = "../../manager/Attached Certificates/" . $row['certificate'];
                        ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $row['experience'] ?></td>
                                <td align="center">
                                    <a href="<?php echo $file; ?>"><button class="main-btn">file view</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo "no attached certificates to show";
        }
        ?>
    </main>
<?php
}
include "../includes/footer.php";
?>