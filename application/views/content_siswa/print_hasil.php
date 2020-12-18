<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Hasil</title>
</head>
<body>
    <?php

        if ($content_type == "Meaning") {
            $data_test = $this->m_selftest->getDataTestMeaning($session)->row_array();
        } else if($content_type == "Keyword") {
            $data_test = $this->m_selftest->getDataTestKeyword($session)->row_array();
        } else {
            $data_test = $this->m_selftest->getDataTestArranging($session)->row_array();
        }

    ?>
</body>
</html>