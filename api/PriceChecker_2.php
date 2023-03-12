<html>
<head>
<title>Test Php</title>
<style type = "text/css">
    *{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background: rgba( 71, 147, 227, 1);
}
h2{
    text-align: center;
    font-size: 38px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

.text-center {
  text-align: center;
}

button{
    background-color: #ff8c00;
    font-size: 20px;
    border-radius: 4px;
    padding: 14px 40px;
    transition-duration: 0.4s;
}

button:hover{
     background-color: orange;
     box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #4FC3A1;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}
</style>
</head>
<body>

<?

$Search_Term = $_POST['Search_Term'];
$Search_Term2 = str_replace(" ", "", $Search_Term);

if (!$Search_Term){
    echo "Search term not found, please try again.";
    exit;
}



// connect to the db

@ $db = new mysqli("testdatabase.c6qpu4laltjr.us-east-2.rds.amazonaws.com","admin","testPass!","blah");

if (!$db)
{
	echo "ERROR: Could not connect to database.  Please try again later.";
	exit;
}

$result_1 = $db->query("use blah");

if (function_exists($db->query("select * from ".$Search_Term2.""))) 
{
    echo "Found something in the databse in the database.<br />\n";
} 
else
{
    echo "Found nothing in the database";
}

	
#$result_2 = $db->query("select * from ".$Search_Term2.""); #<---Throws an error here and doesn't proceed with the code after
#$row_ct_2 = $result_2->num_rows; 
	
	

if ($row_ct_2 > 0)
{
    echo "<h2>$row_ct_2 Results Found:</h2>";
    echo "<div class='text-center'><a href='https://csci440pricechecker.vercel.app/index.html'><button>Homepage</button></a></div>"; 
    echo "<div class='table-wrapper'>";
        echo "<table class='fl-table'>";
    echo "<tr>
             <th>ID Number</th>
             <th>Price</th>
             <th>Rating</th>
             <th>Description</th>
             <th>URL</th>
        </tr>";
    while($row = $result_2->fetch_assoc())
        echo "<tr> 
              <td>".$row["id"]."</td> 
              <td>".$row["price"]."</td> 
              <td>".$row["rating"]."</td>
              <td>".$row["description"]."</td> 
              <td><a target = '_blank' href=".$row["url"].">Click here to view product</a></td>      
          </tr>";
        echo "</table>";
    echo "</div>";
   

}

#else
#{
	#echo "This redirection is not working";
	#readfile('https://csci440pricechecker.vercel.app/errorpage/pagenotfound.html');
   # exit;
#}
#echo "<br>";


 




?>

</body>
</html>
