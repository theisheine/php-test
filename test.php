<?php
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://restapi.e-conomic.com/customers",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{\"name\": \"" + $_POST["name"] + "\",
		\"customerGroup\": {\"customerGroupNumber\": 1\n    },
		\"currency\": \"DKK\",
		\"paymentTerms\": {
			\"properties\": {
				\"paymentTermsNumber\": {},
				\"self\": {}\n        }
			},
		\"vatZone\": {
			\"properties\": {
				\"vatZoneNumber\": {},
				\"self\": {}
			}
		}
	}",
	CURLOPT_HTTPHEADER => array(
		"Content-Type: application/json",
		"X-AgreementGrantToken: SI3xOLaIzbSWH1embrkNYSWWIKBK09bd8efEvZRvKwo1",
		"X-AppSecretToken: 7tVtBFEIEBPre0Fq3NWlNds54AXF76xA4NIe8vMsKx41",
		"cache-control: no-cache"
		),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$host = "localhost";
		$port=3306;
		$username = "root";
		$password = "";
		$dbname = "customer";
		$conn = new mysqli($host, $username, $password, $dbname, $port);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "INSERT INTO customer.customer_data(`Id`,`Name`,`Group`) VALUES(0," + $_POST["name"] + ",1)";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
?>
