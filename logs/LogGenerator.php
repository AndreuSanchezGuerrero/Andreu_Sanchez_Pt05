<?php
// Andreu Sánchez Guerrero

class LogGenerator {
    private $logDirectory;

    public function __construct($logDirectory) {
        $this->logDirectory = $logDirectory;
    }

    public function logSuccess($message, $fileName) {
        $logFile = $this->logDirectory . $fileName;
        $formattedMessage = "[" . date('Y-m-d H:i:s') . "] SUCCESS: $message\n";
        error_log($formattedMessage, 3, $logFile);
    }

    public function logError($message, $fileName) {
        $logFile = $this->logDirectory . $fileName;
        $formattedMessage = "[" . date('Y-m-d H:i:s') . "] ERROR: $message\n";
        error_log($formattedMessage, 3, $logFile);
    }

    public function logWarning($message, $fileName) {
        $logFile = $this->logDirectory . $fileName;
        $formattedMessage = "[" . date('Y-m-d H:i:s') . "] WARNING: $message\n";
        error_log($formattedMessage, 3, $logFile);
    }
}
?>
