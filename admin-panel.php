<?php
$dbPath = 'sqlite:./ctf.db';

try {
    $db = new PDO($dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM contact";
    $result = $db->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <title> Admin panel</title>
    </head>

    <body>
        <div class="header-background">
            <nav class="top-menu">
                <div class="top-menu-icon">
                    <img src="/img/logo-blue-name.svg" alt="">
                </div>
                <a href="index.html" class="menu-item">Home</a>
                <a href="index.html" class="menu-item">Services</a>
                <a href="#about" class="menu-item">About Us</a>
                <a href="#index.html" class="menu-item">Contact</a>
                <a href="blog.html" class="menu-item">Blog</a>
                <a href="faq.html" class="menu-item">FAQs</a>

            </nav>
            <div class="header-title">
                <h1> Admin panel</h1>
            </div>
        </div>

        <div class=main>
            <div class="contact-table">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Tiitle</th>
                        <th>Message</th>
                    </tr>
                    <?php
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['subject'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$db = null;
?>
        </div>
    </div>


    </div>
    <footer class="footer">
        <div class="footer-section">
            <img src="img/logo-white-name.svg" alt="">
            <p>We help small, medium, and large entrepreneurs</p>
            <p>We will become the leading consulting firm in Europe.</p>
            <p>Tkalčićeva 5, Zagreb</p>
            <div class="icons"> <i class="fa fa-facebook-official"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-linkedin-square"></i>
            </div>


        </div>
        <div class="footer-section">
            <h3>Services</h3>
            <a>Analysis</a>
            <a>Analysis + plan</a>
            <a>Premium guiding</a>
        </div>
        <div class="footer-section">
            <h3>Fast menu</h3>
            <a>Home</a>
            <a>Services</a>
            <a>About Us</a>
            <a>Contact</a>
            <a>Blog</a>
            <a>FAQ's</a>
        </div>
        <div class="footer-section">
            <h3>Contact:</h3>
            <p>info@easterncnc.com</p>
            <p>044 564 444</p>
        </div>
    </footer>
</body>

<style>
    .header-background {
        background-image: linear-gradient(to bottom, rgba(0, 91, 170, 0.5), rgba(2, 37, 68, 0.5)), url('/img/head_index.svg');
        background-size: 100% auto;
        background-repeat: no-repeat;
        background-position: top center;
        width: 100vw;
        height: auto;
        min-height: 60vh;
        color: white;
        font-size: x-large;

    }

    .header-title {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    body {

        background: linear-gradient(to bottom, #005BAA, #022544);
    }

    .contact-table>table {
        margin: 0 auto;
        border-collapse: collapse;
        border: 2px solid white;
    }

    .contact-table td, .contact-table th {
    border: 1px solid white;
    text-align: center;
    padding: 8px;
    color: white;
}

</style>