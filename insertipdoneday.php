<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <style>

        #tabledata{
            position:float;
        }
       </style>
    </head>

    <body>
      
           date to opd <input type="date" id="today"  ><br>

        <button onclick="fun()" id="btninsert">insert</button>
        <button id="btnreport">See Report</button>

           <form method="post" action="insertanddischarge.php">
           <input type="text" name="oodate" id="oodate" maxlength="15" size="20" readonly="readonly" />
			<input  name="odate" id="odate" />
            <br>

         12--18   Kaychikista  <input type="text" placeholder="kaychikista" name="kaychikista"><br>
         4--6  kumarbhartiya <input type="text" placeholder="kumarbhartiya" name="kumarbhartiya"><br>
         8-12   shalyantra  <input type="text" placeholder="shalyntantra" name="shalyantra"><br>
         4--6 shaylakyatanra  <input type="text" placeholder="shaylakyatanra" name="shaylakyntra"></br>
          8--12 strironga  <input type="text" placeholder="striroga" name="srironga"></br>
          4--6 panchkarma  <input type="text" placeholder="panchakarna" name="panchakarma"></br>
          casuality <input type="text" placeholder="casulity" name="casulity"><br>
          Swasthvritta<input type="text" placeholder="Swasthvritta" name="Swasthvritta"><br>



         <h5>Discharge</h5> <input type="text" placeholder="How many dicharge" name="discharge" width="20px">
          <button name="btnsubmit" type="submit" value="submit">insert</button>
     </form>
     <div id="tabledata">

     </div>
<script>
    function fun()
    {var tda=document.getElementById("today").value;
    var tdafor1=new Date(tda);
    tda=tdafor1.getFullYear()+"-"+(tdafor1.getMonth()+1)+"-"+tdafor1.getDate();
    tda2=tdafor1.getDate()+"-"+(tdafor1.getMonth()+1)+"-"+tdafor1.getFullYear();
     document.getElementById("odate").value=tda;
     document.getElementById("oodate").value=tda2;
    }

    
$(document).ready(function(){

    var date2=document.getElementById("oodate").value;
                        $.ajax({
                                        url:"Ajax_countdepartment.php",
                                        type:"post",
                                        data:{mydate:date2},
                                        success:function(data){
                                            $("#tabledata").html(data);
                                        }
                                });


          
    $("#btnreport").on("click",function(e){
                       

                    var date2=document.getElementById("oodate").value;
                        $.ajax({
                                        url:"Ajax_countdepartment.php",
                                        type:"post",
                                        data:{mydate:date2},
                                        success:function(data){
                                            $("#tabledata").html(data);
                                        }
                                });






                    });
          
          
          
          
                      
});

</script>


    </body>

</html>