<?php 

require_once 'test.class.php';

$caller = new Test();

		$refferenxe = "YH7764GF564KI8R".time();

        // balance enquiry
        $request = [
            'id' => 'FundGate',
            'direction' => 'request',
            'action' => 'BT',
            'terminalId' => '7000000001',
            'transaction' => array(
                'endPoint' => 'A',
                'terminalCard' => FALSE,
                'id' => $refferenxe,
                'companyId' => "000000000000000002",
                'pin' => Test::encryptPinCode(),
                'reference' => $refferenxe,
                'refId' => $refferenxe,
                'uniqueTransId' => $refferenxe,
                'amount' => $totalAmount,
                'bulkItems' => array(
                	[
                		'uniqueId' => $uniqueID,
            			"beneficiaryName" => "Tohir Oye",
            			"accountId" => "0036008700",
            			"bankCode" => "063", // bank sort code
            			"status" => 0,
            			"narration" => "Jan 2016 Salary",
            			"amount" => 120000.75,
		            	'merchantCode' => 'ZD',
        		    	'terminalId' => 7000000001,
		            	'message' => "Jan 2016 Salary"
                	],
                	[
                		'uniqueId' => $uniqueID,
            			"beneficiaryName" => "Yemi Awo",
            			"accountId" => "0099008700",
            			"bankCode" => "063", // bank sort code
            			"status" => 0,
            			"narration" => "Jan 2016 Salary",
            			"amount" => 185000.5,
		            	'merchantCode' => 'ZD',
        		    	'terminalId' => 7000000001,
		            	'message' => "Jan 2016 Salary"
                	]
                ),
            )
        ];

        try {
            $response = $caller->processRequest($request);
            echo json_encode($response); exit;
        } catch (ConnectException $ex) {
            $error = 'Could not communicate with server';
            log_message('error', $ex->getMessage());
        } catch (Exception $e) {
            $error = $e->getMessage();
        }   

?>
