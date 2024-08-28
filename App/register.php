<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

    	error_reporting(E_ALL); // reports all errors
    	ini_set("display_errors", "1"); // shows all errors
		ini_set("log_errors", 1);
		ini_set("error_log", "/tmp/php-error.log");

			$inData = getRequestInfo();
			
			$firstName = $inData["firstName"];
				$lastName = $inData["lastName"];
				$username = $inData["username"];
					$password = $inData["password"];

					$conn = new mysqli("localhost", "administrator", "group13Stack", "COP4331");
						if ($conn->connect_error) 
								{
											returnWithError( $conn->connect_error );
												} 
							else
									{
												$stmt = $conn->prepare("INSERT into Users (FirstName,LastName,Login, Password) VALUES(?,?,?,?)");
														$stmt->bind_param("ssss", $firstName, $lastName, $username, $password);
														$stmt->execute();
																$stmt->close();
																$conn->close();
																		returnWithError("");
																	}

						function getRequestInfo()
							    {
								            return json_decode(file_get_contents('php://input'), true);
									        }

					    function sendResultInfoAsJson( $obj )
						        {
								        header('Content-type: application/json');
									        echo $obj;
									    }
						
						function returnWithError( $err )
								{
											$retValue = '{"error":"' . $err . '"}';
													sendResultInfoAsJson( $retValue );
												}
						
?>
