<?php 

require_once 'test.class.php';

$caller = new Test();

        // balance enquiry
        $refferenxe = "YH7764GF564KI8R".time();
        $balance_enq = [
            'id' => 'FundGate',
            'direction' => 'request',
            'action' => 'BE',
            'terminalId' => '7000000001',
            'transaction' => array(
                'id' => $refferenxe,
                'pin' => Test::encryptPinCode(),
                'reference' => $refferenxe,
                'terminalCard' => FALSE,
                'amount' => 0.0,
            ),
        ];

        try {
            $balance = $caller->processRequest($balance_enq);
            echo json_encode($balance); exit;
        } catch (ConnectException $ex) {
            $error = 'Could not communicate with server';
            log_message('error', $ex->getMessage());
        } catch (Exception $e) {
            $error = $e->getMessage();
        }   

?>