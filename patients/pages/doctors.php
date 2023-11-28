<?php
session_start();



$box = isset($_GET['box']) ? $_GET['box'] : "index";

if ($box == "index") {
    require '../../connect.php';
    include "../includes/header.php";
    $sql = "SELECT doctors.*, specialties.name FROM doctors, specialties WHERE doctors.specialty_Id = specialties.id AND doctors.account_type = 2 AND doctors.account_status = 1";
    $result = $conn->query($sql);
?>
    <main class="container">
        <h1 class="main-text-color">our doctors</h1>
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
                            <a href="specialities.php?box=view_dr&&id=<?php echo $row['id']; ?>" class="doctor-btn">view</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "no doctors yet!";
            }
            ?>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function() {
                var searchText = $(this).val();

                if (searchText.trim() === '') {
                    // If search text is empty, fetch all data
                    fetchAllData();
                } else {
                    // Perform search for non-empty input
                    performSearch(searchText);
                }
            });
        });

        function fetchAllData() {
            $.ajax({
                type: 'POST',
                url: '?box=search', // Path to your PHP script to fetch all data
                success: function(response) {
                    $('.doctors-wrapper').html(response);
                }
            });
        }

        function performSearch(searchText) {
            $.ajax({
                type: 'POST',
                url: '?box=search', // Path to your PHP script to handle the search
                data: {
                    search: searchText
                },
                success: function(response) {
                    $('.doctors-wrapper').html(response);
                }
            });
        }
    </script>
<?php
}
include "../includes/footer.php";
?>