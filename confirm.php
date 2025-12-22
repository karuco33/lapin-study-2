<?php
// 前の画面から送られてきたデータを「受け取る」作業です
// htmlspecialchars というのは、変な文字を無害化する安全のための「おまじない」です
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name  = h($_POST['child_last_name']) . " " . h($_POST['child_first_name']);
    $child_kana  = h($_POST['child_last_kana']) . " " . h($_POST['child_first_kana']);
    $grade       = h($_POST['grade']);
    $gender      = h($_POST['gender']);
    $parent_name = h($_POST['parent_last_name']) . " " . h($_POST['parent_first_name']);
    $tel         = h($_POST['tel']);
    $email       = h($_POST['email']);
    $address     = h($_POST['address']);
    $message     = h($_POST['message']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力内容の確認｜ラパン学習塾幼児教室</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        </header>

    <div class="page-header">
        <div class="container">
            <h1>内容の確認</h1>
            <p>ご入力内容をご確認ください。</p>
        </div>
    </div>

    <main class="confirm-page">
        <div class="container">
            <div class="inquiry-card">
                <div class="card-header">
                    <h3 class="section-accent-title">ご入力内容</h3>
                </div>

                <div class="confirm-list">
                    <dl class="confirm-item">
                        <dt>お子様のお名前</dt>
                        <dd><?php echo $child_name; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>学年・性別</dt>
                        <dd><?php echo $grade; ?> / <?php echo $gender; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>保護者様の名前</dt>
                        <dd><?php echo $parent_name; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>お電話番号</dt>
                        <dd><?php echo $tel; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>メールアドレス</dt>
                        <dd><?php echo $email; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>ご住所</dt>
                        <dd><?php echo $address; ?></dd>
                    </dl>
                    <dl class="confirm-item">
                        <dt>ご質問・ご要望など</dt>
                        <dd><?php echo nl2br($message); ?></dd>
                    </dl>
                </div>

                <div class="confirm-btn-group">
                    <form action="contact.html" method="POST">
                        <button type="button" onclick="history.back()" class="btn-back">修正する</button>
                    </form>

                    <form action="mail.php" method="POST">
                        <input type="hidden" name="child_last_name" value="<?php echo h($_POST['child_last_name']); ?>">
                        <input type="hidden" name="child_first_name" value="<?php echo h($_POST['child_first_name']); ?>">
                        <input type="hidden" name="child_last_kana" value="<?php echo h($_POST['child_last_kana']); ?>">
                        <input type="hidden" name="child_first_kana" value="<?php echo h($_POST['child_first_kana']); ?>">
                        <input type="hidden" name="grade" value="<?php echo $grade; ?>">
                        <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                        <input type="hidden" name="parent_last_name" value="<?php echo h($_POST['parent_last_name']); ?>">
                        <input type="hidden" name="parent_first_name" value="<?php echo h($_POST['parent_first_name']); ?>">
                        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="address" value="<?php echo $address; ?>">
                        <input type="hidden" name="message" value="<?php echo $message; ?>">
                        
                        <button type="submit" class="btn-submit">この内容で送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        </footer>

</body>
</html>