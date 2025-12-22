<?php
/**
 * ラパン学習塾 幼児教室 お問い合わせ処理（文字化け対策版）
 */

// 1. メールの設定
$to_email = "your-name@gmail.com"; // ★ご自身のメールアドレス
$subject  = "【ラパン学習塾】ホームページからのお問い合わせ";
$thanks_page = "thanks.html";

// 2. 日本語設定の徹底（おまじない）
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. データの受け取り
    $child_name  = $_POST['child_last_name'] . " " . $_POST['child_first_name'];
    $child_kana  = $_POST['child_last_kana'] . " " . $_POST['child_first_kana'];
    $grade       = $_POST['grade'];
    $gender      = $_POST['gender'];
    $parent_name = $_POST['parent_last_name'] . " " . $_POST['parent_first_name'];
    $tel         = $_POST['tel'];
    $email       = $_POST['email'];
    $address     = $_POST['address'];
    $message     = $_POST['message'];

    // 4. 本文の組み立て（改行コードを \r\n に統一）
    $body = "ホームページからお問い合わせがありました。\r\n\r\n";
    $body .= "--------------------------------------------------\r\n";
    $body .= "【お子様のお名前】 " . $child_name . "\r\n";
    $body .= "【フリガナ】 " . $child_kana . "\r\n";
    $body .= "【学年】 " . $grade . "\r\n";
    $body .= "【性別】 " . $gender . "\r\n";
    $body .= "【保護者様の名前】 " . $parent_name . "\r\n";
    $body .= "【お電話番号】 " . $tel . "\r\n";
    $body .= "【メールアドレス】 " . $email . "\r\n";
    $body .= "【ご住所】 " . $address . "\r\n";
    $body .= "【ご質問・ご要望】\r\n" . $message . "\r\n";
    $body .= "--------------------------------------------------\r\n";

    // 5. ヘッダーの作成（文字化け防止の決定版）
    $from_name = mb_encode_mimeheader("ラパン学習塾幼児教室", "UTF-8");
    $headers = "From: " . $from_name . " <" . $to_email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit";

    // 件名も念のためエンコードする
    $subject_encoded = mb_encode_mimeheader($subject, "UTF-8");

    // 6. 送信（mb_send_mail ではなく mail を使うのが確実な場合があります）
    if (mail($to_email, $subject_encoded, $body, $headers)) {
        header("Location: " . $thanks_page);
        exit;
    } else {
        echo "メールの送信に失敗しました。";
    }
}
?>