<?php
class Reservation{
    public $con;
    private $table = "reservation";

    public $reservationId ;
    public $reservationType;
    public $reservedBy;
    public $passengerName;
    public $passengerPhone;
    public $passengerNIC;
    public $vehicleType;
    public $pickupLocation;
    public $dropoffLocation;
    public $reservedDateTime;
    public $sheduledDateTime;
    public $amount;
    public $note;
    public $status;
    public $active;

    public function __construct(){
        $database = new Database();
        $this->con = $database->con;
    }

    public function Reserve ($data ){
        $this->reservationType = "Manual";
        $this->reservedBy = 1;
        $this->passengerName =htmlspecialchars($data['passengerName']);
        $this->passengerPhone = htmlspecialchars($data['passengerPhone']);
        $this->passengerNIC = htmlspecialchars($data['passengerNIC']);
        $this->vehicleType = htmlspecialchars($data['vehicleType']);
        $this->pickupLocation = htmlspecialchars($data['pickupLocation']);
        $this->dropoffLocation = htmlspecialchars($data['dropoffLocation']);
        $this->reservedDateTime = date("Y-m-d H:i:s");
        $this->scheduledDateTime = htmlspecialchars($data['scheduledDateTime']);
        $this->amount = htmlspecialchars($data['amount']);
        $this->note = htmlspecialchars($data['note']);
        $this->status = "Pending";
        $this->active = "1";

         $sql = "INSERT INTO `reservation`(`reservationID`, `reservationType`, `reservedBy`, `passengerName`,`passengerPhone`,`passengerNIC`,`vehicleType`,`pickupLocation`, `dropoffLocation`, `reservedDateTime`, `scheduledDateTime`, `amount`, `note`, `status`, `active`) VALUES (null,'$this->reservationType','$this->reservedBy','$this->passengerName','$this->passengerPhone','$this->passengerNIC','$this->vehicleType','$this->pickupLocation','$this->dropoffLocation','$this->reservedDateTime','$this->scheduledDateTime', '$this->amount','$this->note','$this->status','$this->active')";
        


        $exe = $this->con->query($sql);
        if($exe){
            header("Location: operatorConsole.php?success");
        }else{
            echo $this->con->error;
        }

    }


    public function getAllReservation(){
        $sql = "SELECT * from $this->table where active = '1'";
        $exe = $this->con->query($sql);
        if($exe){
            $records = [];
            while($row = $exe->fetch_assoc()){
                $records[] = $row;
            }
            return $records;
        }
    }

    public function getReservationByID($ID){
        $sql = "SELECT * FROM $this->table where reservationID = '$ID' and active = '1' ";
        $exe = $this->con->query($sql);
        $row = $exe->fetch_assoc();
        return $row;
    }



}


?>

