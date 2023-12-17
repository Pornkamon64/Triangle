<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    checkTriangle();
}

function checkTriangle() {
    $Sa = floatval($_POST["Sa"]);
    $Sb = floatval($_POST["Sb"]);
    $Sc = floatval($_POST["Sc"]);

    if (isValidInputRange($Sa) && isValidInputRange($Sb) && isValidInputRange($Sc)) {
        if (isValidTriangle($Sa, $Sb, $Sc)) {
            $triangleType = getTriangleType($Sa, $Sb, $Sc);
            echo "ประเภทของสามเหลี่ยมคือ << " . $triangleType . " >>";
            echo "<div id='error'></div>";
        } else {
            echo "";
            echo "Not a Triangle";
        }
    } else {
        echo "";
        echo "การตรวจสอบรับค่าแค่ 0.00 - 100.00 เท่านั้น กรุณากรอกใหม่อีกครั้ง";
    }
}

function isValidInputRange($value) {
    return !is_nan($value) && $value >= 0.00 && $value <= 100.00;
}

function isValidTriangle($a, $b, $c) {
    return $a + $b > $c && $b + $c > $a && $c + $a > $b;
}

function getTriangleType($a, $b, $c) {
    if (isValidTriangle($a, $b, $c)) {
        if ($a === $b && $b === $c) {
            return "Equilateral Triangle";
        } elseif ($a === $b || $b === $c || $c === $a) {
            return "Isosceles Triangle";
        } elseif (isRightTriangle($a, $b, $c)) {
            return "Right Triangle";
        } elseif($a !== $b && $b !== $c && $c !== $a){
            return "Scalene Triangle";
        }
    }
}

function isRightTriangle($a, $b, $c) {
    $sides = [$a, $b, $c];
    sort($sides);
    return pow($sides[0], 2) + pow($sides[1], 2) === pow($sides[2], 2);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types of triangles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #FFA500, #FFFFFF);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: white;
            padding: 10px;
            margin-top: 70px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007bff;
        }

        #result, #error {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgb(255, 220, 168);
            text-align: center;
            padding: 10px;
            margin: 10px;
        }

    </style>
</head>
<body>
<form method="post" action="">
    <h3>โปรแกรมตรวจสอบชนิดสามเหลี่ยม</h3>
    <p>รับค่าตั้งแต่ 0.00 - 100.00 เท่านั้น</p>
    <p>เงื่อนไขที่จะตรวจสอบได้คือสองด้านใดๆก็ตามรวมกันต้องมากกว่าด้านที่เหลือเท่านั้น</p>
    <table style="width: 100%;">
        <tr>
            <td><label for="Sa">กรอกค่าสำหรับด้านที่ 1:</label></td>
            <td><input type="number" name="Sa" id="Sa" required></td>
        </tr>
        <tr>
            <td><label for="Sb">กรอกค่าสำหรับด้านที่ 2:</label></td>
            <td><input type="number" name="Sb" id="Sb" required></td>
        </tr>
        <tr>
            <td><label for="Sc">กรอกค่าสำหรับด้านที่ 3:</label></td>
            <td><input type="number" name="Sc" id="Sc" required></td>
        </tr>
    </table>
    <br><br>
    <button type="submit" class="btn btn-info">ตรวจสอบ</button>
</form>

<?php
function checkTriangle() {
    $Sa = isset($_POST["Sa"]) ? floatval($_POST["Sa"]) : 0.0;
    $Sb = isset($_POST["Sb"]) ? floatval($_POST["Sb"]) : 0.0;
    $Sc = isset($_POST["Sc"]) ? floatval($_POST["Sc"]) : 0.0;

    if (isValidInputRange($Sa) && isValidInputRange($Sb) && isValidInputRange($Sc)) {
        if (isValidTriangle($Sa, $Sb, $Sc)) {
            $triangleType = getTriangleType($Sa, $Sb, $Sc);
            echo "ประเภทของสามเหลี่ยมคือ << $triangleType >>";
        } else {
            echo "Not a Triangle";
        }
    } else {
        echo "การตรวจสอบรับค่าแค่ 0.00 - 100.00 เท่านั้น กรุณากรอกใหม่อีกครั้ง";
    }
}

function isValidInputRange($value) {
    return is_numeric($value) && $value >= 0.00 && $value <= 100.00;
}

function isValidTriangle($a, $b, $c) {
    return $a + $b > $c && $b + $c > $a && $c + $a > $b;
}

function getTriangleType($a, $b, $c) {
    if (isValidTriangle($a, $b, $c)) {
        if ($a === $b && $b === $c) {
            return "Equilateral Triangle";
        } elseif ($a === $b || $b === $c || $c === $a) {
            return "Isosceles Triangle";
        } elseif (isRightTriangle($a, $b, $c)) {
            return "Right Triangle";
        } elseif ($a !== $b && $b !== $c && $c !== $a) {
            return "Scalene Triangle";
        }
    }
}

function isRightTriangle($a, $b, $c) {
    $sides = [$a, $b, $c];
    sort($sides);
    return pow($sides[0], 2) + pow($sides[1], 2) === pow($sides[2], 2);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    checkTriangle();
}
?>




<footer>
    <div id="result-container">
        <p id="result"></p>
        <p id="error"></p>
    </div>
</footer>


</body>
</html>
