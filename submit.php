<?php
    // Composer のオートローダーの読み込み
    require 'vendor/autoload.php';
    //エラーメッセージ用日本語言語ファイルを読み込む場合
    require 'vendor/phpmailer/phpmailer/language/phpmailer.lang-ja.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //値の受け取り
    session_start();
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $contents = $_SESSION['contents'];
    //メール内容
    $mail_body = '<h1>' .$name. 'さん<h1><br>
    お問い合わせ内容はこちらです。</p>
    <p>メールアドレス：' .$email. '</p>
    <P>お問い合わせ内容：' .$contents. '</p>';
    //言語、内部エンコーディングを指定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    // インスタンスを生成（引数に true を指定して例外 Exception を有効に）
    $mail = new PHPMailer(true);
    //日本語用設定
    $mail->charset = 'UTF-8'; //文字化け防止
    //エラーメッセージ用言語ファイルを使用する場合に指定
    $mail->setLanguage('ja', 'vendor/phpmailer/phpmailer/language/');
    try {
        //サーバの設定
        $mail->SMTPDebug = 0; // デバッグの出力を有効に（テスト環境での検証用）
        $mail->isSMTP();  //SMTPを利用
        $mail->Host = 'smtp.mailtrap.io'; // SMTP サーバーを指定
        $mail->SMTPAuth = true; // SMTP authentication を有効に
        $mail->Username = '9bd8e1cc2e1359'; //SMTPユーザ名
        $mail->Password = '064427d421b00c'; //SMTPパスワード
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525; //TCPポートを指定  
        //受信者設定
        //※名前などに日本語を使う場合は文字エンコーディングを変換
        //差出人アドレス, 差出人名
        $mail->setFrom('from@example.com', '湯浅のお問い合わせフォーム');
        //受信者アドレス, 受信者名（受信者名はオプション）
        $mail->addAddress($email, $name);
        //コンテンツ設定
        $mail->isHTML(true); //HTML形式を指定
        //メール表題（文字エンコーディングを変換）
        $mail->subject = mb_encode_mimeheader('お問い合わせフォームのメールです。', 'ISO-2022-JP');
        //HTML形式の本文（文字エンコーディングを変換）
        $mail->Body = $mail_body;
        $mail->send(); //送信
        session_destroy();  
    } catch (Exception $e) {
        //エラーが発生した場合
        exit;
    }
?>
<!DOCTYPE>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせフォーム 完了画面</title>
        <link href="sample.css" rel="stylesheet">
    </head>
    <body>
        <h1>お問い合わせフォーム</h1>
        <div>
            <h3>送信完了</h3>
            <p>お問い合わせいただきありがとうございました。</p>
            <p>送信完了いたしました。</p>
        </div>
    </body>
</html>

   
   
   
   
   
   
   
   
   
   
   
   
   
   














