<?php
// Custom Exception Class
class EmailException extends Exception {}

// Data array email
$emails = [
    "lab4a@polsub.ac.id",
    "lab4b@polsub.ac.id",
    "lab4c@polsub.ac.id",
    "lab4d@polsub.ac.id",
    "lab5a@polsub.ac.id",
    "lab5b@polsub.ac.id",
    "someone@example...com" // email tidak valid
];

$validCount = 0;
$invalidCount = 0;
$lab4Count = 0;
$lab5Count = 0;

// Proses pengecekan email
foreach ($emails as $email) {
    try {
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailException("$email tidak valid E-Mail address");
        }

        // Cek kata lab4/lab5
        if (strpos($email, "lab4") !== false) {
            echo "$email mengandung kata 'lab4' dan E-mail valid<br>";
            $lab4Count++;
        } elseif (strpos($email, "lab5") !== false) {
            echo "$email mengandung kata 'lab5' dan E-mail valid<br>";
            $lab5Count++;
        } else {
            echo "$email valid tapi tidak mengandung kata 'lab4' atau 'lab5'<br>";
        }

        $validCount++;
    } catch (EmailException $e) {
        echo "Error caught on line " . $e->getLine() . " in " . $e->getFile() . "<br>";
        echo "Pesan error: " . $e->getMessage() . "<br>";
        $invalidCount++;
    }
}

// Menampilkan hasil counting
echo "<br>Terdapat $validCount email valid dan $invalidCount email tidak valid.<br>";
echo "Terdapat $lab4Count email 'lab4' dan $lab5Count email 'lab5'.<br>";

// Total gabungan
$totalLab = $lab4Count + $lab5Count;
echo "Terdapat $totalLab email bukan lab4/lab5<br>";
?>
