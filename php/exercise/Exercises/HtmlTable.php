<form>
    Name: <input type="text" name="name"/> <br/>
    Phone Number: <input type="text" name="phone"/><br/>
    Age: <input type="text" name="age"/><br/>
    Address: <input type="text" name="address"/><br/>

    <input type="submit" value="Submit"/>

</form>

<?php

if (isset($_GET['name']) && isset($_GET['phone'])
    && isset($_GET['age']) && isset($_GET['address'])) {

    $result = [];

    $name = htmlspecialchars($_GET['name']);
    $phone = htmlspecialchars($_GET['phone']);
    $age = htmlspecialchars($_GET['age']);
    $address = htmlspecialchars($_GET['address']);

    echo "<table border='2'>";

    $key = "";
    $value = "";

    for ($i = 1; $i <= 4; $i++) {
        switch ($i) {
            case "1":
                $key = "Name";
                $value = $name;
                break;
            case "2":
                $key = "Phone number";
                $value = $phone;
                break;
            case "3":
                $key = "Age";
                $value = $age;
                break;
            case "4":
                $key = "Address";
                $value = $address;
                break;
        }
        echo "<tr><td style='background-color: orange'>$key</td><td>$value</td></tr>";
    }

    echo "</table>";
}


