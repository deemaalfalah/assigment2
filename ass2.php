<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Nationality Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>

    <div class="container">
        <h1>Student Nationality Data</h1>
        <?php
        // API URL for fetching data
        $URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

        // Use cURL to fetch data from the API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            die('API request failed: ' . curl_error($ch));
        }
        curl_close($ch);

        // Decode the JSON response into a PHP array
        $data = json_decode($response, true);

        // Check if data exists, and display it in a table
        if (isset($data['results'])) {
            echo "<table class='table'>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>College</th>
                            <th>Program</th>
                            <th>Nationality</th>
                            <th>Number of Students</th>
                        </tr>
                    </thead>
                    <tbody>";
            
            foreach ($data['results'] as $record) {
                echo "<tr>
                        <td>" . htmlspecialchars($record['year'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($record['semester'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($record['colleges'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($record['the_programs'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($record['nationality'] ?? 'N/A') . "</td>
                        <td>" . htmlspecialchars($record['number_of_students'] ?? 'N/A') . "</td>
                      </tr>";
            }

            echo "</tbody>
                </table>";
        } else {
            echo "<p>No data found.</p>";
        }
        ?>

    </div>

</body>
</html>
