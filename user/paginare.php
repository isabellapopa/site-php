<?php
?>
<!DOCTYPE html >
    <html lang="en">
<head>
    <title>    </title>

    <script type="text/javascript">

        function ajaxFunction(val)
        {
            var httpxml;
            try{
                httpxml=new ActiveXObject("Maxml2.XMLHTTP");


            }catch(e){
                try{
                    httpxml=new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){
                    alert("Your browser does not suport Ajaxx!");
                    return false;
                }
            }
        }
        function stateChanged()
        {
            if(httpxml.readyState ==4)
            var myObject = JSON.parse(httpxml.responseText);
            var str="<table><tr><th> Stire </th>";

            for(i=0;i<myObject.data.length;i++) {
                str = str + "<tr><td>" + myObject.data[i].stire + "</td></tr>";
                var endrecord = myObject.value.endrecordmyForm.end_record.value = endrecord;
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

        var url="vizualizareStiri.php";
        var myendrecord=myForm.end_record.value;
        url = url + "?endrecord=" + myendrecord;
        url = url + "&direction="  + val;
        url = url + "&sid=" + Math.random();


        httpxml.onreadystatechange = stateChanged();
        httpxml.open("GET",url,true);
        document.getElementById("txtHint"):innerHTML = "Please Wait ....";

    </script>

</head>

<body onload="ajaxFunction('fw');">
<form name="myForm" onsubmit="ajaxFunction(this.form); return false">
<input name="end_record">

