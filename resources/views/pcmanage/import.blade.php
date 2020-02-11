<form action="/pcmanage/import/send" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">アップロード</button>
</form>
