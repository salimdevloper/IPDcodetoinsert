<html>
    <head>
    </head>

    <body>
      
           date to opd <input type="date" id="today"  ><br>

        <button onclick="fun()">insert</button>

           <form method="post" action="insertipdoneday2.php">
           <input type="text" name="oodate" id="oodate" maxlength="15" size="20" readonly="readonly" />
			<input  name="odate" id="odate" />
            <br>

          Kaychikista  <input type="text" placeholder="kaychikista" name="kaychikista"><br>
          kumarbhartiya <input type="text" placeholder="kumarbhartiya" name="kumarbhartiya"><br>
          shalyantra  <input type="text" placeholder="shalyntantra" name="shalyantra"><br>
          shaylakyatanra  <input type="text" placeholder="shaylakyatanra" name="shaylakyntra"></br>
          strironga  <input type="text" placeholder="striroga" name="srironga"></br>
          panchkarma  <input type="text" placeholder="panchakarna" name="panchakarma"></br>
          casuality <input type="text" placeholder="casulity" name="casulity"><br>
          Swasthvritta<input type="text" placeholder="Swasthvritta" name="Swasthvritta"><br>
          <button name="btnsubmit" type="submit" value="submit">insert</button>
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