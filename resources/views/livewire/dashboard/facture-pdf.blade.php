<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='bottom' width='50%' height='50'>
                            <div align='left'><img
                                    src='https://www.inv24.com/components/Users/pics/50c86533af47b/thumbs/0.jpg' />
                            </div><br />
                        </td>

                        <td width='50%'>&nbsp;</td>
                    </tr>
                </table><br /><br />
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='35%' style='font-size:12px;'>
                            <strong>Sté DMPRO</strong><br />
                            Lotissement Riad Al Ismailia Anasi, MEKNES<br />
                            <strong>
                                GSM: 06 69 54 54 96</strong> <br />
                            E-Mail: dmpromedical@gmail.com
                        </td>
                        <td valign='top' width='35%'>
                        </td>
                        <td valign='top' width='30%' style='font-size:142x;'>
                            Facture N°{{ $invoice['id'] }}<br />
                            {{ $invoice['created_at'] }}<br />
                            <strong>
                                {{ $invoice['client']['name'] }}</strong> <br />
                            ICE : {{ $invoice['client']['ice'] }}
                        </td>

                    </tr>
                </table>
                <br /><br />
                <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'>
                            <strong>Désignation</strong>
                        </td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Qté</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>PU HT</strong>
                        </td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Montant HT</strong>
                        </td>

                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                            @foreach ($invoice['products'] as $item)
                    <tr>

                        <td valign='top' style='font-size:12px;'>{{ $item->product->name }}</td>
                        <td valign='top' style='font-size:12px;'>{{ $item->qte }}</td>
                        <td valign='top' style='font-size:12px;'>{{ $item->product->unit_price }} </td>
                        <td valign='top' style='font-size:12px;'>{{ $item->product->unit_price * $item->qte }} </td>
                    </tr>
                    @endforeach
                    <tr>

                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>

                    </tr>
                    <tr>

                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>
                        <td valign='top' style='font-size:12px;'>&nbsp;</td>

                    </tr>
            </td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2' border='0'>
        <tr>
            <td style='font-size:12px;width:50%;'><strong></strong></td>
            <td>
                <table width='100%' cellspacing='0' cellpadding='2' border='0'>
                    <tr>
                        <td align='right' style='font-size:12px;'>Total HT </td>
                        <td align='right' style='font-size:12px;'>{{ $invoice->sumInvoice() }} MAD
                        <td>
                    </tr>
                    <tr>
                        <td align='right' style='font-size:12px;'>Total TVA (20%)</td>
                        <td align='right' style='font-size:12px;'>{{ $invoice->totalTVA() }} MAD</td>
                    </tr>
                    <tr>

                        <td align='right' style='font-size:12px;'><b>Total TTC</b></td>
                        <td align='right' style='font-size:12px;'>
                            <b>{{ $invoice->totalTVA() + $invoice->sumInvoice() }} MAD</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width='100%' height='50'>
        <tr>
            <td style='font-size:12px;text-align:justify;'></td>
        </tr>
    </table>

    </td>
    </tr>
    </table>
</body>

</html>
