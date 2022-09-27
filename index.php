<?php
session_start();
if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせフォーム 入力画面</title>
        <link rel="stylesheet" href="sample.css">
    </head>
    <body>
        <div class="Form">
            <h1>お問い合わせフォーム</h1>
            <?php if(isset($errors)) : ?>
            <?php foreach( $errors as $value): ?>
                <?php echo $value; ?><br />
            <?php endforeach; ?>
            <?php endif ?>
            <form method="post" action="confirm.php">
                <div class="Form-Item">
                    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>お名前</p>
                    <input type="text" name="name" class="Form-Item-Input" placeholder="例）山田太郎" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>">
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
                    <input type="email" name="email" class="Form-Item-Input" placeholder="例）example@gmail.com" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>">
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>お問い合わせ内容</p>
                        <textarea class="Form-Item-Textarea" input type ="contents" name="contents" ><?php if(isset($_SESSION['contents'])){echo $_SESSION['contents'];} ?></textarea>
                </div>
                <input type="submit" class="Form-Btn" value="送信する">
            </form>
            <?php session_destroy(); ?>
        </div>
    </body>
</html>