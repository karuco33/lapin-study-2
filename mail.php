<?php
/**
 * ラパン学習塾 幼児教室 お問い合わせ処理プログラム
 */

// 1. メールの設定（ここだけ書き換えてください！）
$to_email = "mff.cqy88@gmail.com"; // あなたがメールを受け取りたいアドレス
$subject  = "【ラパン学習塾】ホームページからのお問い合わせ"; // メールの件名
$thanks_page = "thanks.html"; // 送信後に表示するページ名

// 2. 文字化けを防ぐための設定（日本語メールのおまじない）
mb_language("Japanese");
mb_internal_encoding("UTF-8");

// 3. フォームから送られてきたデータを受け取る
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // データの受け取り（カッコ内はHTMLの name="〇〇" と同じ名前にします）
    $child_name  = $_POST['child_last_name'] . " " . $_POST['child_first_name'];
    $child_kana  = $_POST['child_last_kana'] . " " . $_POST['child_first_kana'];
    $grade       = $_POST['grade'];
    $gender      = $_POST['gender'];
    $parent_name = $_POST['parent_last_name'] . " " . $_POST['parent_first_name'];
    $tel         = $_POST['tel'];
    $email       = $_POST['email'];
    $address     = $_POST['address'];
    $message     = $_POST['message'];

    // 4. メールの本文を組み立てる
    $body = "ホームページからお問い合わせがありました。\n\n";
    $body .= "--------------------------------------------------\n";
    $body .= "【お子様のお名前】 $child_name \n";
    $body .= "【フリガナ】 $child_kana \n";
    $body .= "【学年】 $grade \n";
    $body .= "【性別】 $gender \n";
    $body .= "【保護者様の名前】 $parent_name \n";
    $body .= "【お電話番号】 $tel \n";
    $body .= "【メールアドレス】 $email \n";
    $body .= "【ご住所】 $address \n";
    $body .= "【ご質問・ご要望】\n $message \n";
    $body .= "--------------------------------------------------\n";

// 送信元（From）と返信先（Reply-To）の設定
    // mb_encode_mimeheader を使うことで、古いサーバーでも動くようになります
    $from_name = mb_encode_mimeheader("ラパン学習塾幼児教室", "UTF-8");
    $headers = "From: " . $from_name . " <$to_email>\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    // 6. メールを送信する
    if (mb_send_mail($to_email, $subject, $body, $headers)) {
        // 送信成功：サンクスページへ移動
        header("Location: " . $thanks_page);
        exit;
    } else {
        // 送信失敗
        echo "メールの送信に失敗しました。お手数ですが、お電話にてお問い合わせください。";
    }
} else {
    // POST以外（直接アクセスなど）はエラー
    echo "不正なアクセスです。";
}
?>