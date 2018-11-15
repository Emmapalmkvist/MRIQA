<?php
include "../Scanneroverblik/scannervalg.php";
include "../Kvalitetsparametre/deformation.php";
include "../Kvalitetsparametre/drift.php";
include "../Kvalitetsparametre/ghosting.php";
include "../Kvalitetsparametre/rf.php";
include "../Kvalitetsparametre/snr.php";
include "../Kvalitetsparametre/uniformitet.php";

    deformationdata($sn, $model, $startdato, $slutdato);
    driftdata($sn, $model, $startdato, $slutdato);
    ghostingdata($sn, $model, $startdato, $slutdato);
    rfdata($sn, $model, $startdato, $slutdato);
    snrdata($sn, $model, $startdato, $slutdato);
    uniformitetdata($sn, $model, $startdato, $slutdato);

?>
