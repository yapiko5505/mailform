<?php
    require_once('vendor/autoload.php');
    Valitron\Validator::lang('ja');
    session_start();
    // Valitronクラスを実行
    $v = new Valitron\Validator($_POST);
    // 入力必須の項目が記入されているか確認
    // 入力項目のうち備考のみ任意項目にしてみる
    $v->rule('required', 'name')->message('{field}を入力してください。');
    $v->rule('required', 'email')->message('{field}を入力してください。');
    $v->rule('required', 'contents')->message('{field}を入力してください。');
    //入力された文字がメール形式かを確認
    $v->rule('email', 'email')->message('{field}が正しい形式ではありません。');
    //項目名を指定
    $v->labels([
        'name' => '名前',
        'email' => 'メールアドレス',
        'contents' => 'お問い合わせ内容'
    ]);
    $_SESSION['name'] = htmlspecialchars($_POST['name']);
    $_SESSION['email'] = htmlspecialchars($_POST['email']);
    $_SESSION['contents'] = htmlspecialchars($_POST['contents']);
    //バリデーションを実行
    if($v->validate()) {
        //値の受け取り
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $contents = $_SESSION['contents'];
    } else {
        $errors = [];
        foreach ($v->errors() as $error) {
            foreach ($error as $value) {
                $errors[] = $value;
            }
        }
        $_SESSION['errors'] = $errors;
        header("location: index.php");
    }
    
    
?>
<!DOCTYPE>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>お問い合わせフォーム 確認画面</title>
        <link rel="stylesheet" href="sample.css">
    </head>
    <body>
        <?php if (empty($errors)) : ?>
        <div>
            <h1>お問い合わせフォーム</h1>
            <p>以下の内容でよろしければ「送信する」をクリックしてください。<br>
            内容を変更する場合は「戻る」をクリックして入力画面にお戻りください。</p>
        
            <form method="post" action="submit.php">
                <div>
                    <p class="Form-Item-Label">お名前</p>
                    <p><?php echo $name; ?></p>
                </div>
                <div>
                    <p class="Form-Item-Label">メールアドレス</p>
                    <p><?php echo $email; ?></p>
                </div>
                <div>
                <p class="Form-Item-Label">お問い合わせ内容</p>
                    <p><?php echo $contents; ?></p>    
                </div>
            </form>
            <form action="index.php" method="get">
                <button type="submit" class="btn btn-success">戻る</button>
            </form>
            <form action="submit.php" method="post">
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
        <?php else : ?>
            <?php foreach($errors as $value): ?>
                <?php echo $value; ?><br />
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>

