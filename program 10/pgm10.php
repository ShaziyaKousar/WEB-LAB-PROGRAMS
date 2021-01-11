<html>

<body>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            width: 33%;
            text-align: center;
            border-collapse: collapse;
            background-color: lightblue;
        }

        table {
            margin: auto;
        }

    </style>
    <?php
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web";
    
        $a=[];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        if (!$conn)
        die("Connection failed: " . $conn->connect_error);
    
    
        $crt="create table student1(usn varchar(20),name varchar(20),address varchar(20))";
        $result0= mysqli_query($conn,$crt);
    
        
    
        $crt1="INSERT INTO `student1`(`usn`, `name`, `address`) VALUES ('1CE17CS115','SHAZIYA','Kumarswamy Layout')";
        $crt2="INSERT INTO `student1`(`usn`, `name`, `address`) VALUES ('1CE17CS152','SANA','JP Nagar')";
        $crt3="INSERT INTO `student1`(`usn`, `name`, `address`) VALUES ('1CE17CS151','KAVYA','Austin Town')";
        $crt4="INSERT INTO `student1`(`usn`, `name`, `address`) VALUES ('1CE17CS150','RAJA','BTM Layout')";
    
        $result1= mysqli_query($conn,$crt1);
        $result2= mysqli_query($conn,$crt2);
        $result3= mysqli_query($conn,$crt3);
        $result4= mysqli_query($conn,$crt4);
    
        
        
    
        

        $sql = "SELECT * FROM student1";

    
        $result = mysqli_query($conn,$sql); 
    
        echo "<br>";
        echo "<center> BEFORE SORTING </center>"; echo "<table border='2'>";
        echo "<tr>";
        echo "<th>USN</th><th>NAME</th><th>Address</th></tr>";
    
        if ($result->num_rows> 0)
        {
            while($row = $result->fetch_assoc())
            { 
                echo "<tr>";
                echo "<td>". $row["usn"]."</td>";
                echo "<td>". $row["name"]."</td>"; 
                echo "<td>". $row["address"]."</td></tr>"; 
                array_push($a,$row["usn"]);
            }
        }
        else
            echo "Table is Empty"; 
            echo "</table>";
    
        $n=count($a);
        $b=$a;
    
        for($i=0;$i<($n-1);$i++)
        {
            $pos= $i;
            for ( $j = $i + 1 ; $j < $n ; $j++ )
            { 
                if ( $a[$pos] > $a[$j] )
                    $pos= $j;
            }
            if ( $pos!= $i )
            {
                $temp=$a[$i];
                $a[$i] = $a[$pos];
                $a[$pos] = $temp;
            }
        }
        $c=[];
        $d=[];
        $result = $conn->query($sql);
    
        if ($result->num_rows> 0)
        {
            while($row = $result->fetch_assoc()) 
            { 
                for($i=0;$i<$n;$i++) 
                {
                    if($row["usn"]== $a[$i]) 
                    {
                        $c[$i]=$row["name"];
                        $d[$i]=$row["address"];
                    }
                }
            }
        }
        echo "<br>";
        echo "<center> AFTER SORTING <center>"; 
        echo "<table border='2'>";
        echo "<tr>";
        echo "<th>USN</th><th>NAME</th><th>Address</th></tr>";
    
        for($i=0;$i<$n;$i++) 
        {
            echo "<tr>";
            echo "<td>". $a[$i]."</td>";
            echo "<td>". $c[$i]."</td>";
            echo "<td>". $d[$i]."</td></tr>";
        }
        echo "</table>";
        $conn->close();
?>
</body>

</html>