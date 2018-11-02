<?php
include "../Modeloverblik/modelvalg.php";
//include "../Kvalitetsparametre/deformation.php";

    deformationmodel($model, $startdato, $slutdato);
    driftmodel($model, $startdato, $slutdato);
    ghostingmodel($model, $startdato, $slutdato);
    rfmodel($model, $startdato, $slutdato);
    snrmodel($model, $startdato, $slutdato);
    uniformitetmodel($model, $startdato, $slutdato);

?>
