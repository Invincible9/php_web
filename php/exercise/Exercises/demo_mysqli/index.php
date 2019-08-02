

<?php

include("connect-db.php");
include("header.php");

$result = $mysqli
    ->query("SELECT * FROM posts ORDER BY date DESC");

echo "<table border='2'>";
echo "<tr><th>Title</th><th>Content</th><th>Date</th>
<th>EDIT</th>
<th>DELETE</th></tr>";
while ($stm = $result->fetch_assoc()){
    $title = htmlspecialchars($stm['title']);
    $content = htmlspecialchars($stm['content']);
    $date = $stm['date'];

    $id = $stm['post_id'];

    echo "<tr><td>$title</td>
        <td>$content</td>
        <td>$date</td>
        <td><a href='edit.php?id=$id'>EDIT</a></td>
        <td><a href='delete.php?id=$id'>DELETE</a></td>
        </tr>";

}

echo "</table>";