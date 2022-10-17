<?php 
$start_date=new DateTime("2021-10-01 00:00:00");

$tdate=new DateTime();
$tz=new DateTimeZone("Asia/Colombo");
$tdate->setTimezone($tz);

$endDate=new DateTime($tdate->format("Y-m-d H:i:s"));


$difference=$endDate->diff($start_date);


?>
<label class="form-label fs-4 fw-bold text-success"><?php echo $difference->format("%y")." Years ".$difference->format("%m")." Months ".$difference->format("%d")." Dates ".$difference->format("%H")." Hours ".$difference->format("%i")." Minuts ".$difference->format("%s")." Seconds " ?></label>
<?php

?>