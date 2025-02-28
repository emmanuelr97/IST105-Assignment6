<?php
$params = ['a', 'b', 'c', 'd', 'e'];
foreach ($params as $p) {
    if (!isset($_GET[$p])) {
        die("Missing parameter: $p");
    }
    $$p = escapeshellarg($_GET[$p]);
}

$output = shell_exec("python3 /var/www/html/data_management.py $a $b $c $d $e");
$data = json_decode($output, true);

if (isset($data['error'])) {
    die("Error: " . htmlspecialchars($data['error']));
}

echo "<h2>Results:</h2>";
echo $data['negative'] ? "<p>Note: Negative values present.</p>" : "";
echo "<p>Average: {$data['average']} (" . ($data['average_gt_50'] ? ">50" : "≤50") . ")</p>";
echo "<p>Positive count: {$data['parity']}</p>";
echo "<p>Original: " . implode(", ", $data['original']) . "</p>";
echo "<p>Sorted (>10): " . implode(", ", $data['sorted']) . "</p>";
?>