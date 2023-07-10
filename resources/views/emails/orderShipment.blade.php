<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
        <title>E-Posta Bilgilendirme</title>
    </head>
    <body>
        <center><font face="Verdana" color="#000000" size="1">Bu e-posta sipariş bilgilendirmesi içindir. Fatura niteliği taşımaz.</font></center>
        <br>
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td><center><font face="Verdana" color="#000000" size="4"><b>{{ $title }}</b></font></center><br></td>
            </tr>
            <tr>
                <td height="2" bgcolor="#dadada"></td>
            </tr>
            <tr>
                <td><center><br><font face="Verdana" color="#000000" size="2">
                    <b>Merhaba, {{ $name }} {{ $surname }}</b><br><br>
                    Siparişiniz kargoya teslim edildi, bilgilerinize sunarız.<br><br></font>                    

                    <a href="{{ URL::to('kargo-sorgula?n=').$ref }}"><font face="Verdana" color="#000000" size="3"><b>KARGO TAKİP için tıklayınız</b></font></a><br><br>

                    <font face="Verdana" color="#000000" size="3"><b>Sipariş Numaranız :</b> {{ $ref }}</font><br>
                    <font face="Verdana" color="#000000" size="3"><b>Sipariş Toplam Tutarı :</b> {{ Price::format($total) }} TL</font><br>
                    <font face="Verdana" color="#000000" size="3"><b>Ödeme Tipi :</b> {{ $payment }}</font><br>
                    <br><br></center>
                </td>
            </tr>
            <tr>
                <td height="2" bgcolor="#dadada"></td>
            </tr>
        </table>
        <br><center><font face="Verdana" color="#000000" size="1">{{ $title }} - {{ date('Y') }}</font></center>
    </body>
</html>