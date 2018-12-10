<?php
    if(isset($_POST["done"]))
    {
        
        $m=htmlspecialchars($_POST["m"]);
        $_POST["m"]=$m;
        session_start();
        $error_m="";
        $error=false;
        if(strlen($m)==0)
        {
            $n=6;
            $_POST["m"]=$m;
            
        }
         else if($m==""||!is_numeric($m)||$m<=1||$m>=100)
        {
            
            $error_m="<i>Enter right number of rows and columns</i>";
            $error="true";
            
        }
        else
        {
            $conn= mysqli_connect('localhost','root','');
            $query = "INSERT INTO table1 (Data) VALUES (".(int)$_POST["m"].")";
            mysqli_query($conn, $query);
        }
        if($error)
        {
            $conn= mysqli_connect('localhost','root','');
            $query = "INSERT INTO table2 (Data) VALUES (".$_POST["m"].")";
            
            mysqli_query($conn, $query);
            
        }
    }
    else
    {
        $m=6;
        $_POST["m"]=$m;
        $error_m="";
        $error=false;
    }
?>
<!DOCTYPE HTML>
<html>
    <head> 
        <meta charset="utf-8"/>
        <title>Lab №4</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <p><i>Done by Oleg Vasyliev IS-72</i></p>
        <h1><b1><center><i>Lab  №4</i></center></b1></h1>
        <center>
            <form  action="" name="form" method="post">
                <label>Enter right number of rows and columns: </label><br/>
                <input  type="text" name="m" value="<?=$_POST["m"]?>"/><br/>
                <span style="color:red"><?=$error_m?></span><br/>
                <input type="submit" name="done" value="Готово"/><br/>
            </form>
            <br/>
            <br/>
 <?php
    if(!$error)
        {
            $table1="<center><p><i>1.Table</i></p></center>";
            echo $table1;
            echo '<table>';
            $iter=0;
            for($tr=0;$tr<$m;$tr++)
            {
                echo '<tr>';
                if($tr>0)
                {
                    echo '<td rowspan="'.($m-$tr).'">';
                    if($iter%4==0)
                {
                    echo "Fourth sector";
                }
                }
                $iter++;
                echo '</td>';
                echo '<td colspan="'.($m-$tr).'"></td>';
                $iter++;
                echo '</tr>';
            }
        echo '</table>';
        $table2="<center><p><i>2.Table</i></p></center>";
        $iter=1;
        echo $table2;
        echo '<table>';
            for($tr=0;$tr<$m;$tr++)
            {
                echo '<tr>';
                echo '<td rowspan="'.($m-$tr).'"></td>';
                $iter++;
                if($tr!=$m-1)
                {
                    echo '<td colspan="'.($m-$tr).'">';
                        if($iter%4==0)
                    {
                        echo "Fourth sector";
                    }
                }
                $iter++;
                echo '</td>';
                echo '</tr>';
            }
        echo '</table>';
        $table3="<center><p><i>3.Table</i></p></center>";
        echo $table3;
        $iter=1;
        echo "<table>";
        for($i=0;$i<$m;$i++)
        {
            echo '<col width="100px">';
        }
        $residual=$m;
        for($i=0;$i<$m;$i++)
        {
            echo "<tr>";
            $j=0;
            while($residual>0)
            {
                if($residual>=2)
                {
                    echo '<td colspan="2">';
                    $j+=2;
                }
                else
                {
                    echo '<td colspan="'.$residual.'">';
                    if($j==0)
                    {
                        $j+=$residual;
                    }
                    else
                    {
                        $j+=2;
                    }
                }
                if($iter%4==0)
                {
                    echo "Fourth sector";
                }
                echo "</td>";
                $iter++;
                $residual=$m-$j;
            }
            echo "</tr>";
            $residual=0-$residual;
            if($residual==0)
            {
                $residual=2;
            }
        }
        echo "</table>";
        
        $table4="<center><p><i>4.Table</i></p></center>";
            echo $table4;
            $column_fill=[3,0,0];
			$counter=1;
			$remainder = $m >= 3 ? 3: $n;
            echo "<table>";
			if ($m%3==0 && $m > 3)
			{
				for ($i = 0; $i < $m/3; $i++) 
				{
					echo '<tr style="height:'.(28*($m/3)).'px">';
					for ($j=0; $j < $m; $j++)
					{
						echo '<td>';
						if ($counter % 4 == 0) {
							echo 'Fourth sector';
						}
						$counter++;
						echo '</td>';
					}
					echo '</tr>';
				}
			}
			else 
			{
				echo '<tr style="height: 28px">';
				echo '<td rowspan="'.($m >= 3 ? 3: $m).'">';
				$counter++;
				for ($i = 0; $i < $m - 1; $i++)
				{
					if (0 < $i && $i < 3) 
					{
						$column_fill[$remainder] = $i + 1;
					}
					$fullness = $remainder;
					while ($fullness < $m - 3) {
						$fullness = $fullness + 3;
					}
					$remainder = 3 - ($m - $fullness);
					if ($remainder == 0) {
						$remainder = 3;
					}
					echo '<td rowspan="'.$remainder.'">';
					if ($counter % 4 == 0) {
							echo 'Fourth sector';
						}
					echo '</td>';
					$counter++;
				}
				echo '</tr>';
				if ($m > 3) 
				{
					$start_col = $column_fill[1];
					$curr_col = 3;
					$sequence = [$start_col, 5-$start_col, 1]; 
					for ($i = 1; $i < $m; $i++)
					{
						$curr_col=$sequence[$i>3?($i%3):$i-1];
						echo '<tr style="height: 28px">';
						for ($j=$curr_col; $j<=$m; $j=$j+3)
						{
							echo '<td rowspan="'.($m - $i >= 3 ? 3: $m - $i).'">';
							if ($counter % 4 == 0) {
								echo 'Fourth sector';
							}
							echo '</td>';
							$counter++;
						}
						echo '</tr>';
					}	
				}
			}
            echo "</table>";
    }
?>
        </center>
    </body>
</html>