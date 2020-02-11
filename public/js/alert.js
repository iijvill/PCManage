
//リターンキーでのpostを無効にする
$("input").keydown(function (e) {
    if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
        return false;
    } else {
        return true;
    }
});

$('#bottomRightArea').scroll(function (e) {
    $('#bottomLeftArea').scrollTop($(this).scrollTop()); // 左下のDIVのスクロール位置を更新
    $('#topRightArea').scrollLeft($(this).scrollLeft()); // 右下のDIVのスクロール位置を更新
});

//確認ダイアログを表示する
function submitAlert({ form_id = '', method = 'post', dialog_title = '', dialog_text = '', dialog_finish_title = '', dialog_finish_text = '', redirect_flg = false, redirect_url = '' }) {
    $('#' + form_id).submit(function (event) {
        Swal.fire({
            title: dialog_title,
            text: dialog_text,
            type: 'warning',
        }).then((result) => {
            console.log(result);
            if (result.value) {
                //OKボタンを押したとき
                event.preventDefault();

                $.ajax({
                    url: $(this).prop('action'),
                    type: method,
                    data: $(this).serialize(),//serialize()を使って、この関数の呼び出し元のformで入力されたデータをそのままサーバーに投げる
                })
                    .done(function (data) {
                        //通信成功時
                        Swal.fire({
                            title: dialog_finish_title,
                            text: dialog_finish_text,
                            type: 'success'
                        }).then(() => {
                            if (redirect_flg) {
                                window.location.href = redirect_url;
                                return false;
                            }

                            //確認ダイアログでOKを押したときの挙動
                        });
                    })
                    .fail(function (error) {
                        //通信失敗時
                        var errors = JSON.parse(error.responseText);
                        Object.keys(errors['errors']).forEach(function (data) {
                            Swal.fire({
                                title: "入力エラー",
                                text: "" + errors['errors'][data] + "",
                            });
                        });
                    });
            } else {
                //cancelやポップアップ以外をクリックしたとき
            }

        });
        return false;
    });
}


function confirmAlert({ form_id = '', method = 'post', dialog_title }) {
    $("#" + form_id).submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).prop('action'),
            type: method,
            data: $(this).serialize(),
            success: function () {
                Swal.fire({
                    title: dialog_title,
                    icon: 'success',
                }).then(() => {
                    window.location.reload();
                });
            },
            error: function (error) {
                var errors = JSON.parse(error.responseText);

                if (Object.keys(errors['errors']) != null) {
                    Object.keys(errors['errors']).forEach(function (data) {
                        Swal.fire({
                            title: "" + errors['errors'][data] + "",
                            icon: "info",
                        });
                    });
                }
            },
        });
    });
}