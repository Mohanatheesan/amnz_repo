<?php
class Drivers{
	public $con;
	private $table = "drivers";

	public $driverID;
	public $userID;
	public $licenseNo;
	public $licenseExpireDate;
	public $vehicleType;
	public $vehicleModel;
	public $vehicleCapacity;
	public $vehicleNo;
	public $status;
	public $updatedTime;
	public $active;


	public function __construct(){
		$database = new Database();
		$this->con = $database->con;
	}

	public function registerDriver($data, $userID){
		$this->userID = htmlspecialchars($userID);
		$this->licenseNo = htmlspecialchars($data['licenseNo']);
		$this->licenseExpireDate = htmlspecialchars($data['licenseExpireDate']);
		$this->vehicleType = htmlspecialchars($data['vehicleType']);
		$this->vehicleModel = htmlspecialchars($data['vehicleModel']);
		$this->vehicleCapacity = htmlspecialchars($data['vehicleCapacity']);
		$this->vehicleNo = htmlspecialchars($data['vehicleNo']);
		$this->status = "Offline";
		$this->updatedTime = date("Y-m-d H:i:s");
		$this->active = '1';

		$sql = "INSERT INTO $this->table VALUES (null, '$this->userID', '$this->licenseNo', '$this->licenseExpireDate', '$this->vehicleType', '$this->vehicleModel', '$this->vehicleCapacity', '$this->vehicleNo', '$this->status', '$this->updatedTime', '$this->active')";
		$exe = $this->con->query($sql);
		if($exe){
			?>
			<div class="alert alert-success" role="alert">
				<h5 style="text-align: center;"><b>Registered Driver Successful!</b></h5>
			</div>
			<?php
		}else{
			?>
			<div class="alert alert-warning" role="alert">
				<h5 style="text-align: center;"><?php echo $this->con->error; ?></h5>
			</div>
			<?php
		}
	}
}
?>