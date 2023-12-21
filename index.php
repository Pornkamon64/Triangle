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
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            min-height: 100vh; /* Ensure the entire viewport height is covered */
        }

        form {
            background-color: white;
            padding: 20px; /* Increased padding for better appearance */
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
                <td><input type="text" pattern="[0-9]*(\.[0-9]+)?" name="Sa" id="Sa" required></td>

            </tr>
            <tr>
                <td><label for="Sb">กรอกค่าสำหรับด้านที่ 2:</label></td>
                <td><input type="text" pattern="[0-9]*(\.[0-9]+)?" name="Sb" id="Sb" required></td>

            </tr>
            <tr>
                <td><label for="Sc">กรอกค่าสำหรับด้านที่ 3:</label></td>
                <td><input type="text" pattern="[0-9]*(\.[0-9]+)?" name="Sc" id="Sc" required></td>

            </tr>
        </table>

        <br><br>
        <button type="submit" class="btn btn-info">ตรวจสอบ</button>
    </form>

    <footer>
        <div id="result-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                checkTriangle();
            }

            function checkTriangle() {
                $Sa = isset($_POST["Sa"]) ? (floatval($_POST["Sa"])) : 0.0;
                $Sb = isset($_POST["Sb"]) ? (floatval($_POST["Sb"])) : 0.0;
                $Sc = isset($_POST["Sc"]) ? (floatval($_POST["Sc"])) : 0.0;


                if (isValidInputRange($Sa) && isValidInputRange($Sb) && isValidInputRange($Sc)) {
                    if (isValidTriangle($Sa, $Sb, $Sc)) {
                        $triangleType = getTriangleType($Sa, $Sb, $Sc);
                        echo "<p id='result'>ประเภทของสามเหลี่ยมคือ: $triangleType</p>";

                    } else {
                        echo "<p id='error'>ไม่ใช่สามเหลี่ยม (Not a Triangle)</p>";
                    }
                } else {
                    echo "<p id='error'>การตรวจสอบรับค่าแค่ 0.00 - 100.00 เท่านั้น กรุณากรอกใหม่อีกครั้ง</p>";
                }
            }

            function isValidInputRange($value) {
                return is_numeric($value) && $value >= 0.00 && $value <= 100.00;
            }

            function isValidTriangle($a, $b, $c) {
                return $a + $b > $c || $b + $c > $a || $c + $a > $b;
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
            ?>
        </div>
    </footer>
    
    <script>
    document.addEventListener('input', function (e) {
        if (e.target.tagName.toLowerCase() === 'input' && e.target.type === 'text') {
            e.target.value = e.target.value.replace(/[^\d.]/g, ''); // Allow only digits and dots
        }
    });

    // Add this part to ensure the form is submitted with numeric values
    document.addEventListener('submit', function (e) {
        var inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(function (input) {
            input.value = input.value.replace(/[^\d.]/g, ''); // Clean non-numeric characters before submission
        });
    });
</script>

   
</body>
</html>
