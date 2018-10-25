<?php
include "../Scanneroverblik/scannervalg.php";

    deformationdata($sn, $model, $startdato, $slutdato);
    driftdata($sn, $startdato, $slutdato);
    ghostingdata($sn, $startdato, $slutdato);
    rfdata($sn, $startdato, $slutdato);
    snrdata($sn, $startdato, $slutdato);
    uniformitetdata($sn, $startdato, $slutdato);

?>
