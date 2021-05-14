<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="main">
    <div class="bottom">
        <h3><?= "ERROR:: " . $error?></h3>
    </div>

    <form action="" method="get">
        <input type="hidden" name="controller" value="league">
        <input type="hidden" name="method" value="startNewLeague">
        <input type="submit" value="Try start new One" />
    </form>

</div>
<script src="js/jquery-lib.js"></script>
</body>
</html>