<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: first.php");
    exit();
}

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "test";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Retrieve personal details
$query_first = "SELECT * FROM first WHERE id = ?";
$stmt_first = $conn->prepare($query_first);
$stmt_first->bind_param("i", $user_id);
$stmt_first->execute();
$result_first = $stmt_first->get_result();
$user_first = $result_first->fetch_assoc();
$stmt_first->close();

// Retrieve educational details
$query_second = "SELECT * FROM second WHERE id = ?";
$stmt_second = $conn->prepare($query_second);
$stmt_second->bind_param("i", $user_id);
$stmt_second->execute();
$result_second = $stmt_second->get_result();
$user_second = $result_second->fetch_assoc();
$stmt_second->close();

// Retrieve skills
$query_third = "SELECT * FROM third WHERE id = ?";
$stmt_third = $conn->prepare($query_third);
$stmt_third->bind_param("i", $user_id);
$stmt_third->execute();
$result_third = $stmt_third->get_result();
$user_third = $result_third->fetch_assoc();
$stmt_third->close();

// Retrieve work experiences
$query_fourth = "SELECT * FROM fourth WHERE id = ?";
$stmt_fourth = $conn->prepare($query_fourth);
$stmt_fourth->bind_param("i", $user_id);
$stmt_fourth->execute();
$result_fourth = $stmt_fourth->get_result();
$work_experiences = [];
while ($row = $result_fourth->fetch_assoc()) {
    $work_experiences[] = $row;
}
$stmt_fourth->close();

// Retrieve hobbies
$query_fifth = "SELECT * FROM fifth WHERE id = ?";
$stmt_fifth = $conn->prepare($query_fifth);
$stmt_fifth->bind_param("i", $user_id);
$stmt_fifth->execute();
$result_fifth = $stmt_fifth->get_result();
$user_fifth = $result_fifth->fetch_assoc();
$stmt_fifth->close();

$conn->close();

// Include TCPDF library
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->AddPage();

$photoPath = 'path/to/default/photo.jpg';
if (file_exists($photoPath)) {
    $pdf->Image($photoPath, 180, 10, 30, 30, '', '', '', true, 300, '', false, false, 0, false, false, false);
}

$aspiringRole = !empty($work_experiences) ? $work_experiences[0]['Roleofjob'] : '';

$html = '
<table class="content-table" cellspacing="10">
    <tr>
        <td style="width: 48%; padding-right: 10px;">
            <h1 style="font-size: 20px; margin-bottom: 2px;">' . htmlspecialchars($user_first['FirstName'] ?? '') . ' ' . htmlspecialchars($user_first['LastName'] ?? '') . '</h1>
            <p class="content-text">Aspiring <b>' . htmlspecialchars($aspiringRole) . '</b></p>
            <hr>
            
            <h2 class="section-heading">SKILLS</h2>
            <p class="content-text">Throughout my career, I have developed a diverse set of skills that have enabled me to perform effectively in my roles. Below are some of the key skills I possess:</p>
            <p class="content-text"><b>1) ' . htmlspecialchars($user_third['skill1'] ?? '') . ' -- ' . htmlspecialchars($user_third['skill1_level'] ?? '') . '</b></p>
            <p class="content-text"><b>2) ' . htmlspecialchars($user_third['skill2'] ?? '') . ' -- ' . htmlspecialchars($user_third['skill2_level'] ?? '') . '</b></p>
            <p class="content-text"><b>3) ' . htmlspecialchars($user_third['skill3'] ?? '') . ' -- ' . htmlspecialchars($user_third['skill3_level'] ?? '') . '</b></p>
            <p class="content-text"><b>4) ' . htmlspecialchars($user_third['skill4'] ?? '') . ' -- ' . htmlspecialchars($user_third['skill4_level'] ?? '') . '</b></p>
            <p class="content-text">' . nl2br(htmlspecialchars($user_third['AdditionalSkills'] ?? '')) . '</p> <!-- Ensure AdditionalSkills is included -->
            <hr>

            <h2 class="section-heading">EDUCATION</h2>
            <p class="content-text">I pursued my studies at <b>' . htmlspecialchars($user_second['College'] ?? '') . '</b>, located in <b>' . htmlspecialchars($user_second['Location'] ?? '') . '</b>. During my time there, I specialized in <b>' . htmlspecialchars($user_second['Domain'] ?? '') . '</b> and earned a <b>' . htmlspecialchars($user_second['Qualification'] ?? '') . '</b>. Achieving a CGPA of <b>' . htmlspecialchars($user_second['Cgpa'] ?? '') . '</b>, I started my educational journey in <b>' . htmlspecialchars($user_second['Jyear'] ?? '') . '</b> and successfully completed it in <b>' . htmlspecialchars($user_second['Fyear'] ?? '') . '</b>. This experience equipped me with valuable knowledge and skills for my career.</p>
            <hr>
        </td>
        
        <td style="width: 8%;">&nbsp;</td>
        
        <td style="width: 48%; padding-left: 10px;">
            <p class="content-text"><b>Email: </b>' . htmlspecialchars($user_first['EmailID'] ?? '') . '</p>
            <p class="content-text"><b>LinkedIn ID: </b>' . htmlspecialchars($user_first['LinkedInID'] ?? '') . '</p>
            <p class="content-text"><b>PhoneNo: </b>' . htmlspecialchars($user_first['PhoneNumber'] ?? '') . '</p>
            <hr>
            <h2 class="section-heading">WORK EXPERIENCE</h2>';

foreach ($work_experiences as $experience) {
    $html .= '
        <p class="content-text">I have the privilege of working at <b>' . htmlspecialchars($experience['OfficeName'] ?? '') . '</b>, located in <b>' . htmlspecialchars($experience['location'] ?? '') . '</b>. In the role of <b>' . htmlspecialchars($experience['Roleofjob'] ?? '') . '</b>, my tenure extended from <b>' . htmlspecialchars($experience['jdate'] ?? '') . '</b> to <b>' . htmlspecialchars($experience['fdate'] ?? '') . '</b>. Mainly, I was involved in <b>' . htmlspecialchars($experience['Project'] ?? '') . '</b>, where the strategic use of <b>' . htmlspecialchars($experience['Software'] ?? '') . '</b> significantly enhanced project management efficiencies.</p>
        <p class="content-text">My contributions were instrumental in driving better productivity and achieving notable results. I actively collaborated with cross-functional teams, fostering a collaborative environment that promoted innovation and continuous improvement. I am proud to have played a key role in initiatives that set a standard for excellence and achievement.</p>
        <hr>';
}

$html .= '
            <h2 class="section-heading">HOBBIES</h2>
            <p class="content-text"><b># ' . htmlspecialchars($user_fifth['hobbie1'] ?? '') . '</b></p>
            <p class="content-text"><b># ' . htmlspecialchars($user_fifth['hobbie2'] ?? '') . '</b></p>
            <p class="content-text"><b># ' . htmlspecialchars($user_fifth['hobbie3'] ?? '') . '</b></p>
            <p class="content-text"><b># ' . htmlspecialchars($user_fifth['hobbie4'] ?? '') . '</b></p>
            <hr>

            <h2 class="section-heading">DETAILS</h2>
            <p class="content-text"><b>ADDRESS:</b> ' . htmlspecialchars($user_first['Address'] ?? '') . '</p>
            <p class="content-text"><b>Country:</b> ' . htmlspecialchars($user_first['Country'] ?? '') . '</p>
            <p class="content-text"><b>Postcode:</b> ' . htmlspecialchars($user_first['PostCode'] ?? '') . '</p>
        </td>
    </tr>
</table>';

$pdf->writeHTML($html, true, false, true, false, '');

if (isset($_GET['action']) && $_GET['action'] === 'download') {
    $pdf->Output('cv.pdf', 'D');
} else {
    $pdf->Output('cv.pdf', 'I');
}
?>
