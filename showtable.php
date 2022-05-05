<?php
$k = $_POST['id'];
$k = trim($k);
$conn = mysqli_connect("localhost", "root", "", "suball");
$sql = "SELECT * from subjects where regulation = '{$k}'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0){
while ($rows = mysqli_fetch_array($res)) {
?>
    <tr>
        <td><?php echo $rows['sno']; ?></td>
        <td><?php echo $rows['regulation']; ?></td>
        <td><?php echo $rows['semester']; ?></td>
        <td><?php echo $rows['department']; ?></td>
        <td><?php echo $rows['coursecode']; ?></td>
        <td><?php echo $rows['coursetitle']; ?></td>
        <td><?php echo $rows['contactperiods']; ?></td>
        <td><?php echo $rows['category']; ?></td>
        <td><?php echo $rows['lectures']; ?></td>
        <td><?php echo $rows['tutorials']; ?></td>
        <td><?php echo $rows['practicals']; ?></td>
        <td><?php echo $rows['credits']; ?></td>
        <td><button type="button" class="btn btn-primary editbutton">Update</button>
            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $sno . '" class="text-light">Delete</a></button>
        </td>
    </tr>
<?php
}
}
else {
    $sql = "SELECT * from subjects";
    $res = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_array($res)) {
?>
    <tr>
        <td><?php echo $rows['sno']; ?></td>
        <td><?php echo $rows['regulation']; ?></td>
        <td><?php echo $rows['semester']; ?></td>
        <td><?php echo $rows['department']; ?></td>
        <td><?php echo $rows['coursecode']; ?></td>
        <td><?php echo $rows['coursetitle']; ?></td>
        <td><?php echo $rows['contactperiods']; ?></td>
        <td><?php echo $rows['category']; ?></td>
        <td><?php echo $rows['lectures']; ?></td>
        <td><?php echo $rows['tutorials']; ?></td>
        <td><?php echo $rows['practicals']; ?></td>
        <td><?php echo $rows['credits']; ?></td>
        <td><button type="button" class="btn btn-primary editbutton">Update</button>
            <button type="button" class="btn btn-danger"><a href="delete.php?deleteid=' . $sno . '" class="text-light">Delete</a></button>
        </td>
    </tr>
<?php
}
}
echo $sql;
?>