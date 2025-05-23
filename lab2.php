<?php
$bmi = null;
$resultText = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $weight = floatval($_POST["weight"]);
    $height = floatval($_POST["height"]);

    if ($weight > 0 && $height > 0) {
        $bmi=$weight/($height*$height);

        if ($bmi < 18.5) {
            $status = "نقص وزن";
        } elseif ($bmi < 25) {
            $status = "وزن طبيعي";
        } elseif ($bmi < 30) {
            $status = "زيادة وزن";
        } else {
            $status = "سمنة";
        }

        $resultText = "مرحبًا $name مؤشر كتلة الجسم (BMI) الخاص بك هو: <strong>" . number_format($bmi, 2) . "</strong><br>الحالة: <strong>$status</strong>";
    } else {
        $resultText = "يرجى إدخال قيم صحيحة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حاسبة BMI</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            width: 100%;
            max-width: 420px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,128,0,0.3);
            border: 2px solid #28a745;
        }

        h1 {
            text-align: center;
            color: #28a745;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .modal {
            display: <?= !empty($resultText) ? 'flex' : 'none' ?>;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            max-width: 400px;
            text-align: center;
            border: 2px solid #28a745;
        }

        .modal-content strong {
            color: #28a745;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #888;
        }

        .close-btn:hover {
            color: #000;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>حاسبة BMI</h1>
    <form method="post" action="">
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" required>

        <label for="weight">الوزن (كغ):</label>
        <input type="number" step="0.1" name="weight" id="weight" required>

        <label for="height">الطول (متر):</label>
        <input type="number" step="0.01" name="height" id="height" required>

        <input type="submit" value="احسب الآن">
    </form>
</div>

<?php if (!empty($resultText)): ?>
<div class="modal" id="resultModal">
    <div class="modal-content">
        <span class="close-btn" onclick="document.getElementById('resultModal').style.display='none'">&times;</span>
        <p><?= $resultText ?></p>
    </div>
</div>
<?php endif; ?>
</body>
</html> 