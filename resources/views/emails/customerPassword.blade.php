<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
        <title>E-Posta Bilgilendirme</title>
    </head>
    <body>
        <center><font face="Verdana" color="#000000" size="1">Bu e-posta "şifremi unuttum" talebiniz üzerine gönderilmiştir.</font></center>
        <br>
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td><center><font face="Verdana" color="#000000" size="4"><b>{{ $title }}</b></font></center><br></td>
            </tr>
            <tr>
                <td height="2" bgcolor="#dadada"></td>
            </tr>
            <tr>
                <td>
                    <center><br><font face="Verdana" color="#000000" size="2">
                    <b>Merhaba,</b><br><br>
                    Aşağıdaki linke tıklayarak, açılan sayfadan yeni şifrenizi belirleyebilirsiniz.<br><br> 
                    <b>Şifre sıfırlama linki :</b> <a href="{{ $link = url('uye/sifre/yeni', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
                    </font>
                    <br><br>
                    </center>
                </td>
            </tr>
            <tr>
                <td height="2" bgcolor="#dadada"></td>
            </tr>
        </table>
        <br><center><font face="Verdana" color="#000000" size="1">{{ $title }} - {{ date('Y') }}</font></center>
    </body>
</html>