


window.onload = () => {
    const video = document.querySelector("#vid");
    const canvas = document.querySelector("#canv");


    /** カメラ設定 */
    const constraints = {
        audio: false,
        video: {
            width: 300,
            height: 200,
            facingMode: "user"   // フロントカメラを利用する

        }
    };

    /**
     * カメラを<video>と同期
      */
    navigator.mediaDevices.getUserMedia(constraints)
        .then((stream) => {
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
                video.play();
            };
        })
        .catch((err) => {
            console.log(err.name + ": " + err.message);
        });

    /**
     * シャッターボタン
     */
    document.querySelector("#shutter").addEventListener("click", () => {
        const ctx = canvas.getContext("2d");
        // canvasに画像を貼り付ける
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    });
    // DLボタンをクリック
    document.querySelector("#download").addEventListener("click", () => {
        canvasDownload("#canv");
    });
};
/**
         * Canvasを画像としてダウンロード
         *
         * @param {string} id          対象とするcanvasのid
         * @param {string} [type]      画像フォーマット
         * @param {string} [filename]  DL時のデフォルトファイル名
         * @return {void}
         */
function canvasDownload(id, type = "image/png", filename = "canvas") {
    const blob = getBlobFromCanvas(id, type);       // canvasをBlobデータとして取得
    const dataURI = window.URL.createObjectURL(blob);  // Blobデータを「URI」に変換

    // JS内部でクリックイベントを発動→ダウンロード
    const event = document.createEvent("MouseEvents");
    event.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    const a = document.createElementNS("http://www.w3.org/1999/xhtml", "a");
    a.href = dataURI;         // URI化した画像
    a.download = filename;    // デフォルトのファイル名
    a.dispatchEvent(event);   // イベント発動
}

/**
  * 現状のCanvasを画像データとして返却
  *
  * @param {string}  id     対象とするcanvasのid
  * @param {string}  [type] MimeType
  * @return {blob}
  */
function getBlobFromCanvas(id, type = "image/png") {
    const canvas = document.querySelector(id);
    const base64 = canvas.toDataURL(type);              // "data:image/png;base64,iVBORw0k～"
    const tmp = base64.split(",");                     // ["data:image/png;base64,", "iVBORw0k～"]
    const data = atob(tmp[1]);                          // 右側のデータ部分(iVBORw0k～)をデコード
    const mime = tmp[0].split(":")[1].split(";")[0];    // 画像形式(image/png)を取り出す

    // Blobのコンストラクタに食わせる値を作成
    let buff = new Uint8Array(data.length);
    for (let i = 0; i < data.length; i++) {
        buff[i] = data.charCodeAt(i);
    }

    return (
        new Blob([buff], { type: mime })
    );
}