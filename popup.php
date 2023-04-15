<?php
    include('includes/config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <button type="submit" class="btn" onclick="openPopup()">Submit</button>
    <div class="popup" id="popup">
        <img src="images/18-age-restriction-sign-vector-21316856.jpg">
        <h2>This Content is Age Restricted</h2><br>
        <h3>Viewers who are 18 years of age or above are only allowed to view the content.</h3>
        <button type="submit" onclick="closePopup()"><a href=""></a> Ok</button>
    </div>
    </div>
<script>
    let popup = document.getElementById("popup");

    function openPopup() {
        popup.classList.add("open-popup");
    }
    function closePopup() {
        popup.classList.remove("open-popup")
    }
</script>
</body>
</html>