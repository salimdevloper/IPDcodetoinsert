<html>
    <head>
</head>
<body>


date of move data <input type="date" id="today"  ><br>

<button onclick="fun()" id="btninsert">insert</button>


   <form method="post" action="moveonedaydata2.php">
        <input type="text" name="oodate" id="oodate" maxlength="15" size="20" readonly="readonly" />
        <input  name="odate" id="odate" />




        <input type="submit" value="submit">
</form>

<script>

function fun()
    {var tda=document.getElementById("today").value;
    var tdafor1=new Date(tda);
    tda=tdafor1.getFullYear()+"-"+(tdafor1.getMonth()+1)+"-"+tdafor1.getDate();
    tda2=tdafor1.getDate()+"-"+(tdafor1.getMonth()+1)+"-"+tdafor1.getFullYear();
     document.getElementById("odate").value=tda;
     document.getElementById("oodate").value=tda2;
    }

    </script>
</body>

</html>