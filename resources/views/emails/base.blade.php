<!DOCTYPE html>
<html style="border: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
    <head>
        <META HTTP-EQUIV="content-type" CONTENT="text/html"; charset="UTF-8">
        <title>Email by Lpf</title>
    </head>
    <body style="background: #e8e8e8; border: 0; color: #343434; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" style="background: #ffffff; border: 0; border-spacing: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0 auto; min-width: 320px; padding: 0; width: 70%;">
        <tbody style="border: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
        <tr style="border: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
            <td bgcolor="#FFFFFF" style="border: 0; border-top: 4px solid #333; margin: 0;">
                <img src="{{ asset("images/shared/email-header.jpg") }}" alt="Loucos por Festa" style="width: 100%; max-width: 600px">
            </td>
        </tr>
        <tr style="border: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
            <td style="border: 0; color: #343434; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 22px;">
                @yield('email.content')
            </td>
        </tr>
        <tr style="border: 0; color: #343434; font-size: 14px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0;">
            <td style="border: 0; color: #000; font-family: Helvetica, Arial, sans-serif; font-size: 10px; font-weight: normal; line-height: 1.2; margin: 0; padding: 0 22px 22px">
                Para melhor visualizar este email, use o modo de exibição HTML.<br />
                Este email contém informações confidenciais e importantes. Caso não tenha conhecimento dessas informações, por favor delete-o.
            </td>
        </tr>
        </tbody>
    </table>
    </body>
</html>