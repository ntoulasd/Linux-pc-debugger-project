    <head>

    <title>Linux pc debugger</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
    body {
    background:url("mockupg.png") no-repeat  transparent;
    background-position: center -100;
    filter:alpha(opacity=90);-moz-opacity:.9;opacity:.9;
    }
    div.ex
    {
    padding:10px;
    border:2px solid gray;
    margin:150px 400px;
    background: #eeeeee ;
    }
    a:link, a:visited
    {
      margin: 2px 2px 2px 2px;
      border-top: 1px solid #aaaaaa;
      border-bottom: 2px solid black;
      border-left: 1px solid #aaaaaa;
      border-right: 2px solid black;
      background: #cccccc;
      text-align: center;
      text-decoration: none;
      font: normal 16px Verdana;
      color: black;
    }
    a:hover
    {
      background: #eeeeee;
    }
    </style>

    </head>
    <body>
    <div class="ex">
    <?php
    if ($_GET['question'])
    {
$question = htmlEntities($_GET['question'], ENT_QUOTES);

if (!empty($question) && !preg_match('/^[\d\.]+$/', $question)) {
    exit("Λάθος ερώτηση !\n");
           
       echo "Ερώτηση: ".substr($question,0,-1)."<br><br>";  
    }
        else
         {
           
       echo "Επέλεξε κατηγορία<br><br>";     
    }
    $con = mysql_connect("localhost","username","password");
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    mysql_set_charset('utf8',$con);
    mysql_select_db("debuger", $con);

    $result = mysql_query("SELECT * FROM data where data.id LIKE '".$question."_'");
    $num_rows = mysql_num_rows($result);

    $result2 = mysql_query("SELECT * FROM data where data.id LIKE '".$question."%'");
    $num_rows2 = mysql_num_rows($result2);
    #echo $num_rows2;
    switch ($num_rows2) {
    case 0:
    ?>
    <b>Δεν υπάρχει ακόμα απάντηση στην ερώτησή σας</b><br><br>
    Μπορείτε να ανατρέξετε στο <a href="http://forum.ubuntu-gr.org" target="_blank" >forum.ubuntu-gr.org</a>
    και να αναζητήσετε το πρόβλημά σας εκεί. <br>
    Αν δεν βρείτε κάτι σχετικό, μπορείτε να ανοίξετε ένα θέμα στην αντίστοιχη ενότητα.<br>
    Καλό είναι να δίνετε και τα αποτελέσματα των εντολών που θα τρέξετε σε κονσόλα.<br><br>
    Για κάρτες ασύρματης δικτύωσης.<br>
    ifconfig<br>
    iwlist<br>
    sudo iwlist scan<br>
    και<br>
    lsusb<br>
    ή<br>
    lspci -nn<br>
    αναλόγως αν είναι usb ή εσωτερική<br><br>

    Για άλλες συσκευές<br>
    dmesg<br>
    και<br>
    lsusb<br>
    ή<br>
    lspci -nn<br>
    αναλόγως αν είναι usb ή εσωτερική<br><br>

    <b>ΣΗΜΑΝΤΙΚΟ</b><br>
    Τα αποτελέσματα των εντολών να τα βάλετε μέσα σε code.<br>
    [code]αποτελέσματα[/code]<br>

    <?php
    break;
    case 1:
    echo "<b>Απάντηση</b><br><br>";
    $row = mysql_fetch_array($result);
    echo $row['text'];
    echo "<br><br>";
    break;
    default:
    while($row = mysql_fetch_array($result))
      {
      echo '<a href="index.php?question='.$row['id'].'.">'.$row['id'] . '</a> ' . $row['text'];
      echo "<br><br>";
      }
    }

    mysql_close($con);
    echo "<br><br>";
    ?>

    <a href="index.php">Αρχική</a> <a href='index.php?question=<?php echo substr($question,0,-2); ?>'>Πίσω</a>
    <br><br>
    Linux PC Debugger Version 0.5 2010-2015 GPL Δ. Ντούλας
    </div>

    </body>
