<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Start publishing with us</h2>

        <div>
            please follow the link below to confirm and verify your email address
            <p>
            	{{ HTML::link(URL::to('confirm?ecc=' . $email_confirmation_code . '&ca=' . $created_at)) }}.
            <p>
        </div>

    </body>
</html>
 

