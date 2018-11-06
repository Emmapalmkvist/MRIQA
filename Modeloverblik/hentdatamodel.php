<?php
include "../Modeloverblik/modelvalg.php";
include "../Kvalitetsparametre/deformation_model.php";
include "../Kvalitetsparametre/drift_model.php";
include "../Kvalitetsparametre/ghosting_model.php";
include "../Kvalitetsparametre/rf_model.php";
include "../Kvalitetsparametre/snr_model.php";
include "../Kvalitetsparametre/uniformitet_model.php";

    deformationmodel($model, $startdato, $slutdato);
    driftmodel($model, $startdato, $slutdato);
    ghostingmodel($model, $startdato, $slutdato);
    rfmodel($model, $startdato, $slutdato);
    snrmodel($model, $startdato, $slutdato);
    uniformitetmodel($model, $startdato, $slutdato);

?>
