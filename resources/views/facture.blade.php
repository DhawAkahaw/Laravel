<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
</head>
<body>
    <h1>Facture</h1>
    <p>Client ID: {{ $facture->client_id }}</p>
    <p>Numero Facture: {{ $facture->numero_facture }}</p>
    <p>Montant à Payer: {{ $facture->montant_a_payer }}</p>
    <p>Reste à Payer: {{ $facture->reste_a_payer }}</p>
    <p>Prise en Charge: {{ $facture->prise_en_charge }}</p>
    <p>Echéance: {{ $facture->echeance }}</p>
</body>
</html>
