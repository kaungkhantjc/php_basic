<?php

class UpdateModel implements JsonSerializable {
    private $status, $title, $message, $shouldShowInfo, $maintenanceMode;

    public function __construct($status, $title, $message, $shouldShowInfo, $maintenanceMode)
    {
        $this->status = $status;
        $this->title = $title;
        $this->message = $message;
        $this->shouldShowInfo = $shouldShowInfo;
        $this->maintenanceMode = $maintenanceMode;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}

require ("server_info.php");

$info = readInfo();

if (!$info) $model = new UpdateModel(false, null, null, null, null);
else $model = new UpdateModel(true, $info['title'], $info['message'], boolval($info['should_show_info']), boolval($info['maintenance_mode']));

$json = json_encode($model, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
header("Content-type: application/json");
echo $json;