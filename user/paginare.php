

<!DOCTYPE html >
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Autentificare - New Magazine </title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/business-casual.css" rel="stylesheet">

</head>

<>

<div class="brand">News Magazine</div>
<div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.php">New Magazine</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Acasa</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="container">
    <div class ="box">
    <script type="text/javascript">

        function ajaxFunction(val) {

            var httpxml;
            var endrecord = document.getElementsByName('end_record')[0].value;
            try {
                httpxml = new XMLHttpRequest();

            } catch (e) {
                try {
                    httpxml = new ActiveXObject("Maxml2.XMLHTTP");

                } catch (e) {
                    try {
                        httpxml = new ActiveXObject("Microsoft.XMLHTTP");


                    }
                    catch (e) {
                        alert("Your browser does not suport Ajax!");
                        return false;
                    }
                }
            }
            function stateChanged() {
                if (httpxml.readyState == 4) {
                    var myObject = JSON.parse(httpxml.responseText);
                    var str = "<table><tr><th> Stire </th></tr>";

                    for (i = 0; i < myObject.data.length; i++) {
                        str = str + "<tr><td>" + myObject.data[i].stire + "</td></tr>";
                    }

                    var elemEndRecord = document.getElementsByName('end_record')[0];
                    console.log(myObject.value);
                    elemEndRecord.value = parseInt(myObject.value.endrecord) + 1;



                    if (myObject.value.end == "yes") {
                        document.getElementById("fwd").style.display = 'inline';
                    }
                    else {
                        document.getElementById("fwd").style.display = 'none';
                    }

                    if (myObject.value.startrecord == "yes") {
                        document.getElementById("back").style.display = 'inline';
                    }
                    else {
                        document.getElementById("back").style.display = 'none';
                    }
                    str = str + "</table>";
                    document.getElementById("txtHint").innerHTML = str;

                }


            }

            var url = "vizualizareStiri.php";
            //var myendrecord = myForm.end_record.value;
            // var myendrecord = document.forms["myForm"]["end_record"].value;
            //var endrecord = document.getElementsByName('end_record')[0].value;
            url = url + "?endrecord=" + endrecord;
            url = url + "&direction=" + val;
            url = url + "&sid=" + Math.random();


            httpxml.onreadystatechange = stateChanged;
            httpxml.open("GET", url, true);
            httpxml.send(null);
            document.getElementById("txtHint").innerHTML = "Please Wait ....";
        }
    </script>


<body onload="ajaxFunction('fw');">
<form name="myForm" onsubmit = "ajaxFunction(this.form); return false">
    <input name="end_record" type="hidden" value="0">
    <table>
        <tr>
            <td colspan="2">
                <div id="txtHint">
                    <b>Record will be displayed here </b> </div>
            </td>
        </tr>
        <tr>
            <td> <input id="back" onclick="ajaxFunction('bk'); return false" type="button" value="Prev"></td>
            <td> <input id="fwd" onclick="ajaxFunction('fw'); return false" type="button" value="Next"> </td>
        </tr>
    </table>
</form>
    </div>
</div>

</body>
</html>




