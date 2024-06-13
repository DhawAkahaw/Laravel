<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }
        .invoice-box {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background-color: #fff;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 10px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .invoice-box table tr.footer td {
            padding-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #999;
        }
        .logo {
            max-width: 150px;
            max-height: 150px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="logo-topnet.png" alt="Logo" class="logo"/>
                            </td>
                            <td>
                                Facture #: {{ $facture->numero_facture }}<br>
                                Date: {{ $facture->date }}<br>
                                Échéance: {{ $facture->echeance }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Client ID:</strong> {{ $facture->client_id }}<br>
                                <strong>Prise en Charge:</strong> {{ $facture->prise_en_charge }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Description
                </td>
                <td>
                    Montant
                </td>
            </tr>
            <tr class="item">
                <td>
                    Montant à Payer
                </td>
                <td>
                    {{ $facture->montant_a_payer }}
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Reste à Payer
                </td>
                <td>
                    {{ $facture->reste_a_payer }}
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total: {{ $facture->montant_a_payer }}
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr class="footer">
                <td colspan="2">
                    Merci pour votre entreprise !<br>
                    Si vous avez des questions concernant cette facture, veuillez contacter [nom, téléphone, e-mail]
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
